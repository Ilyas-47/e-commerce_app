<?php
require_once('../connection/connection.php');
header('Content-Type: application/json');

if (isset($_GET['id_produit'])) {
    $id_produit = $_GET['id_produit'];

    try {
        $req = $pdo->prepare("SELECT * FROM produits WHERE id_produit = :id_produit");
        $req->bindParam(':id_produit', $id_produit, PDO::PARAM_INT);
        $req->execute();

        $product = $req->fetch(PDO::FETCH_ASSOC);

        if ($product) {
            echo json_encode($product);
        } else {
            echo json_encode(["error" => "Produit introuvable"]);
        }
    } catch (Exception $e) {
        echo json_encode(["error" => "Erreur SQL : " . $e->getMessage()]);
    }
} else {
    echo json_encode(["error" => "ID du produit non fourni"]);
}

if (isset($_POST['id_produit'], $_POST['nom'], $_POST['description'], $_POST['prix'], $_POST['stock'], $_POST['categorie'], $_POST['code_promo'], $_POST['pourcentage'])) {
    $id_produit = $_POST['id_produit'];
    $nom = $_POST['nom'];
    $description = $_POST['description'];
    $prix = $_POST['prix'];
    $stock = $_POST['stock'];
    $categorie = $_POST['categorie'];
    $code_promo = $_POST['code_promo'];
    $pourcentage = $_POST['pourcentage'];

    try {
        // Récupérer l'ID du code promo
        $reqCodePromo = $pdo->prepare("SELECT id_promo FROM code_promo WHERE code_promo = :code_promo");
        $reqCodePromo->bindParam(':code_promo', $code_promo);
        $reqCodePromo->execute();
        $code_promoTabl = $reqCodePromo->fetch(PDO::FETCH_ASSOC)['id_promo'] ?? null;

        // Vérifier et gérer l'image
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $imageTmpPath = $_FILES['image']['tmp_name'];
            $imageName = $_FILES['image']['name'];
            $imageSize = $_FILES['image']['size'];
            $imageType = $_FILES['image']['type'];

            $imageNameCmps = explode(".", $imageName);
            $imageExtension = strtolower(end($imageNameCmps));

            // Vérifier l'extension de l'image
            $allowedExtensions = ["jpg", "jpeg", "png", "gif"];
            if (!in_array($imageExtension, $allowedExtensions)) {
                echo "Format d'image non valide.";
                exit;
            }

            $newImageName = md5(time() . $imageName) . '.' . $imageExtension;
            $uploadFileDir = '../assets/images/';
            $destPath = $uploadFileDir . $newImageName;

            if (move_uploaded_file($imageTmpPath, $destPath)) {
                $imageUrl = $destPath;
            } else {
                echo "Erreur lors du téléchargement de l'image.";
                exit;
            }
        } else {
            // Si aucune nouvelle image n'est envoyée, récupérer l'image existante
            $req = $pdo->prepare("SELECT image FROM produits WHERE id_produit = :id_produit");
            $req->bindParam(':id_produit', $id_produit);
            $req->execute();
            $imageUrl = $req->fetch(PDO::FETCH_ASSOC)['image'] ?? '';
        }

        // Mise à jour du produit
        $req = $pdo->prepare("UPDATE produits SET 
            nom_produit = :nom, 
            description = :description, 
            image_url = :image_url, 
            prix = :prix, 
            quantite_stock = :quantite_stock, 
            id_categorie = :id_categorie, 
            id_promo = :id_promo  
            WHERE id_produit = :id_produit");

        $req->bindParam(':id_produit', $id_produit);
        $req->bindParam(':nom', $nom);
        $req->bindParam(':description', $description);
        $req->bindParam(':image_url', $imageUrl);
        $req->bindParam(':prix', $prix);
        $req->bindParam(':quantite_stock', $stock);
        $req->bindParam(':id_categorie', $categorie);
        $req->bindParam(':id_promo', $code_promoTabl);

        $req->execute();
        header("location:../admin/produit.php");
    } catch (Exception $e) {
        error_log("Erreur SQL : " . $e->getMessage());
        header("location:../includes/error.php");
    }
}
?>

