<?php
// Démarrer la session seulement si elle n'est pas déjà active
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once('../connection/connection.php');

// Vérifier si l'utilisateur est connecté et a le bon rôle
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'chef administratif') {
    echo json_encode(["error" => "Accès refusé"]);
    exit();
}

// Gestion des requêtes GET pour récupérer les données de l'utilisateur
if (isset($_GET['id_user'])) {
    header('Content-Type: application/json');
    $id_user = $_GET['id_user'];

    try {
        $req = $pdo->prepare("SELECT id_user, nom, gmail, telephone, role FROM user WHERE id_user = :id_user");
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
    $id_user = htmlspecialchars($_POST['id_user']);
    $nom = htmlspecialchars($_POST['nom']);
    $gmail = htmlspecialchars($_POST['gmail']);
    $telephone = htmlspecialchars($_POST['telephone']);
    $role = htmlspecialchars($_POST['role']);

    try {
        // Vérifier si l'utilisateur existe
        $reqCheck = $pdo->prepare("SELECT COUNT(*) as count FROM user WHERE id_user = :id_user");
        $reqCheck->bindParam(':id_user', $id_user, PDO::PARAM_INT);
        $reqCheck->execute();
        $result = $reqCheck->fetch(PDO::FETCH_ASSOC);

        if ($result['count'] == 0) {
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

        // Mettre à jour l'utilisateur
        $req = $pdo->prepare("UPDATE user SET nom = :nom, gmail = :gmail, telephone = :telephone, role = :role WHERE id_user = :id_user");
        $req->bindParam(':nom', $nom);
        $req->bindParam(':gmail', $gmail);
        $req->bindParam(':telephone', $telephone);
        $req->bindParam(':role', $role);
        $req->bindParam(':id_user', $id_user, PDO::PARAM_INT);

        if ($req->execute()) {
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
