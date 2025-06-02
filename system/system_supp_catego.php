<?php
require_once('../connection/connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST['id_categorie']) || !is_numeric($_POST['id_categorie'])) {
        echo "error_invalid_id";
        exit();
    }

    $id_categorie = (int) $_POST['id_categorie']; // Conversion en entier pour éviter les injections SQL

    try {
        // Vérifier si la catégorie existe
        $reqCategoryCheck = $pdo->prepare("SELECT COUNT(*) as count FROM categories WHERE id_categorie = :id_categorie");
        $reqCategoryCheck->bindParam(':id_categorie', $id_categorie, PDO::PARAM_INT);
        $reqCategoryCheck->execute();
        $categoryResult = $reqCategoryCheck->fetch(PDO::FETCH_ASSOC);

        if ($categoryResult['count'] == 0) {
            // La catégorie n'existe pas
            echo "error_category_not_found";
            exit();
        }

        // Vérifier s'il y a des produits liés à cette catégorie
        $reqCheck = $pdo->prepare("SELECT COUNT(*) as count FROM produits WHERE id_categorie = :id_categorie");
        $reqCheck->bindParam(':id_categorie', $id_categorie, PDO::PARAM_INT);
        $reqCheck->execute();
        $result = $reqCheck->fetch(PDO::FETCH_ASSOC);

        if ($result['count'] > 0) {
            // Il y a des produits liés à cette catégorie
            echo "error_has_products:" . $result['count'];
            exit();
        }

        // Si c'est juste une vérification, on s'arrête ici
        if (isset($_POST['check_only'])) {
            echo "can_delete";
            exit();
        }

        // Aucun produit lié, on peut supprimer la catégorie
        $req = $pdo->prepare("DELETE FROM categories WHERE id_categorie = :id_categorie");
        $req->bindParam(':id_categorie', $id_categorie, PDO::PARAM_INT);

        if ($req->execute()) {
            echo "success";
        } else {
            $errorInfo = $req->errorInfo();
            error_log("Erreur SQL lors de la suppression: " . implode(" | ", $errorInfo));
            echo "error_sql";
        }
    } catch (PDOException $e) {
        error_log("Erreur de suppression catégorie: " . $e->getMessage());
        echo "error_exception";
    }
} else {
    echo "error_method";
}
?>
