<?php
require_once('../connection/connection.php');

// Récupération du produit spécifique si ID fourni
$produit = null;
$produitId = isset($_GET['id']) ? (int)$_GET['id'] : null;

if ($produitId) {
    try {
        $reqProduit = $pdo->prepare("
            SELECT p.id_produit, p.nom_produit, p.description, p.prix, p.quantite_stock, p.image_url, c.nom_categorie, c.id_categorie
            FROM produits p
            LEFT JOIN categories c ON p.id_categorie = c.id_categorie
            WHERE p.id_produit = :id AND p.quantite_stock > 0
        ");
        $reqProduit->bindValue(':id', $produitId, PDO::PARAM_INT);
        $reqProduit->execute();
        $produit = $reqProduit->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Erreur récupération produit : " . $e->getMessage());
    }
}

// Si aucun produit trouvé, rediriger vers la page des produits
if (!$produit) {
    header('Location: products.php');
    exit();
}

// Récupération des produits similaires (même catégorie, limité aux 8)
try {
    $reqProduits = $pdo->prepare("
        SELECT p.id_produit, p.nom_produit, p.description, p.prix, p.quantite_stock, p.image_url, c.nom_categorie
        FROM produits p
        LEFT JOIN categories c ON p.id_categorie = c.id_categorie
        WHERE p.quantite_stock > 0 AND p.id_categorie = :categorie AND p.id_produit != :current_id
        ORDER BY p.id_produit DESC
        LIMIT 8
    ");
    $reqProduits->bindValue(':categorie', $produit['id_categorie'] ?? 0, PDO::PARAM_INT);
    $reqProduits->bindValue(':current_id', $produitId, PDO::PARAM_INT);
    $reqProduits->execute();
    $produits = $reqProduits->fetchAll(PDO::FETCH_ASSOC);

    // Si pas assez de produits similaires, compléter avec d'autres produits
    if (count($produits) < 8) {
        $reqAutresProduits = $pdo->prepare("
            SELECT p.id_produit, p.nom_produit, p.description, p.prix, p.quantite_stock, p.image_url, c.nom_categorie
            FROM produits p
            LEFT JOIN categories c ON p.id_categorie = c.id_categorie
            WHERE p.quantite_stock > 0 AND p.id_produit != :current_id
            ORDER BY p.id_produit DESC
            LIMIT :limit
        ");
        $reqAutresProduits->bindValue(':current_id', $produitId, PDO::PARAM_INT);
        $reqAutresProduits->bindValue(':limit', (8 - count($produits)), PDO::PARAM_INT);
        $reqAutresProduits->execute();
        $autresProduits = $reqAutresProduits->fetchAll(PDO::FETCH_ASSOC);
        $produits = array_merge($produits, $autresProduits);
    }
} catch (PDOException $e) {
    $produits = [];
    error_log("Erreur récupération produits similaires : " . $e->getMessage());
}

?>
<!DOCTYPE html>
<html lang="en">
<body>
    <?php include_once '../includes/nav.php'; ?>
    <link rel="stylesheet" href="../assets/css/product_page.css">
    
    <main class="container">
        <div class="product-container animate-fade">
            <div class="product-image">
                <img src="<?php echo !empty($produit['image_url']) ? htmlspecialchars($produit['image_url']) : '../assets/images/office.png'; ?>"
                     alt="<?php echo htmlspecialchars($produit['nom_produit']); ?>">
            </div>
            <div class="product-info">
                <h1 class="product-title"><?php echo htmlspecialchars($produit['nom_produit']); ?></h1>
                <div class="product-price"><?php echo number_format($produit['prix'], 2); ?> MAD</div>
                <div class="product-rating">
                    <span class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </span>
                    <span class="review-count">(4.5/5 - Excellent)</span>
                </div>

                <div class="product-meta" style="margin: 15px 0;">
                    <div style="margin-bottom: 8px;">
                        <i class="fas fa-tag" style="color: #000; margin-right: 8px;"></i>
                        <span><strong>Catégorie:</strong> <?php echo htmlspecialchars($produit['nom_categorie']); ?></span>
                    </div>
                    <div style="margin-bottom: 8px;">
                        <i class="fas fa-box" style="color: #000; margin-right: 8px;"></i>
                        <span><strong>Stock:</strong> <?php echo $produit['quantite_stock']; ?> disponible<?php echo $produit['quantite_stock'] > 1 ? 's' : ''; ?></span>
                    </div>
                    <?php if ($produit['quantite_stock'] < 10): ?>
                        <div style="margin-bottom: 8px; color: #dc3545;">
                            <i class="fas fa-exclamation-triangle" style="margin-right: 8px;"></i>
                            <span><strong>Stock limité !</strong></span>
                        </div>
                    <?php endif; ?>
                </div>

                <p class="product-description">
                    <?php echo !empty($produit['description']) ? nl2br(htmlspecialchars($produit['description'])) : 'Description détaillée du produit à venir. Ce produit de qualité supérieure répondra à tous vos besoins et dépassera vos attentes.'; ?>
                </p>

                <div class="product-features" style="margin-bottom: 0;">
                    <div class="feature" style="margin-bottom: 5px;">
                        <i class="fas fa-check-circle"></i>
                        <span>Produit de qualité premium</span>
                    </div>
                    <div class="feature" style="margin-bottom: 5px;">
                        <i class="fas fa-check-circle"></i>
                        <span>Livraison rapide et sécurisée</span>
                    </div>
                    <div class="feature" style="margin-bottom: 5px;">
                        <i class="fas fa-check-circle"></i>
                        <span>Support client 24/7</span>
                    </div>
                    <div class="feature" style="margin-bottom: 5px;">
                        <i class="fas fa-check-circle"></i>
                        <span>Garantie satisfaction</span>
                    </div>
                    <div class="feature" style="margin-bottom: 0;">
                        <i class="fas fa-check-circle"></i>
                        <span>Paiement sécurisé</span>
                    </div>
                </div>

                <div class="product-quantity" style="margin: 20px 0; text-align: center;">
                    <label for="quantity" style="display: block; margin-bottom: 10px; font-weight: bold;">Quantité:</label>
                    <div class="quantity-controls" style="display: flex; align-items: center; gap: 10px; margin-bottom: 20px; justify-content: center;">
                        <button type="button" class="quantity-btn minus" onclick="changeQuantity(-1)"
                                style="background: #ccc; color: #333; border: none; padding: 8px 12px; border-radius: 4px; cursor: pointer;">-</button>
                        <input type="number" id="quantity" name="quantity" value="1" min="1" max="<?php echo $produit['quantite_stock']; ?>"
                               style="width: 80px; text-align: center; padding: 8px; border: 1px solid #ddd; border-radius: 4px; background: white;" readonly>
                        <button type="button" class="quantity-btn plus" onclick="changeQuantity(1)"
                                style="background: #ccc; color: #333; border: none; padding: 8px 12px; border-radius: 4px; cursor: pointer;">+</button>
                    </div>
                </div>

                <div class="product-actions">
                    <button class="cta-button add-to-cart-btn"
                            data-product-id="<?php echo $produit['id_produit']; ?>"
                            data-product-name="<?php echo htmlspecialchars($produit['nom_produit']); ?>"
                            data-product-price="<?php echo $produit['prix']; ?>"
                            data-product-image="<?php echo htmlspecialchars($produit['image_url']); ?>"
                            style="width: 80%; margin-right: 10px;">
                        <i class="fas fa-shopping-cart"></i> Ajouter au panier
                    </button>
                    <button class="btn-wishlist add-to-favorites-btn"
                            data-product-id="<?php echo $produit['id_produit']; ?>"
                            data-product-name="<?php echo htmlspecialchars($produit['nom_produit']); ?>"
                            data-product-price="<?php echo $produit['prix']; ?>"
                            data-product-image="<?php echo htmlspecialchars($produit['image_url']); ?>"
                            style="width: 15%; height: 50px; border: none; background: #fff; border: 1px solid #d8d8d8; border-radius: 8px; display: flex; align-items: center; justify-content: center; transition: all 0.3s ease;">
                        <svg width="24" height="24"><use xlink:href="#heart"></use></svg>
                    </button>
                </div>
            </div>
        </div>
        
         <!-- review client -->
<h2 class="title4"><strong>Découvrez <span class="highlight">les Avis </span>de Nos Clients</strong></h2>
<main class="container_review">
  <div class="marquee pause-on-hover" style="--total: 6;">
    <review-card name="Sophie" username="@Sophie" avatar="https://avatar.vercel.sh/jhon" content="Absolument incroyable. Je ne peux plus imaginer ma vie sans cela." style="--index: 1;"></review-card>
    <review-card name="Marc" username="@Marc" avatar="https://avatar.vercel.sh/jane" content="Vraiment impressionnant ! C’est un véritable changement de jeu." style="--index: 2;"></review-card>
    <review-card name="Élise" username="@Élise" avatar="https://avatar.vercel.sh/jack" content="Je n’aurais pas pu être plus heureuse. C’est fantastique." style="--index: 3;"></review-card>
    <review-card name="Julien" username="@Julien" avatar="https://avatar.vercel.sh/jill" content="Vraiment exceptionnel. Cela a dépassé toutes mes attentes." style="--index: 4;"></review-card>
    <review-card name="Claire" username="@Claire" avatar="https://avatar.vercel.sh/jenny" content="C’est exactement ce que je recherchais." style="--index: 5;"></review-card>
    <review-card name="Pierre" username="@Pierre" avatar="https://avatar.vercel.sh/james" content="Je suis impressionné ! Cela a fait une telle différence." style="--index: 6;"></review-card>
  </div>

  <div class="marquee pause-on-hover reverse" style="--total: 6;">
    <review-card name="Léa" username="@Léa" avatar="https://avatar.vercel.sh/emily" content="Vraiment exceptionnel. Ma journée a changé grâce à cela. Je le recommande vivement." style="--index: 1;"></review-card>
    <review-card name="Alexandre" username="@Alexandre" avatar="https://avatar.vercel.sh/olivia" content="C’est tout simplement incroyable. Cela a révolutionné mes habitudes. À ne surtout pas manquer." style="--index: 2;"></review-card>
    <review-card name="Inès" username="@Inès" avatar="https://avatar.vercel.sh/william" content="Phénoménal. Cela a totalement amélioré ma routine. Je le recommande sans hésiter." style="--index: 3;"></review-card>
    <review-card name="Louis" username="@Louis" avatar="https://avatar.vercel.sh/charlotte" content="Un produit incroyable. Il a transformé ma façon de fonctionner au quotidien." style="--index: 4;"></review-card>
    <review-card name="Juliette" username="@Juliette" avatar="https://avatar.vercel.sh/michael" content="Absolument génial. Ma routine quotidienne est beaucoup plus simple maintenant." style="--index: 5;"></review-card>
    <review-card name="Maxime" username="@Maxime" avatar="https://avatar.vercel.sh/elizabeth" content="Complètement impressionnée. Cela a véritablement changé ma manière de vivre au quotidien." style="--index: 6;"></review-card>
  </div>
</main>
<br>
<br>

        <!-- best product -->
    <section class="py-5 overflow-hidden">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">

            <div class="section-header d-flex justify-content-between">
              
              <h2 class="section-title">Produits les plus populaires</h2>

              <div class="d-flex align-items-center">
                <a href="products.php" class="btn-link text-decoration-none">Voir toutes les Produits →</a>
                <div class="swiper-buttons">
                  <button class="swiper-prev products-carousel-prev btn btn-primary">❮</button>
                  <button class="swiper-next products-carousel-next btn btn-primary">❯</button>
                </div>  
              </div>
            </div>
            
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">

            <div class="products-carousel swiper">
              <div class="swiper-wrapper">
                
                <?php if (!empty($produits)): ?>
                    <?php foreach ($produits as $produitSimilaire): ?>
                        <div class="product-item swiper-slide">
                          <button class="btn-wishlist add-to-favorites-btn"
                                  data-product-id="<?php echo $produitSimilaire['id_produit']; ?>"
                                  data-product-name="<?php echo htmlspecialchars($produitSimilaire['nom_produit']); ?>"
                                  data-product-price="<?php echo $produitSimilaire['prix']; ?>"
                                  data-product-image="<?php echo !empty($produitSimilaire['image_url']) ? htmlspecialchars($produitSimilaire['image_url']) : '../assets/images/office.png'; ?>">
                            <svg width="24" height="24"><use xlink:href="#heart"></use></svg>
                          </button>
                          <figure>
                            <a href="product_page.php?id=<?php echo $produitSimilaire['id_produit']; ?>" title="<?php echo htmlspecialchars($produitSimilaire['nom_produit']); ?>">
                              <img src="<?php echo !empty($produitSimilaire['image_url']) ? htmlspecialchars($produitSimilaire['image_url']) : '../assets/images/office.png'; ?>" class="tab-image" alt="<?php echo htmlspecialchars($produitSimilaire['nom_produit']); ?>">
                            </a>
                          </figure>
                          <h3><?php echo htmlspecialchars($produitSimilaire['nom_produit']); ?></h3>
                          <span class="qty"><?php echo htmlspecialchars($produitSimilaire['quantite_stock']); ?> en stock</span>
                          <span class="rating"><svg width="24" height="24" class="text-primary"><use xlink:href="#star-solid"></use></svg> 4.5</span>
                          <span class="price"><?php echo number_format($produitSimilaire['prix'], 2); ?> MAD</span>
                          <div class="d-flex align-items-center justify-content-between">
                            <div class="input-group product-qty">
                                <span class="input-group-btn">
                                    <button type="button" class="quantity-left-minus btn btn-danger btn-number" data-type="minus">
                                      <svg width="16" height="16"><use xlink:href="#minus"></use></svg>
                                    </button>
                                </span>
                                <input type="text" id="quantity_<?php echo $produitSimilaire['id_produit']; ?>" name="quantity" class="form-control input-number" value="1" data-max-stock="<?php echo $produitSimilaire['quantite_stock']; ?>">
                                <span class="input-group-btn">
                                    <button type="button" class="quantity-right-plus btn btn-success btn-number" data-type="plus">
                                        <svg width="16" height="16"><use xlink:href="#plus"></use></svg>
                                    </button>
                                </span>
                            </div>
                            <a href="#" class="nav-link">Add to Cart <iconify-icon icon="uil:shopping-cart"></a>
                          </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="product-item swiper-slide">
                        <div class="text-center p-4">
                            <p>Aucun produit disponible pour le moment.</p>
                        </div>
                    </div>
                <?php endif; ?>

              </div>
            </div>
            <!-- / products-carousel -->

          </div>
        </div>
      </div>
    </section>

    </main>

    <script>
        // Fonction pour changer la quantité
        function changeQuantity(change) {
            const quantityInput = document.getElementById('quantity');
            let currentValue = parseInt(quantityInput.value) || 1;
            let newValue = currentValue + change;

            const minValue = parseInt(quantityInput.min) || 1;
            const maxValue = parseInt(quantityInput.max) || <?php echo $produit['quantite_stock']; ?>;

            if (newValue >= minValue && newValue <= maxValue) {
                quantityInput.value = newValue;
            }

            if (newValue >= maxValue) {
                alert('Stock maximum atteint: ' + maxValue);
            }
        }

        // Fonction personnalisée pour ajouter au panier avec quantité
        document.addEventListener('DOMContentLoaded', function() {
            const addToCartBtn = document.querySelector('.add-to-cart-btn');
            if (addToCartBtn) {
                addToCartBtn.addEventListener('click', function(e) {
                    e.preventDefault();

                    const quantity = document.getElementById('quantity').value;
                    const productData = {
                        id: parseInt(this.dataset.productId),
                        name: this.dataset.productName,
                        price: parseFloat(this.dataset.productPrice),
                        image: this.dataset.productImage,
                        quantity: parseInt(quantity)
                    };

                    if (window.cartManager) {
                        window.cartManager.addToCart(productData);
                    }
                });
            }
        });

        // Gestion des boutons + et - pour les produits similaires
        document.addEventListener('DOMContentLoaded', function() {
            // Boutons pour diminuer la quantité
            document.querySelectorAll('.quantity-left-minus').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const input = this.closest('.product-qty').querySelector('.input-number');
                    let currentValue = parseInt(input.value) || 1;
                    if (currentValue > 1) {
                        input.value = currentValue - 1;
                    }
                });
            });

            // Boutons pour augmenter la quantité
            document.querySelectorAll('.quantity-right-plus').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const input = this.closest('.product-qty').querySelector('.input-number');
                    let currentValue = parseInt(input.value) || 1;
                    const maxStock = parseInt(input.getAttribute('data-max-stock')) || 999;
                    if (currentValue < maxStock) {
                        input.value = currentValue + 1;
                    } else {
                        alert(`Stock maximum disponible: ${maxStock}`);
                    }
                });
            });

            // Validation directe dans les champs input
            document.querySelectorAll('.input-number').forEach(input => {
                input.addEventListener('change', function() {
                    let value = parseInt(this.value) || 1;
                    const maxStock = parseInt(this.getAttribute('data-max-stock')) || 999;

                    if (value < 1) {
                        this.value = 1;
                    } else if (value > maxStock) {
                        this.value = maxStock;
                        alert(`Stock maximum disponible: ${maxStock}`);
                    }
                });

                // Empêcher la saisie de caractères non numériques
                input.addEventListener('keypress', function(e) {
                    if (!/[0-9]/.test(e.key) && !['Backspace', 'Delete', 'Tab', 'Enter'].includes(e.key)) {
                        e.preventDefault();
                    }
                });
            });
        });
    </script>

    <?php include_once '../includes/footer.php'; ?>
    <script src="../assets/js/favoris.js"></script>
</body>
</html>