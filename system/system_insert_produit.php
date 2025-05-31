<?php
require_once('../connection/connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom_produit = htmlspecialchars($_POST['nom']);
    $description = htmlspecialchars($_POST['description']);
    $prix = htmlspecialchars($_POST['prix']);
    $stock = htmlspecialchars($_POST['stock']);
    $categorie = htmlspecialchars($_POST['categorie']);
    $code_promo = htmlspecialchars($_POST['code_promo'] ?? '');
    $pourcentage = htmlspecialchars($_POST['pourcentage'] ?? '');

    // Gestion de l'image
    $imagePath = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $imageTmpPath = $_FILES['image']['tmp_name'];
        $imageName = $_FILES['image']['name'];
        $imageExtension = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));

        // Vérifier l'extension
        $allowedExtensions = ["jpg", "jpeg", "png", "gif"];
        if (!in_array($imageExtension, $allowedExtensions)) {
            echo "error_image_format";
            exit;
        } else {
            $newImageName = md5(time() . $imageName) . '.' . $imageExtension;
            $uploadFileDir = '../assets/images/';
            $destPath = $uploadFileDir . $newImageName;

            if (move_uploaded_file($imageTmpPath, $destPath)) {
                $imagePath = $destPath;
            }
        }
    }

    try {
        // Gestion intelligente du code promo
        $id_promo = NULL;
        if (!empty($code_promo) && !empty($pourcentage)) {
            // Vérifier si le code promo existe déjà
            $reqExistingPromo = $pdo->prepare("SELECT id_promo FROM code_promo WHERE code_promo = :code_promo");
            $reqExistingPromo->bindValue(':code_promo', $code_promo);
            $reqExistingPromo->execute();
            $existingPromo = $reqExistingPromo->fetch(PDO::FETCH_ASSOC);

            if ($existingPromo) {
                // Le code promo existe déjà, on met à jour le pourcentage et on l'utilise
                $reqUpdatePromo = $pdo->prepare("UPDATE code_promo SET pourcentage = :pourcentage WHERE id_promo = :id_promo");
                $reqUpdatePromo->bindValue(':pourcentage', $pourcentage);
                $reqUpdatePromo->bindValue(':id_promo', $existingPromo['id_promo']);
                $reqUpdatePromo->execute();
                $id_promo = $existingPromo['id_promo'];
            } else {
                // Le code promo n'existe pas, on le crée
                $req1 = $pdo->prepare("INSERT INTO code_promo (code_promo, pourcentage) VALUES (:code_promo, :pourcentage)");
                $req1->bindValue(':code_promo', $code_promo);
                $req1->bindValue(':pourcentage', $pourcentage);

                if ($req1->execute()) {
                    $id_promo = $pdo->lastInsertId();
                }
            }
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
            echo "success";
        } else {
            echo "error";
        }
    } catch (PDOException $e) {
        error_log("Erreur SQL : " . $e->getMessage());
        echo "error";
    }
} else {
    header("location:../includes/error404.php");
    exit();
}
?>
