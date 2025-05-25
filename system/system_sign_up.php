<?php
session_start();
require_once('../connection/connection.php');

header("X-Content-Type-Options: nosniff");
header("X-Frame-Options: DENY");
header("X-XSS-Protection: 1; mode=block");

try {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $full_name = $_POST['nom'];
        $email = $_POST['email'];
        $telephone = $_POST['telephone'];
        $password = $_POST['mot_de_passe'];
        $default_image_url = '../assets/images/user.png'; 
        $default_role = 'user';
        $default_adresse = 'none'; 


        if (empty($full_name) || empty($email) || empty($telephone) || empty($password)) {
            $_SESSION['signup_error'] = "Tous les champs sont requis.";
            header("Location: ../user/login.php");
            exit();
        }

        $stmt = $pdo->prepare("SELECT * FROM user WHERE gmail = ? LIMIT 1");
        $stmt->bindValue(1, $email, PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            $_SESSION['signup_error'] = "Le compte existe déjà.";
            header("Location: ../includes/error404.php");
            exit();
        }

        $password_hashed = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $pdo->prepare("INSERT INTO user (nom, gmail, password, adresse, image, telephone, role) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bindValue(1, $full_name, PDO::PARAM_STR);
        $stmt->bindValue(2, $email, PDO::PARAM_STR);
        $stmt->bindValue(3, $password_hashed, PDO::PARAM_STR);
        $stmt->bindValue(4, $default_adresse, PDO::PARAM_STR);  
        $stmt->bindValue(5, $default_image_url, PDO::PARAM_STR);
        $stmt->bindValue(6, $telephone, PDO::PARAM_STR);
        $stmt->bindValue(7, $default_role, PDO::PARAM_STR);
        $stmt->execute();

        session_regenerate_id(true);

        header("Location: ../user/login.php");
        exit();
    }
} catch (PDOException $e) {
    $_SESSION['error_message'] = "Une erreur est survenue. Veuillez réessayer plus tard.";
    header("Location: ../includes/error404.php");
    exit();
}
?>
