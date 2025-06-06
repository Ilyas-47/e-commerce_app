<?php
session_start();
require_once('../connection/connection.php');

// Gestion des requêtes GET pour récupérer les données de l'utilisateur
if (isset($_GET['id_user'])) {
    header('Content-Type: application/json');
    $id_user = $_GET['id_user'];

    try {
        $req = $pdo->prepare("SELECT id_user, nom, gmail, password ,image, telephone, role FROM user WHERE id_user = :id_user");
        $req->bindParam(':id_user', $id_user, PDO::PARAM_INT);
        $req->execute();

        $user = $req->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            echo json_encode($user);
        } else {
            echo json_encode(["error" => "Utilisateur introuvable"]);
        }
    } catch (Exception $e) {
        echo json_encode(["error" => "Erreur SQL : " . $e->getMessage()]);
    }
    exit; // Important pour arrêter l'exécution après la réponse JSON
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifier que l'utilisateur est connecté et qu'il modifie ses propres données
    if (!isset($_SESSION['user_id']) || $_SESSION['user_id'] != $_POST['id_user']) {
        echo "error_unauthorized";
        exit();
    }

    $id_user = htmlspecialchars($_POST['id_user']);
    $nom = htmlspecialchars($_POST['nom']);
    $gmail = htmlspecialchars($_POST['gmail']);
    $telephone = htmlspecialchars($_POST['telephone']);

    try {
        // Vérifier si l'utilisateur existe
        $reqCheck = $pdo->prepare("SELECT password FROM user WHERE id_user = :id_user");
        $reqCheck->bindParam(':id_user', $id_user, PDO::PARAM_INT);
        $reqCheck->execute();
        $userCheck = $reqCheck->fetch(PDO::FETCH_ASSOC);

        if (!$userCheck) {
            echo "error_not_found";
            exit();
        }

        // Vérifier si l'email existe déjà pour un autre utilisateur
        $reqEmailCheck = $pdo->prepare("SELECT COUNT(*) as count FROM user WHERE gmail = :gmail AND id_user != :id_user");
        $reqEmailCheck->bindParam(':gmail', $gmail);
        $reqEmailCheck->bindParam(':id_user', $id_user, PDO::PARAM_INT);
        $reqEmailCheck->execute();
        $emailResult = $reqEmailCheck->fetch(PDO::FETCH_ASSOC);

        if ($emailResult['count'] > 0) {
            echo "error_email_exists";
            exit();
        }

        // Préparer la requête de mise à jour
        $updateFields = "nom = :nom, gmail = :gmail, telephone = :telephone";
        $params = [
            ':nom' => $nom,
            ':gmail' => $gmail,
            ':telephone' => $telephone,
            ':id_user' => $id_user
        ];

        // Gérer l'upload d'image si fourni
        if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = '../assets/images/users/';

            // Créer le dossier s'il n'existe pas
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            $fileExtension = strtolower(pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION));
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];

            if (in_array($fileExtension, $allowedExtensions)) {
                $fileName = 'user_' . $id_user . '_' . time() . '.' . $fileExtension;
                $uploadPath = $uploadDir . $fileName;

                if (move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadPath)) {
                    $updateFields .= ", image = :image";
                    $params[':image'] = '../assets/images/users/' . $fileName;
                }
            }
        }

        // Gérer le changement de mot de passe si fourni
        if (isset($_POST['new_password']) && !empty($_POST['new_password'])) {
            $currentPassword = $_POST['current_password'];
            $newPassword = $_POST['new_password'];

            // Vérifier le mot de passe actuel
            if (!password_verify($currentPassword, $userCheck['password'])) {
                echo "error_current_password";
                exit();
            }

            // Ajouter le nouveau mot de passe à la mise à jour
            $updateFields .= ", password = :password";
            $params[':password'] = password_hash($newPassword, PASSWORD_DEFAULT);
        }

        // Mettre à jour l'utilisateur
        $req = $pdo->prepare("UPDATE user SET $updateFields WHERE id_user = :id_user");

        if ($req->execute($params)) {
            // Mettre à jour les données de session
            $_SESSION['user_name'] = $nom;
            $_SESSION['user_gmail'] = $gmail;
            $_SESSION['user_tel'] = $telephone;

            // Mettre à jour l'image de session si elle a été modifiée
            if (isset($params[':image'])) {
                $_SESSION['user_image'] = $params[':image'];
            }

            echo "success";
        } else {
            echo "error";
        }
    } catch (PDOException $e) {
        error_log("Erreur de modification utilisateur: " . $e->getMessage());
        echo "error";
    }
} else {
    echo "error";
}
?>
