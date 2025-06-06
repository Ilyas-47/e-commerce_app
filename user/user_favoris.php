<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include("../includes/nav.php")?>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/user_favoris.css">
    <style>
        /* Animation pour la suppression des favoris */
        .fav-item.removing {
            opacity: 0;
            transform: translateX(-100%);
            transition: all 0.3s ease-out;
        }

        /* Amélioration des boutons d'action */
        .fav-item-actions button {
            transition: all 0.3s ease;
        }

        .fav-item-cart:hover {
            background-color: #28a745 !important;
            color: white !important;
        }

        .fav-item-remove:hover {
            background-color: #dc3545 !important;
            color: white !important;
        }

        /* Message de chargement */
        .loading-message {
            text-align: center;
            padding: 40px;
            color: #6c757d;
        }
    </style>
</head>
<body>
    <main>
        <div class="fav-container">
            <div class="fav-profile-section">
                <?php include('user_nav.php'); ?>
                
                <div class="fav-content">
                    <h1 class="section-title">
                        <i class="fas fa-heart"></i>
                        <span>Mes Favoris <span class="favorite-count">(0)</span></span>
                    </h1>
                    <p class="section-description">Gérez vos produits favoris et ajoutez-les facilement au panier</p>

                    <ul class="fav-favorites-list">
                        <!-- Les favoris seront chargés dynamiquement ici -->
                    </ul>

                    <!-- Message si aucun favori -->
                    <div class="fav-empty" style="display: none;">
                        <i class="far fa-heart"></i>
                        <h2>Aucun favori pour le moment</h2>
                        <p>Explorez notre catalogue et ajoutez des produits à vos favoris</p>
                        <button class="fav-empty-btn">
                            <i class="fas fa-search"></i>
                            Explorer le catalogue
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        // Gestionnaire de favoris pour la page user_favoris.php
        class UserFavoritesPage {
            constructor() {
                this.storageKey = 'ecommerce_favorites';
                this.init();
            }

            init() {
                this.loadFavorites();
                this.bindEvents();

                // Écouter les changements dans localStorage
                window.addEventListener('storage', (e) => {
                    if (e.key === this.storageKey) {
                        this.loadFavorites();
                    }
                });
            }

            getFavorites() {
                const favorites = localStorage.getItem(this.storageKey);
                return favorites ? JSON.parse(favorites) : [];
            }

            saveFavorites(favorites) {
                localStorage.setItem(this.storageKey, JSON.stringify(favorites));
            }

            removeFromFavorites(productId) {
                const favorites = this.getFavorites();
                const filteredFavorites = favorites.filter(item => item.id != productId);
                this.saveFavorites(filteredFavorites);
                this.loadFavorites();

                // Mettre à jour le gestionnaire global si disponible
                if (window.favoritesManager) {
                    window.favoritesManager.updateDisplay();
                }
            }

            loadFavorites() {
                const favorites = this.getFavorites();
                const favoritesList = document.querySelector('.fav-favorites-list');
                const emptyMessage = document.querySelector('.fav-empty');
                const favoriteCount = document.querySelector('.favorite-count');

                // Mettre à jour le compteur
                favoriteCount.textContent = `(${favorites.length})`;

                if (favorites.length === 0) {
                    favoritesList.style.display = 'none';
                    emptyMessage.style.display = 'block';
                    return;
                }

                favoritesList.style.display = 'block';
                emptyMessage.style.display = 'none';
                favoritesList.innerHTML = '';

                favorites.forEach(item => {
                    const listItem = document.createElement('li');
                    listItem.className = 'fav-item';
                    listItem.innerHTML = `
                        <div class="fav-item-image">
                            <img src="${item.image || '../assets/images/d-product.png'}" alt="${item.name}">
                        </div>
                        <div class="fav-item-details">
                            <div class="fav-item-top">
                                <h5 class="fav-item-title">${item.name}</h5>
                                <div class="fav-item-actions">
                                    <button class="fav-item-cart" data-product-id="${item.id}" aria-label="Ajouter au panier">
                                        <i class="fas fa-shopping-cart"></i>
                                    </button>
                                    <button class="fav-item-remove" data-product-id="${item.id}" aria-label="Retirer des favoris">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="fav-item-price">${parseFloat(item.price).toFixed(2)} MAD</div>
                            <div class="fav-item-description">
                                Produit de qualité disponible dans notre catalogue.
                            </div>
                            <div class="fav-item-tags">
                                <span class="fav-item-tag">Favori</span>
                                <span class="fav-item-tag">Disponible</span>
                            </div>
                        </div>
                    `;
                    favoritesList.appendChild(listItem);
                });
            }

            bindEvents() {
                // Délégation d'événements pour les boutons dynamiques
                document.addEventListener('click', (e) => {
                    // Gestion des boutons de suppression
                    if (e.target.closest('.fav-item-remove')) {
                        e.preventDefault();
                        const button = e.target.closest('.fav-item-remove');
                        const productId = button.dataset.productId;
                        const item = button.closest('.fav-item');

                        item.classList.add('removing');

                        setTimeout(() => {
                            this.removeFromFavorites(productId);
                            this.showNotification('Produit retiré des favoris !', 'info');
                        }, 300);
                    }

                    // Gestion des boutons d'ajout au panier
                    if (e.target.closest('.fav-item-cart')) {
                        e.preventDefault();
                        const button = e.target.closest('.fav-item-cart');
                        const productId = parseInt(button.dataset.productId);

                        const favorites = this.getFavorites();
                        const product = favorites.find(item => item.id === productId);

                        if (product && window.cartManager) {
                            window.cartManager.addToCart({
                                id: product.id,
                                name: product.name,
                                price: product.price,
                                image: product.image,
                                quantity: 1
                            });
                            this.showNotification(product.name + ' ajouté au panier !', 'success');
                        } else if (!window.cartManager) {
                            this.showNotification('Erreur : système de panier non disponible', 'error');
                        }
                    }

                    // Bouton "Explorer le catalogue"
                    if (e.target.closest('.fav-empty-btn')) {
                        window.location.href = 'products.php';
                    }
                });

                // Effets hover
                document.addEventListener('mouseenter', (e) => {
                    if (e.target.closest('.fav-item-cart, .fav-item-remove')) {
                        e.target.closest('.fav-item-cart, .fav-item-remove').style.transform = 'translateY(-2px)';
                    }
                }, true);

                document.addEventListener('mouseleave', (e) => {
                    if (e.target.closest('.fav-item-cart, .fav-item-remove')) {
                        e.target.closest('.fav-item-cart, .fav-item-remove').style.transform = 'translateY(0)';
                    }
                }, true);
            }

            showNotification(message, type = 'success') {
                // Utiliser le système de notifications existant si disponible
                if (window.favoritesManager) {
                    window.favoritesManager.showNotification('', message, type);
                } else {
                    // Fallback simple
                    alert(message);
                }
            }
        }

        // Initialiser la page des favoris
        document.addEventListener('DOMContentLoaded', function() {
            console.log('🛍️ Initialisation de la page des favoris...');
            window.userFavoritesPage = new UserFavoritesPage();
            console.log('✅ Page des favoris initialisée !');
        });
    </script>
    
    <?php include("../includes/footer.php")?>
</body>
</html>