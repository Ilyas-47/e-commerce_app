<?php
session_start();
require_once('../connection/connection.php');

header("X-Content-Type-Options: nosniff");
header("X-Frame-Options: DENY");
header("X-XSS-Protection: 1; mode=block");


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['mot_de_passe'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Format d'email invalide.";
        header("Location: ../user/login.php");
        exit();
    }

    if (empty($email) || empty($password)) {
        $_SESSION['error'] = "Tous les champs sont requis.";
        header("Location: ../user/login.php");
        exit();
    }

    $stmt = $pdo->prepare("SELECT * FROM user WHERE gmail = ? LIMIT 1");
    $stmt->bindValue(1, $email, PDO::PARAM_STR); 
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

     

    if ($user && password_verify($password, $user['password'])) { 
        session_regenerate_id(true);

        $_SESSION['user_id'] = $user['id_user'];
        $_SESSION['user_name'] = $user['nom'];
        $_SESSION['user_gmail'] = $user['gmail'];
        $_SESSION['user_adresse'] = $user['adresse'];
        $_SESSION['user_image'] = $user['image'];
        $_SESSION['user_tel'] = $user['telephone'];
        $_SESSION['user_role'] = $user['role'];

        if ($user['role'] == 'admin' || $user['role'] == 'chef administratif') {
            header("Location: ../admin/dashboard.php");
        } else if ($user['role'] == 'user') {
            header("Location: ../user/accueil.php");
        }
        exit();
    } else {
        sleep(2);
        
        $_SESSION['error'] = "Adresse email ou mot de passe incorrect.";
        header("Location: ../user/login.php"); 
        exit();
    }
}



?>
