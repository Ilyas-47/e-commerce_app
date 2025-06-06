<?php
require_once('../connection/connection.php');

// Récupération des catégories
try {
    $reqCategories = $pdo->prepare("SELECT id_categorie, nom_categorie FROM categories ORDER BY nom_categorie ASC");
    $reqCategories->execute();
    $categories = $reqCategories->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $categories = [];
    error_log("Erreur récupération catégories : " . $e->getMessage());
}

// Récupération des produits avec leurs catégories (limité aux 8 plus populaires)
try {
    $reqProduits = $pdo->prepare("
        SELECT p.id_produit, p.nom_produit, p.description, p.prix, p.quantite_stock, p.image_url, c.nom_categorie
        FROM produits p
        LEFT JOIN categories c ON p.id_categorie = c.id_categorie
        WHERE p.quantite_stock > 0
        ORDER BY p.id_produit DESC
        LIMIT 8
    ");
    $reqProduits->execute();
    $produits = $reqProduits->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $produits = [];
    error_log("Erreur récupération produits : " . $e->getMessage());
}

// Récupération des produits par catégorie pour les dropdowns
$produitsParCategorie = [];
try {
    $reqProduitsCategorie = $pdo->prepare("
        SELECT p.id_produit, p.nom_produit, p.id_categorie
        FROM produits p
        WHERE p.quantite_stock > 0
        ORDER BY p.nom_produit ASC
    ");
    $reqProduitsCategorie->execute();
    $allProduits = $reqProduitsCategorie->fetchAll(PDO::FETCH_ASSOC);

    // Organiser les produits par catégorie
    foreach ($allProduits as $produit) {
        $produitsParCategorie[$produit['id_categorie']][] = $produit;
    }
} catch (PDOException $e) {
    error_log("Erreur récupération produits par catégorie : " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<body>
    <?php include('../includes/nav.php') ?>
    <section class="py-3" style="background-color:white; background-repeat: no-repeat; background-size: cover;">
               <!-- nav -->
<div class="input">
    <?php if (!empty($categories)): ?>
        <?php foreach ($categories as $categorie): ?>
            <button class="value">
                <?php echo htmlspecialchars($categorie['nom_categorie']); ?>
                <div class="dropdown-menu">
                    <?php
                    // Afficher les produits de cette catégorie
                    if (isset($produitsParCategorie[$categorie['id_categorie']])):
                        foreach ($produitsParCategorie[$categorie['id_categorie']] as $produit):
                    ?>
                        <a href="../user/product_page.php?id=<?php echo $produit['id_produit']; ?>">
                            <?php echo htmlspecialchars($produit['nom_produit']); ?>
                        </a>
                    <?php
                        endforeach;
                    else:
                    ?>
                        <a href="../user/products.php?categorie=<?php echo $categorie['id_categorie']; ?>">
                            Voir tous les produits
                        </a>
                    <?php endif; ?>
                </div>
            </button>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Aucune catégorie disponible pour le moment.</p>
    <?php endif; ?>
</div>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="banner-blocks">
          <!-- Bloc 1: Carrousel principal -->
          <div class="banner-ad large bg-info block-1">
            <div class="swiper main-swiper">
              <div class="swiper-wrapper">
                
                <!-- Slide 1: Solutions Digitales -->
                <div class="swiper-slide">
                  <div class="row banner-content p-5">
                    <div class="content-wrapper col-md-7">
                      <div class="categories my-3" style="color:#FFCE0A">Nouveautés</div>
                      <h3 class="display-4">Solutions Digitales</h3>
                      <p>Découvrez notre nouvelle gamme de solutions digitales pour transformer votre entreprise.</p>
                      <a href="products.php" class="btn btn-outline-dark btn-lg text-uppercase fs-6 rounded-1 px-4 py-3 mt-3">Explorer</a>
                    </div>
                    <div class="img-wrapper col-md-5">
                      <img src="../assets/images/office.png" class="img-fluid" alt="Digital Solutions">
                    </div>
                  </div>
                </div>
                
                <!-- Slide 2: Pack Entreprise -->
                <div class="swiper-slide">
                  <div class="row banner-content p-5">
                    <div class="content-wrapper col-md-7">
                      <div class="categories mb-3 pb-3" style="color:#FFCE0A" >Offre Spéciale</div>
                      <h3 class="banner-title">Pack Entreprise</h3>
                      <p>Profitez de nos offres exclusives sur les logiciels professionnels essentiels.</p>
                      <a href="products.php" class="btn btn-outline-dark btn-lg text-uppercase fs-6 rounded-1">Découvrir</a>
                    </div>
                    <div class="img-wrapper col-md-5">
                      <img src="../assets/images/office.png" class="img-fluid" alt="Business Pack">
                    </div>
                  </div>
                </div>
                
                <!-- Slide 3: Solutions Cloud (comme montré dans la capture d'écran) -->
                <div class="swiper-slide">
                  <div class="row banner-content p-5">
                    <div class="content-wrapper col-md-7">
                      <div class="categories mb-3 pb-3" style="color:#FFCE0A">Services Cloud</div>
                      <h3 class="banner-title display-4">Solutions Cloud</h3>
                      <p>Optimisez votre infrastructure avec nos solutions cloud performantes et sécurisées.</p>
                      <a href="products.php" class="btn btn-outline-dark btn-lg text-uppercase fs-6 rounded-1 px-4 py-3 mt-3">En Savoir Plus</a>
                    </div>
                    <div class="img-wrapper col-md-5">
                      <img src="../assets/images/office.png" class="img-fluid" alt="Cloud Solutions">
                    </div>
                  </div>
                </div>
              </div>
              
              <!-- Points de navigation du carrousel -->
              <div class="swiper-pagination"></div>
            </div>
          </div>
           
          <!-- Bloc 2: Promotion -30% sur les Licences -->
           <!-- <div class="banner-ad bg-light block-2">
            <div class="row banner-content p-5">
              <div class="content-wrapper col-md-7">
                <div class="categories sale mb-3 pb-3">Promotion</div>
                <h3 class="banner-title">-30% sur les Licences</h3>
                <a href="#" class="d-flex align-items-center nav-link">Voir les offres <svg width="24" height="24"><use xlink:href="#arrow-right"></use></svg></a>
              </div> 
              <div class="col-md-5 p-0 position-relative">
                <div class="image-container h-100">
                  <div class="purple-accent" style="background-color: #8A2BE2; position: absolute; top: 0; right: 0; width: 20%; height: 100%;"></div>
                  <img src="../assets/images/office.png" class="img-fluid position-absolute top-50 start-50 translate-middle" alt="Office Package" style="max-height: 80%; max-width: 80%; z-index: 1;">
                </div>
              </div>
            </div>
          </div>  -->

          <!-- Bloc 3: Support Premium 24/7 -->
          <!-- <div class="banner-ad bg-light block-3">
            <div class="row banner-content p-5">
              <div class="content-wrapper col-md-7">
                <div class="categories sale mb-3 pb-3">Nouveauté</div>
                <h3 class="item-title">Support Premium 24/7</h3>
                <a href="#" class="d-flex align-items-center nav-link">En savoir plus<svg width="24" height="24"><use xlink:href="#arrow-right"></use></svg></a>
              </div> 
               <div class="col-md-5 p-0 position-relative">
                <div class="image-container h-100">
                  <div class="purple-accent" style="background-color: #8A2BE2; position: absolute; top: 0; right: 0; width: 20%; height: 100%;"></div>
                  <img src="../assets/images/support.png" class="img-fluid position-absolute top-50 start-50 translate-middle" alt="Support 24/7" style="max-height: 80%; max-width: 80%; z-index: 1;">
                </div>
              </div>
            </div>
          </div>

        </div> -->
        <!-- / Banner Blocks -->
          
      </div>
    </div>
  </div>
   
  <!-- Script d'initialisation du Swiper -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const swiper = new Swiper('.main-swiper', {
        pagination: {
          el: '.swiper-pagination',
          clickable: true
        },
        autoplay: {
          delay: 5000,
        },
      });

      // Initialisation du carrousel des produits
      const productsSwiper = new Swiper('.products-carousel', {
        slidesPerView: 'auto',
        spaceBetween: 20,
        navigation: {
          nextEl: '.products-carousel-next',
          prevEl: '.products-carousel-prev',
        },
        breakpoints: {
          640: {
            slidesPerView: 2,
          },
          768: {
            slidesPerView: 3,
          },
          1024: {
            slidesPerView: 4,
          },
        }
      });

      // Gestion des boutons + et - pour la quantité
      function setupQuantityButtons() {
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
      }

      // Initialiser les boutons de quantité
      setupQuantityButtons();
    });
  </script>
</section>

<style>
/* Styles généraux pour le bloc de bannières */
.banner-blocks {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  grid-template-rows: auto;
  gap: 20px;
  grid-template-areas:
    "block-1 block-1"
    "block-2 block-3";

}

/* Styles pour le bloc principal du carrousel */
.banner-blocks .block-1 {
  grid-area: block-1;
  background-color: #f0f8ff !important; /* Fond bleu clair comme dans la capture */
  border-radius: 8px;
  overflow: hidden;
}

/* Styles pour les titres et catégories */
.categories {
  font-size: 1rem;
  font-weight: 500;
  color: #666;
  text-transform: uppercase;
}

.categories.sale {
  position: relative;
  display: inline-block;
  padding-bottom: 10px;
}

.categories.sale:after {
  content: "";
  display: block;
  width: 40px;
  height: 2px;
  background-color: #333;
  position: absolute;
  bottom: 0;
  left: 0;
}

.text-purple {
  color: #FFCE0A;
}

.banner-title {
  font-weight: 700;
  margin-bottom: 1rem;
}

/* Styles pour le carrousel */
.swiper-pagination-bullet {
  width: 10px;
  height: 10px;
  margin: 0 5px;
}

.swiper-pagination-bullet-active {
  background-color: #FFCE0A; /* Bullet actif en jaune comme dans la capture */
}

/* Ajustements pour les boutons */
.btn-outline-dark {
  border: 2px solid #333;
  font-weight: 600;
}

/* Conteneur d'image avec accent violet */
.image-container {
  position: relative;
  width: 100%;
  overflow: hidden;
}

.purple-accent {
  position: absolute;
  top: 0;
  right: 0;
  width: 20%;
  height: 100%;
  background-color: #FFCE0A;
}

/* Styles pour les liens "Voir les offres" et "En savoir plus" */
.banner-ad a.nav-link {
  color: #333;
  font-weight: 500;
  text-decoration: none;
}

.banner-ad a.nav-link svg {
  margin-left: 5px;
  transition: transform 0.3s ease;
}

.banner-ad a.nav-link:hover svg {
  transform: translateX(5px);
}

/* Styles spécifiques pour la version mobile */
@media (max-width: 768px) {
  .banner-blocks {
    grid-template-columns: 1fr;
    grid-template-areas:
      "block-1"
      "block-2"
      "block-3";
  }
}

/* Styles pour uniformiser les cartes de produits */
.products-carousel .product-item {
  height: 450px !important;
  display: flex !important;
  flex-direction: column !important;
  justify-content: space-between !important;
  min-width: 280px !important;
  max-width: 320px !important;
}

.products-carousel .product-item figure {
  height: 200px !important;
  display: flex !important;
  align-items: center !important;
  justify-content: center !important;
  margin-bottom: 15px !important;
}

.products-carousel .product-item figure img {
  max-height: 180px !important;
  max-width: 100% !important;
  object-fit: contain !important;
}

.products-carousel .product-item h3 {
  height: 50px !important;
  overflow: hidden !important;
  display: -webkit-box !important;
  -webkit-line-clamp: 2 !important;
  -webkit-box-orient: vertical !important;
  margin-bottom: 10px !important;
  font-size: 16px !important;
  line-height: 1.3 !important;
}

.products-carousel .product-item .qty,
.products-carousel .product-item .rating {
  margin-bottom: 8px !important;
  display: inline-block !important;
  margin-right: 15px !important;
}

.products-carousel .product-item .price {
  margin-bottom: 15px !important;
  font-size: 20px !important;
  font-weight: bold !important;
}

.products-carousel .product-item .d-flex {
  margin-top: auto !important;
  align-items: center !important;
}

/* Ajustements pour le carrousel Swiper */
.products-carousel .swiper-slide {
  height: auto !important;
  display: flex !important;
}

.products-carousel .swiper-wrapper {
  align-items: stretch !important;
}
</style>

    <!-- slides logos -->

<!-- <div class="slider">
	<div class="slide-track">
		<div class="slide">
			<img src="../assets/images/netflix.png" height="30" width="120" alt="Netflix" />
		</div>
		<div class="slide">
			<img src="../assets/images/netflix.png" height="30" width="120" alt="Netflix" />
		</div>
		<div class="slide">
			<img src="../assets/images/netflix.png" height="30" width="120" alt="Netflix" />
		</div>
		<div class="slide">
			<img src="../assets/images/netflix.png" height="30" width="120" alt="Netflix" />
		</div>
		<div class="slide">
			<img src="../assets/images/netflix.png" height="30" width="120" alt="Netflix" />
		</div>
		<div class="slide">
			<img src="../assets/images/netflix.png" height="30" width="120" alt="Netflix" />
		</div>
		<div class="slide">
			<img src="../assets/images/netflix.png" height="30" width="120" alt="Netflix" />
		</div>
		<div class="slide">
			<img src="../assets/images/netflix.png" height="30" width="120" alt="Netflix" />
		</div>
		<div class="slide">
			<img src="../assets/images/netflix.png" height="30" width="120" alt="Netflix" />
		</div>
		<div class="slide">
			<img src="../assets/images/netflix.png" height="30" width="120" alt="Netflix" />
		</div>
	</div>
</div>
  -->

 

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
                    <?php foreach ($produits as $produit): ?>
                        <div class="product-item swiper-slide">
                          <button class="btn-wishlist add-to-favorites-btn"
                                  data-product-id="<?php echo $produit['id_produit']; ?>"
                                  data-product-name="<?php echo htmlspecialchars($produit['nom_produit']); ?>"
                                  data-product-price="<?php echo $produit['prix']; ?>"
                                  data-product-image="<?php echo !empty($produit['image_url']) ? htmlspecialchars($produit['image_url']) : '../assets/images/office.png'; ?>">
                            <svg width="24" height="24"><use xlink:href="#heart"></use></svg>
                          </button>
                          <figure>
                            <a href="product_page.php?id=<?php echo $produit['id_produit']; ?>" title="<?php echo htmlspecialchars($produit['nom_produit']); ?>">
                              <img src="<?php echo !empty($produit['image_url']) ? htmlspecialchars($produit['image_url']) : '../assets/images/office.png'; ?>" class="tab-image" alt="<?php echo htmlspecialchars($produit['nom_produit']); ?>">
                            </a>
                          </figure>
                          <h3><?php echo htmlspecialchars($produit['nom_produit']); ?></h3>
                          <span class="qty"><?php echo htmlspecialchars($produit['quantite_stock']); ?> en stock</span>
                          <span class="rating"><svg width="24" height="24" class="text-primary"><use xlink:href="#star-solid"></use></svg> 4.5</span>
                          <span class="price"><?php echo number_format($produit['prix'], 2); ?> MAD</span>
                          <div class="d-flex align-items-center justify-content-between">
                            <div class="input-group product-qty">
                                <span class="input-group-btn">
                                    <button type="button" class="quantity-left-minus btn btn-danger btn-number" data-type="minus">
                                      <svg width="16" height="16"><use xlink:href="#minus"></use></svg>
                                    </button>
                                </span>
                                <input type="text" id="quantity_<?php echo $produit['id_produit']; ?>" name="quantity" class="form-control input-number" value="1" data-max-stock="<?php echo $produit['quantite_stock']; ?>">
                                <span class="input-group-btn">
                                    <button type="button" class="quantity-right-plus btn btn-success btn-number" data-type="plus">
                                        <svg width="16" height="16"><use xlink:href="#plus"></use></svg>
                                    </button>
                                </span>
                            </div>
                            <button class="nav-link add-to-cart-btn"
                                    data-product-id="<?php echo $produit['id_produit']; ?>"
                                    data-product-name="<?php echo htmlspecialchars($produit['nom_produit']); ?>"
                                    data-product-price="<?php echo $produit['prix']; ?>"
                                    data-product-image="<?php echo htmlspecialchars($produit['image_url']); ?>"
                                    style="border: none; background: none;">
                                Ajouter au panier <iconify-icon icon="uil:shopping-cart"></iconify-icon>
                            </button>
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


  <div class="container">
    <div class="left">
      <h1>Pourquoi nous choisir</h1>
      <p>
        Nous sommes fiers d'offrir une qualité et un service exceptionnels qui se démarquent dans l'industrie. Notre engagement envers l'excellence garantit que chaque client reçoit une attention personnalisée et des solutions innovantes adaptées à ses besoins uniques. Avec des années d'expertise et une passion pour ce que nous faisons, nous nous engageons à dépasser vos attentes et à vous aider à atteindre vos objectifs.
      </p>
    </div>
    <div class="right">
      <div class="feature">
        <div class="icon">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
            <path d="M19.63 3.65a1 1 0 0 0-.84-.2a8 8 0 0 1-6.22-1.27a1 1 0 0 0-1.14 0a8 8 0 0 1-6.22 1.27a1 1 0 0 0-.84.2a1 1 0 0 0-.37.78v7.45a9 9 0 0 0 3.77 7.33l3.65 2.6a1 1 0 0 0 1.16 0l3.65-2.6A9 9 0 0 0 20 11.88V4.43a1 1 0 0 0-.37-.78ZM18 11.88a7 7 0 0 1-2.93 5.7L12 19.77l-3.07-2.19A7 7 0 0 1 6 11.88v-6.3a10 10 0 0 0 6-1.39a10 10 0 0 0 6 1.39Zm-4.46-2.29l-2.69 2.7l-.89-.9a1 1 0 0 0-1.42 1.42l1.6 1.6a1 1 0 0 0 1.42 0L15 11a1 1 0 0 0-1.42-1.42Z"/>
          </svg>
        </div>
        <div class="text">
          <h3>Sécurité de confiance</h3>
          <p>Nous mettons en œuvre des mesures de sécurité de pointe pour protéger vos données et assurer une tranquillité d'esprit totale lors de chaque interaction.</p>
        </div>
      </div>
      <div class="feature">
        <div class="icon">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
            <path d="M19.63 3.65a1 1 0 0 0-.84-.2a8 8 0 0 1-6.22-1.27a1 1 0 0 0-1.14 0a8 8 0 0 1-6.22 1.27a1 1 0 0 0-.84.2a1 1 0 0 0-.37.78v7.45a9 9 0 0 0 3.77 7.33l3.65 2.6a1 1 0 0 0 1.16 0l3.65-2.6A9 9 0 0 0 20 11.88V4.43a1 1 0 0 0-.37-.78ZM18 11.88a7 7 0 0 1-2.93 5.7L12 19.77l-3.07-2.19A7 7 0 0 1 6 11.88v-6.3a10 10 0 0 0 6-1.39a10 10 0 0 0 6 1.39Zm-4.46-2.29l-2.69 2.7l-.89-.9a1 1 0 0 0-1.42 1.42l1.6 1.6a1 1 0 0 0 1.42 0L15 11a1 1 0 0 0-1.42-1.42Z"/>
          </svg>
        </div>
        <div class="text">
          <h3>Support Expert</h3>
          <p>Notre équipe dédiée de professionnels fournit un support réactif et compétent chaque fois que vous avez besoin d'assistance ou de conseils.</p>
        </div>
      </div>
      <div class="feature">
        <div class="icon">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
            <path d="M19.63 3.65a1 1 0 0 0-.84-.2a8 8 0 0 1-6.22-1.27a1 1 0 0 0-1.14 0a8 8 0 0 1-6.22 1.27a1 1 0 0 0-.84.2a1 1 0 0 0-.37.78v7.45a9 9 0 0 0 3.77 7.33l3.65 2.6a1 1 0 0 0 1.16 0l3.65-2.6A9 9 0 0 0 20 11.88V4.43a1 1 0 0 0-.37-.78ZM18 11.88a7 7 0 0 1-2.93 5.7L12 19.77l-3.07-2.19A7 7 0 0 1 6 11.88v-6.3a10 10 0 0 0 6-1.39a10 10 0 0 0 6 1.39Zm-4.46-2.29l-2.69 2.7l-.89-.9a1 1 0 0 0-1.42 1.42l1.6 1.6a1 1 0 0 0 1.42 0L15 11a1 1 0 0 0-1.42-1.42Z"/>
          </svg>
        </div>
        <div class="text">
          <h3>Garantie Qualité</h3>
          <p>Nous soutenons nos services avec une garantie de satisfaction, assurant que chaque solution que nous livrons répond aux plus hauts standards d'excellence.</p>
        </div>
      </div>
    </div>
  </div>

 <section class="section-numbers">
  <h1>Des chiffres qui parlent</h1>
  <h2>Notre impact en données</h2>

  <div class="stats">
    <div class="stat-block">
      <div class="number">5,000+</div>
      <div class="description">Clients satisfaits à travers le monde</div>
    </div>
    <div class="stat-block">
      <div class="number">50,000+</div>
      <div class="description">Solutions livrées avec succès</div>
    </div>
  </div>
</section>
 
    <!-- section benifices -->
     <br>
     <div class="features-container">   
        <div class="feature-item">
            <div class="feature-icon">🔒</div>
            <h3 class="feature-title">Paiement 100% sécurisé</h3>
            <p class="feature-description">Vos transactions sont protégées par un système de cryptage avancé pour une sécurité optimale.</p>
        </div>
        
        <div class="feature-item">
            <div class="feature-icon">🏪</div>
            <h3 class="feature-title">Garantie qualité</h3>
            <p class="feature-description">Tous nos produits sont soumis à des contrôles rigoureux pour vous assurer une qualité irréprochable.</p>
        </div>
        
        <div class="feature-item">
            <div class="feature-icon">💬</div>
            <h3 class="feature-title">Économies garanties</h3>
            <p class="feature-description">Nous vous proposons les meilleurs prix du marché avec notre garantie du meilleur prix.</p>
        </div>
        
        <div class="feature-item">
            <div class="feature-icon">🎁</div>
            <h3 class="feature-title">Offres quotidiennes</h3>
            <p class="feature-description">Découvrez chaque jour de nouvelles promotions exclusives sur une sélection de produits.</p>
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
<br>
<br>

    <?php include('../includes/footer.php') ?>

    <script>
    // Script de débogage pour les favoris
    document.addEventListener('DOMContentLoaded', function() {
        console.log('Page chargée, vérification du FavoritesManager...');

        // Attendre un peu que le script favoris.js se charge
        setTimeout(function() {
            if (window.favoritesManager) {
                console.log('✅ FavoritesManager trouvé !');
                console.log('Nombre de favoris actuels:', window.favoritesManager.getFavoritesCount());

                // Tester les boutons de favoris
                const favoriteButtons = document.querySelectorAll('.add-to-favorites-btn');
                console.log('Nombre de boutons de favoris trouvés:', favoriteButtons.length);

                favoriteButtons.forEach((btn, index) => {
                    console.log(`Bouton ${index + 1}:`, {
                        id: btn.dataset.productId,
                        name: btn.dataset.productName,
                        price: btn.dataset.productPrice,
                        image: btn.dataset.productImage
                    });
                });
            } else {
                console.error('❌ FavoritesManager non trouvé !');
            }
        }, 500);

        // Ajouter un listener pour tester les clics
        document.addEventListener('click', function(e) {
            if (e.target.closest('.add-to-favorites-btn')) {
                console.log('🖱️ Clic sur bouton favoris détecté !');
                const btn = e.target.closest('.add-to-favorites-btn');
                console.log('Données du produit:', {
                    id: btn.dataset.productId,
                    name: btn.dataset.productName,
                    price: btn.dataset.productPrice,
                    image: btn.dataset.productImage
                });
            }
        });
    });
    </script>
</body>
</html>