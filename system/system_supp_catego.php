<?php
require_once('../connection/connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST['id_categorie']) || !is_numeric($_POST['id_categorie'])) {
        echo "error";
        exit();
    }

    $id_categorie = (int) $_POST['id_categorie']; // Conversion en entier pour éviter les injections SQL

    try {
        $req = $pdo->prepare("DELETE FROM categories WHERE id_categorie = :id_categorie");
        $req->bindParam(':id_categorie', $id_categorie, PDO::PARAM_INT);

        if ($req->execute()) {
            echo "success";
        } else {
            echo "error";
        }
    } catch (PDOException $e) {
        error_log("Erreur de suppression: " . $e->getMessage());
        echo "error";
    }
} else {
    echo "error";
}
?>
