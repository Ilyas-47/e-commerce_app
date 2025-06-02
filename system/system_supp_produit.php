<?php
require_once('../connection/connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST['id_produit']) || !is_numeric($_POST['id_produit'])) {
        echo "error_invalid_id";
        exit();
    }

    $id_produit = (int) $_POST['id_produit'];

    try {
        // Vérifier si le produit existe
        $reqCheck = $pdo->prepare("SELECT COUNT(*) as count FROM produits WHERE id_produit = :id_produit");
        $reqCheck->bindParam(':id_produit', $id_produit, PDO::PARAM_INT);
        $reqCheck->execute();
        $result = $reqCheck->fetch(PDO::FETCH_ASSOC);

        if ($result['count'] == 0) {
            // Le produit n'existe pas
            echo "error_product_not_found";
            exit();
        }

        // Vérifier s'il y a des commandes liées à ce produit
        $reqOrdersCheck = $pdo->prepare("SELECT COUNT(*) as count FROM details_commande WHERE id_produit = :id_produit");
        $reqOrdersCheck->bindParam(':id_produit', $id_produit, PDO::PARAM_INT);
        $reqOrdersCheck->execute();
        $ordersResult = $reqOrdersCheck->fetch(PDO::FETCH_ASSOC);

        if ($ordersResult['count'] > 0) {
            // Le produit a des commandes associées, on ne peut pas le supprimer
            echo "error_has_orders";
            exit();
        }

        // Supprimer le produit
        $req = $pdo->prepare("DELETE FROM produits WHERE id_produit = :id_produit");
        $req->bindParam(':id_produit', $id_produit, PDO::PARAM_INT);

        if ($req->execute()) {
            echo "success";
        } else {
            $errorInfo = $req->errorInfo();
            error_log("Erreur SQL lors de la suppression: " . implode(" | ", $errorInfo));
            echo "error_sql";
        }
    } catch (PDOException $e) {
        error_log("Erreur de suppression produit: " . $e->getMessage());
        echo "error_exception";
    }
} else {
    echo "error_method";
}
?>
