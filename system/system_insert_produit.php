<?php
require_once('../connection/connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom_produit = htmlspecialchars($_POST['nom']);
    $description = htmlspecialchars($_POST['description']);
    $prix = htmlspecialchars($_POST['prix']);
    $stock = htmlspecialchars($_POST['stock']);
    $categorie = htmlspecialchars($_POST['categorie']);
    $code_promo = htmlspecialchars($_POST['code_promo']);
    $pourcentage = htmlspecialchars($_POST['pourcentage']);

    $image = $_FILES['image']['name'];
    $imagePath = '../assets/images/' . basename($image);    

    try {
        // Insertion du code promo
        $req1 = $pdo->prepare("INSERT INTO code_promo (code_promo, pourcentage) VALUES (:code_promo, :pourcentage)");
        $req1->bindValue(':code_promo', $code_promo);
        $req1->bindValue(':pourcentage', $pourcentage);

        if ($req1->execute()) {
            $id_promo = $pdo->lastInsertId(); // Récupération de l'ID du code promo inséré
        } else {
            $id_promo = NULL; // Si l'insertion échoue, le produit sera enregistré sans code promo
        }

        // Insertion du produit
        $req2 = $pdo->prepare("INSERT INTO produits (nom_produit, description, prix, quantite_stock, image_url, id_categorie, id_promo)
                                VALUES (:nom_produit, :description, :prix, :quantite_stock, :image_url, :id_categorie, :id_promo)");
        $req2->bindValue(':nom_produit', $nom_produit);
        $req2->bindValue(':description', $description);
        $req2->bindValue(':prix', $prix);
        $req2->bindValue(':quantite_stock', $stock);
        $req2->bindValue(':image_url', $imagePath);
        $req2->bindValue(':id_categorie', $categorie);
        $req2->bindValue(':id_promo', $id_promo, PDO::PARAM_INT); // Correction ici

        if ($req2->execute()) {
            header("location:../admin/produit.php?success=1");
            exit();
        } else {
            echo "Erreur lors de l'insertion du produit.";
        }
    } catch (PDOException $e) {
        error_log("Erreur SQL : " . $e->getMessage());
        echo "Erreur de traitement.";
    }
} else {
    header("location:../includes/error404.php");
    exit();
}
?>
 