<?php
session_start();
require_once('../connection/connection.php');

header('Content-Type: application/json');

// Vérifier que la requête est en POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Méthode non autorisée']);
    exit;
}

// Récupérer les données JSON
$input = file_get_contents('php://input');
$data = json_decode($input, true);

if (!$data) {
    http_response_code(400);
    echo json_encode(['error' => 'Données JSON invalides']);
    exit;
}

try {
    switch ($data['action']) {
        case 'sync_to_session':
            // Synchroniser le panier localStorage vers la session PHP
            if (isset($data['cart']) && is_array($data['cart'])) {
                $_SESSION['panier'] = [];
                
                foreach ($data['cart'] as $item) {
                    if (isset($item['id'], $item['name'], $item['price'], $item['quantity'])) {
                        $_SESSION['panier'][] = [
                            'id_produit' => (int)$item['id'],
                            'nom_produit' => $item['name'],
                            'prix' => (float)$item['price'],
                            'quantite' => (int)$item['quantity'],
                            'image_url' => $item['image'] ?? ''
                        ];
                    }
                }
                
                echo json_encode(['success' => true, 'message' => 'Panier synchronisé vers la session']);
            } else {
                echo json_encode(['error' => 'Données du panier invalides']);
            }
            break;
            
        case 'sync_from_session':
            // Synchroniser la session PHP vers localStorage (retourner les données)
            $sessionCart = $_SESSION['panier'] ?? [];
            $localStorageCart = [];
            
            foreach ($sessionCart as $item) {
                $localStorageCart[] = [
                    'id' => (int)$item['id_produit'],
                    'name' => $item['nom_produit'],
                    'price' => (float)$item['prix'],
                    'quantity' => (int)$item['quantite'],
                    'image' => $item['image_url'] ?? '../assets/images/d-product.png'
                ];
            }
            
            echo json_encode([
                'success' => true,
                'cart' => $localStorageCart,
                'message' => 'Panier récupéré depuis la session'
            ]);
            break;
            
        case 'get_product_info':
            // Récupérer les informations d'un produit depuis la base de données
            if (!isset($data['product_id'])) {
                echo json_encode(['error' => 'ID produit manquant']);
                break;
            }
            
            $productId = (int)$data['product_id'];
            $stmt = $pdo->prepare("
                SELECT id_produit, nom_produit, prix, image_url, quantite_stock 
                FROM produits 
                WHERE id_produit = :id AND quantite_stock > 0
            ");
            $stmt->bindValue(':id', $productId, PDO::PARAM_INT);
            $stmt->execute();
            
            $product = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($product) {
                echo json_encode([
                    'success' => true,
                    'product' => [
                        'id' => (int)$product['id_produit'],
                        'name' => $product['nom_produit'],
                        'price' => (float)$product['prix'],
                        'image' => $product['image_url'] ?? '../assets/images/d-product.png',
                        'stock' => (int)$product['quantite_stock']
                    ]
                ]);
            } else {
                echo json_encode(['error' => 'Produit non trouvé ou en rupture de stock']);
            }
            break;
            
        case 'validate_cart':
            // Valider que tous les produits du panier sont encore disponibles
            if (!isset($data['cart']) || !is_array($data['cart'])) {
                echo json_encode(['error' => 'Données du panier invalides']);
                break;
            }
            
            $validatedCart = [];
            $errors = [];
            
            foreach ($data['cart'] as $item) {
                if (!isset($item['id'])) continue;
                
                $stmt = $pdo->prepare("
                    SELECT id_produit, nom_produit, prix, image_url, quantite_stock 
                    FROM produits 
                    WHERE id_produit = :id
                ");
                $stmt->bindValue(':id', (int)$item['id'], PDO::PARAM_INT);
                $stmt->execute();
                
                $product = $stmt->fetch(PDO::FETCH_ASSOC);
                
                if (!$product) {
                    $errors[] = "Produit ID {$item['id']} non trouvé";
                    continue;
                }
                
                if ($product['quantite_stock'] <= 0) {
                    $errors[] = "Produit '{$product['nom_produit']}' en rupture de stock";
                    continue;
                }
                
                if ($item['quantity'] > $product['quantite_stock']) {
                    $errors[] = "Quantité demandée pour '{$product['nom_produit']}' supérieure au stock disponible ({$product['quantite_stock']})";
                    $item['quantity'] = $product['quantite_stock'];
                }
                
                // Mettre à jour les informations du produit avec les données actuelles de la DB
                $validatedCart[] = [
                    'id' => (int)$product['id_produit'],
                    'name' => $product['nom_produit'],
                    'price' => (float)$product['prix'],
                    'image' => $product['image_url'] ?? '../assets/images/d-product.png',
                    'quantity' => (int)$item['quantity']
                ];
            }
            
            echo json_encode([
                'success' => true,
                'cart' => $validatedCart,
                'errors' => $errors,
                'message' => 'Panier validé'
            ]);
            break;

        case 'verify_promo_code':
            // Vérifier un code promo dans la base de données
            if (!isset($data['promo_code']) || !isset($data['cart'])) {
                echo json_encode(['error' => 'Code promo ou panier manquant']);
                break;
            }

            $promoCode = trim(strtoupper($data['promo_code']));
            $cart = $data['cart'];

            // Rechercher le code promo dans la base de données
            $stmt = $pdo->prepare("SELECT id_promo, code_promo, pourcentage FROM code_promo WHERE code_promo = :code_promo");
            $stmt->bindValue(':code_promo', $promoCode, PDO::PARAM_STR);
            $stmt->execute();

            $promoData = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$promoData) {
                echo json_encode(['error' => 'Code promo invalide']);
                break;
            }

            // Vérifier quels produits du panier peuvent bénéficier de ce code promo
            $applicableItems = [];
            $totalDiscount = 0;
            $subtotalBeforeDiscount = 0;

            foreach ($cart as $item) {
                if (!isset($item['id'], $item['price'], $item['quantity'])) continue;

                $itemSubtotal = $item['price'] * $item['quantity'];
                $subtotalBeforeDiscount += $itemSubtotal;

                // Vérifier si ce produit a ce code promo assigné
                $productStmt = $pdo->prepare("SELECT id_promo FROM produits WHERE id_produit = :id_produit");
                $productStmt->bindValue(':id_produit', (int)$item['id'], PDO::PARAM_INT);
                $productStmt->execute();

                $productPromo = $productStmt->fetch(PDO::FETCH_ASSOC);

                if ($productPromo && $productPromo['id_promo'] == $promoData['id_promo']) {
                    // Ce produit peut bénéficier du code promo
                    $itemDiscount = ($itemSubtotal * $promoData['pourcentage']) / 100;
                    $totalDiscount += $itemDiscount;

                    $applicableItems[] = [
                        'id' => $item['id'],
                        'name' => $item['name'] ?? 'Produit',
                        'original_price' => $itemSubtotal,
                        'discount_amount' => $itemDiscount,
                        'final_price' => $itemSubtotal - $itemDiscount
                    ];
                }
            }

            if (empty($applicableItems)) {
                echo json_encode([
                    'error' => 'Ce code promo ne s\'applique à aucun produit de votre panier'
                ]);
                break;
            }

            $finalTotal = $subtotalBeforeDiscount - $totalDiscount;

            echo json_encode([
                'success' => true,
                'promo_code' => $promoData['code_promo'],
                'percentage' => $promoData['pourcentage'],
                'subtotal_before_discount' => $subtotalBeforeDiscount,
                'total_discount' => $totalDiscount,
                'final_total' => $finalTotal,
                'applicable_items' => $applicableItems,
                'message' => "Code promo '{$promoData['code_promo']}' appliqué avec succès! Réduction de {$promoData['pourcentage']}% sur " . count($applicableItems) . " produit(s)."
            ]);
            break;

        default:
            echo json_encode(['error' => 'Action non reconnue']);
            break;
    }
    
} catch (PDOException $e) {
    error_log("Erreur base de données dans sync_cart.php: " . $e->getMessage());
    echo json_encode(['error' => 'Erreur de base de données']);
} catch (Exception $e) {
    error_log("Erreur dans sync_cart.php: " . $e->getMessage());
    echo json_encode(['error' => 'Erreur interne du serveur']);
}
?>
