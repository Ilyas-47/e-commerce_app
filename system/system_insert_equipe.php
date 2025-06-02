<?php
// Démarrer la session seulement si elle n'est pas déjà active
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once('../connection/connection.php');

// Vérifier si l'utilisateur est connecté et a le bon rôle
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'chef administratif') {
    echo "error_access_denied";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = htmlspecialchars($_POST['email']);
    $role = htmlspecialchars($_POST['role'] ?? 'admin'); // Par défaut admin

    try {
        // Vérifier si l'email existe déjà dans la table user
        $checkReq = $pdo->prepare("SELECT id_user, role FROM user WHERE gmail = :email");
        $checkReq->bindParam(':email', $email);
        $checkReq->execute();
        $existingUser = $checkReq->fetch(PDO::FETCH_ASSOC);

        if ($existingUser) {
            // L'utilisateur existe, mettre à jour son rôle
            $updateReq = $pdo->prepare("UPDATE user SET role = :role WHERE gmail = :email");
            $updateReq->bindParam(':role', $role);
            $updateReq->bindParam(':email', $email);

            if ($updateReq->execute()) {
                echo "success";
            } else {
                echo "error_update";
            }
        } else {
            // L'utilisateur n'existe pas, créer un nouveau compte avec des valeurs par défaut
            $defaultName = "Nouveau membre";
            $defaultPassword = password_hash("password123", PASSWORD_DEFAULT); // Mot de passe temporaire
            $defaultImage = '../assets/images/user.png';
            $defaultAddress = 'none';
            $defaultPhone = '0000000000';

            $insertReq = $pdo->prepare("INSERT INTO user (nom, gmail, password, adresse, image, telephone, role) VALUES (:nom, :gmail, :password, :adresse, :image, :telephone, :role)");
            $insertReq->bindParam(':nom', $defaultName);
            $insertReq->bindParam(':gmail', $email);
            $insertReq->bindParam(':password', $defaultPassword);
            $insertReq->bindParam(':adresse', $defaultAddress);
            $insertReq->bindParam(':image', $defaultImage);
            $insertReq->bindParam(':telephone', $defaultPhone);
            $insertReq->bindParam(':role', $role);

            if ($insertReq->execute()) {
                echo "success";
            } else {
                echo "error_insert";
            }
        }
    } catch (PDOException $e) {
        error_log("Erreur d'ajout membre équipe: " . $e->getMessage());
        echo "error_exception";
    }
} else {
    echo "error_method";
}
?>