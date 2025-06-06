<?php
require_once('../connection/connection.php');

// Paramètres de pagination
$produitsParPage = 12;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $produitsParPage;

// Paramètres de filtrage
$categorieFilter = isset($_GET['categorie']) ? (int)$_GET['categorie'] : null;
$prixMin = isset($_GET['prix_min']) ? (float)$_GET['prix_min'] : null;
$prixMax = isset($_GET['prix_max']) ? (float)$_GET['prix_max'] : null;
$sortBy = isset($_GET['sort']) ? $_GET['sort'] : 'id_desc';

// Construction de la requête avec filtres
$whereConditions = ["p.quantite_stock > 0"];
$params = [];

if ($categorieFilter) {
    $whereConditions[] = "p.id_categorie = :categorie";
    $params[':categorie'] = $categorieFilter;
}

if ($prixMin !== null) {
    $whereConditions[] = "p.prix >= :prix_min";
    $params[':prix_min'] = $prixMin;
}

if ($prixMax !== null) {
    $whereConditions[] = "p.prix <= :prix_max";
    $params[':prix_max'] = $prixMax;
}

$whereClause = implode(' AND ', $whereConditions);

// Définition du tri
$orderBy = "p.id_produit DESC";
switch ($sortBy) {
    case 'price-asc':
        $orderBy = "p.prix ASC";
        break;
    case 'price-desc':
        $orderBy = "p.prix DESC";
        break;
    case 'name-asc':
        $orderBy = "p.nom_produit ASC";
        break;
    case 'name-desc':
        $orderBy = "p.nom_produit DESC";
        break;
    case 'popular':
        $orderBy = "p.id_produit DESC"; // Peut être modifié selon la logique de popularité
        break;
}

try {
    // Récupération des catégories pour les filtres
    $reqCategories = $pdo->prepare("SELECT id_categorie, nom_categorie FROM categories ORDER BY nom_categorie ASC");
    $reqCategories->execute();
    $categories = $reqCategories->fetchAll(PDO::FETCH_ASSOC);

    // Comptage total des produits (pour pagination)
    $countQuery = "SELECT COUNT(*) as total FROM produits p LEFT JOIN categories c ON p.id_categorie = c.id_categorie WHERE $whereClause";
    $reqCount = $pdo->prepare($countQuery);
    foreach ($params as $key => $value) {
        $reqCount->bindValue($key, $value);
    }
    $reqCount->execute();
    $totalProduits = $reqCount->fetch(PDO::FETCH_ASSOC)['total'];
    $totalPages = ceil($totalProduits / $produitsParPage);

    // Récupération des produits avec pagination
    $query = "
        SELECT p.id_produit, p.nom_produit, p.description, p.prix, p.quantite_stock, p.image_url, c.nom_categorie
        FROM produits p
        LEFT JOIN categories c ON p.id_categorie = c.id_categorie
        WHERE $whereClause
        ORDER BY $orderBy
        LIMIT :limit OFFSET :offset
    ";

    $reqProduits = $pdo->prepare($query);
    foreach ($params as $key => $value) {
        $reqProduits->bindValue($key, $value);
    }
    $reqProduits->bindValue(':limit', $produitsParPage, PDO::PARAM_INT);
    $reqProduits->bindValue(':offset', $offset, PDO::PARAM_INT);
    $reqProduits->execute();
    $produits = $reqProduits->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    $categories = [];
    $produits = [];
    $totalProduits = 0;
    $totalPages = 1;
    error_log("Erreur récupération produits : " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="fr">
<body>
    <?php include_once '../includes/nav.php'; ?>
    <link rel="stylesheet" type="text/css" href="../assets/css/products.css">
    <header class="page-header">
        <h1>Nos produits</h1>
    </header>

    <div class="products-container">
        <button class="filters-mobile-btn">
            <i class="fas fa-sliders-h"></i> Filtrer les produits
        </button>
        
        <aside class="filters">
            <button class="filters-close">&times;</button>
            
            <div class="filter-group">
                <h3><i class="fas fa-tags"></i> Catégories</h3>
                <div class="filter-options">
                    <?php if (!empty($categories)): ?>
                        <?php foreach ($categories as $categorie): ?>
                            <label class="filter-checkbox">
                                <input type="checkbox" name="category" value="<?php echo $categorie['id_categorie']; ?>"
                                       <?php echo ($categorieFilter == $categorie['id_categorie']) ? 'checked' : ''; ?>>
                                <?php echo htmlspecialchars($categorie['nom_categorie']); ?>
                            </label>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>Aucune catégorie disponible</p>
                    <?php endif; ?>
                </div>
            </div>

            <div class="filter-group">
                <h3><i class="fas fa-coins"></i> Prix</h3>
                <div class="price-range">
                    <div class="price-inputs">
                        <input type="number" class="price-input" name="prix_min" placeholder="Min" min="0"
                               value="<?php echo $prixMin ? $prixMin : ''; ?>">
                        <input type="number" class="price-input" name="prix_max" placeholder="Max" min="0"
                               value="<?php echo $prixMax ? $prixMax : ''; ?>">
                    </div>
                    <button class="apply-price" onclick="applyFilters()">Appliquer</button>
                </div>
            </div>

            <!-- <div class="filter-group">
                <h3><i class="fas fa-laptop"></i> Lorem Ipsum</h3>
                <select class="filter-select" name="system">
                    <option value="">Lorem ipsum</option>
                    <option value="opt1">Lorem 1</option>
                    <option value="opt2">Lorem 2</option>
                    <option value="opt3">Lorem 3</option>
                    <option value="opt4">Lorem 4</option>
                </select>
            </div> -->

            <!-- <div class="filter-group">
                <h3><i class="fas fa-calendar-alt"></i> Lorem</h3>
                <select class="filter-select" name="year">
                    <option value="">Lorem ipsum</option>
                    <option value="2024">Lorem 1</option>
                    <option value="2023">Lorem 2</option>
                    <option value="2022">Lorem 3</option>
                    <option value="2021">Lorem 4</option>
                </select>
            </div> -->
            
            <!-- <div class="filter-group">
                <h3><i class="fas fa-user-tie"></i> Lorem Ipsum</h3>
                <div class="filter-options">
                    <label class="filter-checkbox">
                        <input type="checkbox" name="user_type" value="type1"> Lorem ipsum 1
                    </label>
                    <label class="filter-checkbox">
                        <input type="checkbox" name="user_type" value="type2"> Lorem ipsum 2
                    </label>
                    <label class="filter-checkbox">
                        <input type="checkbox" name="user_type" value="type3"> Lorem ipsum 3
                    </label>
                </div>
            </div> -->
        </aside>

        <div class="products-content">
            <div class="products-header">
                <span class="products-count"><?php echo $totalProduits; ?> produit<?php echo $totalProduits > 1 ? 's' : ''; ?> trouvé<?php echo $totalProduits > 1 ? 's' : ''; ?></span>
                <div class="products-sort">
                    <span class="sort-label">Trier par:</span>
                    <select class="sort-select" onchange="changeSort(this.value)">
                        <option value="popular" <?php echo ($sortBy == 'popular') ? 'selected' : ''; ?>>Popularité</option>
                        <option value="price-asc" <?php echo ($sortBy == 'price-asc') ? 'selected' : ''; ?>>Prix: croissant</option>
                        <option value="price-desc" <?php echo ($sortBy == 'price-desc') ? 'selected' : ''; ?>>Prix: décroissant</option>
                        <option value="name-asc" <?php echo ($sortBy == 'name-asc') ? 'selected' : ''; ?>>Nom: A-Z</option>
                        <option value="name-desc" <?php echo ($sortBy == 'name-desc') ? 'selected' : ''; ?>>Nom: Z-A</option>
                    </select>
                </div>
            </div>

            <main class="products-grid">
                <?php if (!empty($produits)): ?>
                    <?php foreach ($produits as $produit): ?>
                        <div class="product-card"
                            data-category="<?php echo $produit['nom_categorie']; ?>"
                            data-price="<?php echo $produit['prix']; ?>"
                            data-product-id="<?php echo $produit['id_produit']; ?>">

                            <?php if ($produit['quantite_stock'] < 10): ?>
                                <span class="product-badge">Stock limité</span>
                            <?php endif; ?>

                            <div class="product-image-container">
                                <img src="<?php echo !empty($produit['image_url']) ? htmlspecialchars($produit['image_url']) : '../assets/images/office.png'; ?>"
                                     alt="<?php echo htmlspecialchars($produit['nom_produit']); ?>"
                                     class="product-image">
                            </div>

                            <div class="product-details">
                                <button class="btn-wishlist add-to-favorites-btn"
                                        data-product-id="<?php echo $produit['id_produit']; ?>"
                                        data-product-name="<?php echo htmlspecialchars($produit['nom_produit']); ?>"
                                        data-product-price="<?php echo $produit['prix']; ?>"
                                        data-product-image="<?php echo !empty($produit['image_url']) ? htmlspecialchars($produit['image_url']) : '../assets/images/office.png'; ?>">
                                    <svg width="24" height="24"><use xlink:href="#heart"></use></svg>
                                </button>
                                <div class="product-category"><i class="fas fa-tag"></i>   <?php echo htmlspecialchars($produit['nom_categorie']); ?></div>
                                <h3 class="product-title"><?php echo htmlspecialchars($produit['nom_produit']); ?></h3>
                                <div class="product-meta">
                                    <span class="meta-item"><i class="fas fa-box"></i> Stock: <?php echo $produit['quantite_stock']; ?></span>
                                    <!-- <span class="meta-item"><i class="fas fa-tag"></i> <?php echo htmlspecialchars($produit['nom_categorie']); ?></span> -->
                                </div>
                                <div class="product-price">
                                    <?php echo number_format($produit['prix'], 2); ?> MAD
                                </div>
                                <div class="product-buttons">
                                    <button class="btn-cart add-to-cart-btn"
                                            data-product-id="<?php echo $produit['id_produit']; ?>"
                                            data-product-name="<?php echo htmlspecialchars($produit['nom_produit']); ?>"
                                            data-product-price="<?php echo $produit['prix']; ?>"
                                            data-product-image="<?php echo htmlspecialchars($produit['image_url']); ?>">
                                        <i class="fas fa-shopping-cart"></i> Panier
                                    </button>
                                    <a href="product_page.php?id=<?php echo $produit['id_produit']; ?>" class="btn-shop">
                                        <i class="fas fa-bolt"></i> Acheter
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="no-products">
                        <p>Aucun produit trouvé avec les critères sélectionnés.</p>
                    </div>
                <?php endif; ?>


            </main>

            <!-- Pagination dynamique -->
            <?php if ($totalPages > 1): ?>
                <div class="pagination">
                    <!-- Bouton précédent -->
                    <?php if ($page > 1): ?>
                        <a href="?page=<?php echo ($page - 1); ?><?php echo $categorieFilter ? '&categorie=' . $categorieFilter : ''; ?><?php echo $prixMin ? '&prix_min=' . $prixMin : ''; ?><?php echo $prixMax ? '&prix_max=' . $prixMax : ''; ?><?php echo $sortBy != 'id_desc' ? '&sort=' . $sortBy : ''; ?>" class="page-item">&laquo;</a>
                    <?php else: ?>
                        <span class="page-item disabled">&laquo;</span>
                    <?php endif; ?>

                    <!-- Numéros de pages -->
                    <?php
                    $startPage = max(1, $page - 2);
                    $endPage = min($totalPages, $page + 2);

                    for ($i = $startPage; $i <= $endPage; $i++): ?>
                        <?php if ($i == $page): ?>
                            <span class="page-item active"><?php echo $i; ?></span>
                        <?php else: ?>
                            <a href="?page=<?php echo $i; ?><?php echo $categorieFilter ? '&categorie=' . $categorieFilter : ''; ?><?php echo $prixMin ? '&prix_min=' . $prixMin : ''; ?><?php echo $prixMax ? '&prix_max=' . $prixMax : ''; ?><?php echo $sortBy != 'id_desc' ? '&sort=' . $sortBy : ''; ?>" class="page-item"><?php echo $i; ?></a>
                        <?php endif; ?>
                    <?php endfor; ?>

                    <!-- Bouton suivant -->
                    <?php if ($page < $totalPages): ?>
                        <a href="?page=<?php echo ($page + 1); ?><?php echo $categorieFilter ? '&categorie=' . $categorieFilter : ''; ?><?php echo $prixMin ? '&prix_min=' . $prixMin : ''; ?><?php echo $prixMax ? '&prix_max=' . $prixMax : ''; ?><?php echo $sortBy != 'id_desc' ? '&sort=' . $sortBy : ''; ?>" class="page-item">&raquo;</a>
                    <?php else: ?>
                        <span class="page-item disabled">&raquo;</span>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="overlay"></div>

    <script>
        // Fonction pour appliquer les filtres
        function applyFilters() {
            const urlParams = new URLSearchParams(window.location.search);

            // Récupérer les valeurs des filtres
            const prixMin = document.querySelector('input[name="prix_min"]').value;
            const prixMax = document.querySelector('input[name="prix_max"]').value;

            // Récupérer les catégories sélectionnées
            const categoriesChecked = document.querySelectorAll('input[name="category"]:checked');

            // Construire l'URL avec les filtres
            let newUrl = window.location.pathname + '?';

            if (prixMin) newUrl += 'prix_min=' + prixMin + '&';
            if (prixMax) newUrl += 'prix_max=' + prixMax + '&';

            if (categoriesChecked.length > 0) {
                categoriesChecked.forEach(checkbox => {
                    newUrl += 'categorie=' + checkbox.value + '&';
                });
            }

            // Conserver le tri actuel
            const currentSort = urlParams.get('sort');
            if (currentSort) newUrl += 'sort=' + currentSort + '&';

            // Supprimer le dernier &
            newUrl = newUrl.slice(0, -1);

            // Rediriger vers la nouvelle URL
            window.location.href = newUrl;
        }

        // Fonction pour changer le tri
        function changeSort(sortValue) {
            const urlParams = new URLSearchParams(window.location.search);
            urlParams.set('sort', sortValue);
            urlParams.delete('page'); // Reset à la page 1 lors du changement de tri
            window.location.href = window.location.pathname + '?' + urlParams.toString();
        }

        // La fonction addToCart est maintenant gérée par le CartManager dans panier2.js

        // Gestion des filtres mobiles
        document.addEventListener('DOMContentLoaded', function() {
            const filtersBtn = document.querySelector('.filters-mobile-btn');
            const filters = document.querySelector('.filters');
            const filtersClose = document.querySelector('.filters-close');
            const overlay = document.querySelector('.overlay');

            if (filtersBtn) {
                filtersBtn.addEventListener('click', function() {
                    filters.classList.add('active');
                    overlay.classList.add('active');
                });
            }

            if (filtersClose) {
                filtersClose.addEventListener('click', function() {
                    filters.classList.remove('active');
                    overlay.classList.remove('active');
                });
            }

            if (overlay) {
                overlay.addEventListener('click', function() {
                    filters.classList.remove('active');
                    overlay.classList.remove('active');
                });
            }

            // Gestion des checkboxes de catégories (une seule sélection)
            const categoryCheckboxes = document.querySelectorAll('input[name="category"]');
            categoryCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    if (this.checked) {
                        // Décocher les autres checkboxes
                        categoryCheckboxes.forEach(otherCheckbox => {
                            if (otherCheckbox !== this) {
                                otherCheckbox.checked = false;
                            }
                        });
                    }
                });
            });
        });
    </script>
<?php include_once '../includes/footer.php'; ?>
<style>
    .product-details .btn-wishlist {
        position: absolute;
        top: 10px;
        right: 10px;
        width: 45px;
        height: 45px;
        border-radius: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #fff;
        border: 2px solid #d8d8d8;
        transition: all 0.3s ease-out;
        cursor: pointer;
        z-index: 10;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    .product-details .btn-wishlist:hover {
        background: rgb(240, 56, 56);
        color: #fff;
        border-color: rgb(240, 56, 56);
        transform: scale(1.1);
    }

    .product-details .btn-wishlist.in-favorites {
        background: rgb(240, 56, 56);
        color: #fff;
        border-color: rgb(240, 56, 56);
    }

    .product-details .btn-wishlist.in-favorites:hover {
        background: #fff;
        color: rgb(240, 56, 56);
        border-color: rgb(240, 56, 56);
    }

    /* Animation pour le bouton de favoris */
    .product-details .btn-wishlist svg {
        transition: transform 0.3s ease;
    }

    .product-details .btn-wishlist:hover svg {
        transform: scale(1.2);
    }

    /* Amélioration de la visibilité sur mobile */
    @media (max-width: 768px) {
        .product-details .btn-wishlist {
            width: 40px;
            height: 40px;
            top: 8px;
            right: 8px;
        }
    }
</style>
</body>
</html>