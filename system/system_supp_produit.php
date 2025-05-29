<?php
require_once('../connection/connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST['id_produit']) || !is_numeric($_POST['id_produit'])) {
        echo "error";
        exit();
    }

    $id_produit = (int) $_POST['id_produit']; // Correction de la variable

    try {
        $req = $pdo->prepare("DELETE FROM produits WHERE id_produit = :id_produit"); // Vérifiez bien le nom de la table
        $req->bindParam(':id_produit', $id_produit, PDO::PARAM_INT);

        if ($req->execute()) {
            echo "success";
        } else {
            $errorInfo = $req->errorInfo();
            error_log("Erreur SQL : " . implode(" | ", $errorInfo)); // Log des erreurs
            echo "error";
        }
    } catch (PDOException $e) {
        error_log("Erreur de suppression: " . $e->getMessage());
        echo "error";
    }
} else {
    header("location:../includes/error404.php");
}
?>
