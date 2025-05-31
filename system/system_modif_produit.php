<?php
require_once('../connection/connection.php');

// Gestion des requêtes GET pour récupérer les données du produit
if (isset($_GET['id_produit'])) {
    header('Content-Type: application/json');
    $id_produit = $_GET['id_produit'];

    try {
        $req = $pdo->prepare("SELECT p.*, c.code_promo, c.pourcentage
                              FROM produits p
                              LEFT JOIN code_promo c ON p.id_promo = c.id_promo
                              WHERE p.id_produit = :id_produit");
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
    exit; // Important pour arrêter l'exécution après la réponse JSON
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
        // Gestion avancée des codes promo
        $code_promoTabl = null;

        // Récupérer l'ID du code promo actuel du produit
        $reqCurrentPromo = $pdo->prepare("SELECT id_promo FROM produits WHERE id_produit = :id_produit");
        $reqCurrentPromo->bindParam(':id_produit', $id_produit);
        $reqCurrentPromo->execute();
        $currentPromoId = $reqCurrentPromo->fetch(PDO::FETCH_ASSOC)['id_promo'] ?? null;

        if (!empty($code_promo) && !empty($pourcentage)) {
            // Cas 1: Un code promo est fourni

            if ($currentPromoId) {
                // Le produit a déjà un code promo
                // Récupérer les infos du code promo actuel
                $reqCurrentPromoInfo = $pdo->prepare("SELECT code_promo, pourcentage FROM code_promo WHERE id_promo = :id_promo");
                $reqCurrentPromoInfo->bindParam(':id_promo', $currentPromoId);
                $reqCurrentPromoInfo->execute();
                $currentPromoInfo = $reqCurrentPromoInfo->fetch(PDO::FETCH_ASSOC);

                if ($currentPromoInfo && $currentPromoInfo['code_promo'] === $code_promo) {
                    // Même code promo, on met juste à jour le pourcentage
                    $reqUpdatePromo = $pdo->prepare("UPDATE code_promo SET pourcentage = :pourcentage WHERE id_promo = :id_promo");
                    $reqUpdatePromo->bindParam(':pourcentage', $pourcentage);
                    $reqUpdatePromo->bindParam(':id_promo', $currentPromoId);
                    $reqUpdatePromo->execute();
                    $code_promoTabl = $currentPromoId;
                } else {
                    // Code promo différent, vérifier s'il existe déjà
                    $reqExistingPromo = $pdo->prepare("SELECT id_promo FROM code_promo WHERE code_promo = :code_promo");
                    $reqExistingPromo->bindParam(':code_promo', $code_promo);
                    $reqExistingPromo->execute();
                    $existingPromo = $reqExistingPromo->fetch(PDO::FETCH_ASSOC);

                    if ($existingPromo) {
                        // Le nouveau code promo existe déjà, on l'utilise et met à jour le pourcentage
                        $reqUpdatePromo = $pdo->prepare("UPDATE code_promo SET pourcentage = :pourcentage WHERE id_promo = :id_promo");
                        $reqUpdatePromo->bindParam(':pourcentage', $pourcentage);
                        $reqUpdatePromo->bindParam(':id_promo', $existingPromo['id_promo']);
                        $reqUpdatePromo->execute();
                        $code_promoTabl = $existingPromo['id_promo'];
                    } else {
                        // Créer un nouveau code promo
                        $reqNewPromo = $pdo->prepare("INSERT INTO code_promo (code_promo, pourcentage) VALUES (:code_promo, :pourcentage)");
                        $reqNewPromo->bindParam(':code_promo', $code_promo);
                        $reqNewPromo->bindParam(':pourcentage', $pourcentage);

                        if ($reqNewPromo->execute()) {
                            $code_promoTabl = $pdo->lastInsertId();
                        }
                    }
                }
            } else {
                // Le produit n'a pas de code promo, vérifier si le code existe déjà
                $reqExistingPromo = $pdo->prepare("SELECT id_promo FROM code_promo WHERE code_promo = :code_promo");
                $reqExistingPromo->bindParam(':code_promo', $code_promo);
                $reqExistingPromo->execute();
                $existingPromo = $reqExistingPromo->fetch(PDO::FETCH_ASSOC);

                if ($existingPromo) {
                    // Le code promo existe déjà, on l'utilise et met à jour le pourcentage
                    $reqUpdatePromo = $pdo->prepare("UPDATE code_promo SET pourcentage = :pourcentage WHERE id_promo = :id_promo");
                    $reqUpdatePromo->bindParam(':pourcentage', $pourcentage);
                    $reqUpdatePromo->bindParam(':id_promo', $existingPromo['id_promo']);
                    $reqUpdatePromo->execute();
                    $code_promoTabl = $existingPromo['id_promo'];
                } else {
                    // Créer un nouveau code promo
                    $reqNewPromo = $pdo->prepare("INSERT INTO code_promo (code_promo, pourcentage) VALUES (:code_promo, :pourcentage)");
                    $reqNewPromo->bindParam(':code_promo', $code_promo);
                    $reqNewPromo->bindParam(':pourcentage', $pourcentage);

                    if ($reqNewPromo->execute()) {
                        $code_promoTabl = $pdo->lastInsertId();
                    }
                }
            }
        } else {
            // Cas 2: Aucun code promo fourni (champs vides)
            // On supprime le lien avec le code promo mais on garde le code promo dans la table
            $code_promoTabl = null;
        }

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
                echo "error_image_format";
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
            $req = $pdo->prepare("SELECT image_url FROM produits WHERE id_produit = :id_produit");
            $req->bindParam(':id_produit', $id_produit);
            $req->execute();
            $imageUrl = $req->fetch(PDO::FETCH_ASSOC)['image_url'] ?? '';
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

        if ($req->execute()) {
            echo "success";
        } else {
            echo "error";
        }
    } catch (Exception $e) {
        error_log("Erreur SQL : " . $e->getMessage());
        echo "error";
    }
}
?>

