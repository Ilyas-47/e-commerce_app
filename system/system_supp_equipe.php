<?php
require_once('../connection/connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST['id_user']) || !is_numeric($_POST['id_user'])) {
        echo "error_invalid_id";
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
            echo "error_user_not_found";
            exit();
        }

        // Vérifier s'il y a des commandes liées à cet utilisateur
        $reqCommandesCheck = $pdo->prepare("SELECT COUNT(*) as count FROM commandes WHERE id_user = :id_user");
        $reqCommandesCheck->bindParam(':id_user', $id_user, PDO::PARAM_INT);
        $reqCommandesCheck->execute();
        $commandesResult = $reqCommandesCheck->fetch(PDO::FETCH_ASSOC);

        if ($commandesResult['count'] > 0) {
            // L'utilisateur a des commandes, on ne peut pas le supprimer
            echo "error_has_orders";
            exit();
        }

        // Supprimer l'utilisateur
        $req = $pdo->prepare("DELETE FROM user WHERE id_user = :id_user");
        $req->bindParam(':id_user', $id_user, PDO::PARAM_INT);

        if ($req->execute()) {
            echo "success";
        } else {
            $errorInfo = $req->errorInfo();
            error_log("Erreur SQL lors de la suppression: " . implode(" | ", $errorInfo));
            echo "error_sql";
        }
    } catch (PDOException $e) {
        error_log("Erreur de suppression utilisateur: " . $e->getMessage());
        echo "error_exception";
    }
} else {
    echo "error_method";
}
?>
