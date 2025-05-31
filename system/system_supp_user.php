<?php
require_once('../connection/connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST['id_user']) || !is_numeric($_POST['id_user'])) {
        echo "error";
        exit();
    }

    $id_user = (int) $_POST['id_user']; // Conversion en entier pour éviter les injections SQL

    try {
        // Vérifier si l'utilisateur existe
        $reqCheck = $pdo->prepare("SELECT COUNT(*) as count FROM user WHERE id_user = :id_user");
        $reqCheck->bindParam(':id_user', $id_user, PDO::PARAM_INT);
        $reqCheck->execute();
        $result = $reqCheck->fetch(PDO::FETCH_ASSOC);

        if ($result['count'] == 0) {
            // L'utilisateur n'existe pas
            echo "error";
            exit();
        }

        // Supprimer l'utilisateur
        $req = $pdo->prepare("DELETE FROM user WHERE id_user = :id_user");
        $req->bindParam(':id_user', $id_user, PDO::PARAM_INT);

        if ($req->execute()) {
            echo "success";
        } else {
            echo "error";
        }
    } catch (PDOException $e) {
        error_log("Erreur de suppression utilisateur: " . $e->getMessage());
        echo "error";
    }
} else {
    echo "error";
}
?>
