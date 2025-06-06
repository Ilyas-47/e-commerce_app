// Gestionnaire de favoris avec localStorage
class FavoritesManager {
    constructor() {
        this.storageKey = 'ecommerce_favorites';
        this.init();
    }

    init() {
        this.loadFavoritesFromStorage();
        this.bindEvents();
        this.updateFavoritesDisplay();
    }

    // Récupérer les favoris depuis localStorage
    getFavorites() {
        const favorites = localStorage.getItem(this.storageKey);
        return favorites ? JSON.parse(favorites) : [];
    }

    // Sauvegarder les favoris dans localStorage
    saveFavorites(favorites) {
        localStorage.setItem(this.storageKey, JSON.stringify(favorites));
    }

    // Ajouter un produit aux favoris
    addToFavorites(productData) {
        const favorites = this.getFavorites();
        const existingItemIndex = favorites.findIndex(item => item.id === productData.id);

        if (existingItemIndex > -1) {
            // Le produit est déjà dans les favoris
            this.showToast('Déjà dans les favoris', `${productData.name} est déjà dans vos favoris.`, 'info');
            return false;
        } else {
            // Nouveau produit
            favorites.push({
                id: productData.id,
                name: productData.name,
                price: productData.price,
                image: productData.image
            });
        }

        this.saveFavorites(favorites);
        this.updateFavoritesDisplay();
        this.showToast('Ajouté aux favoris', `${productData.name} a été ajouté à vos favoris.`, 'success');
        return true;
    }

    // Supprimer un produit des favoris
    removeFromFavorites(productId) {
        const favorites = this.getFavorites();
        const filteredFavorites = favorites.filter(item => item.id !== productId);
        this.saveFavorites(filteredFavorites);
        this.updateFavoritesDisplay();
    }

    // Vider les favoris
    clearFavorites() {
        localStorage.removeItem(this.storageKey);
        this.updateFavoritesDisplay();
    }

    // Vérifier si un produit est dans les favoris
    isInFavorites(productId) {
        const favorites = this.getFavorites();
        return favorites.some(item => item.id === productId);
    }

    // Obtenir le nombre de favoris
    getFavoritesCount() {
        const favorites = this.getFavorites();
        return favorites.length;
    }

    // Mettre à jour l'affichage des favoris
    updateFavoritesDisplay() {
        const favorites = this.getFavorites();
        const favorisItemsContainer = document.querySelector('.favoris-items');
        const emptyFavorisContainer = document.querySelector('.empty-favoris');
        const addAllToCartButton = document.querySelector('.add-all-to-cart-btn');
        const favorisCountElement = document.getElementById('offcanvasFavorisLabel');

        const itemCount = this.getFavoritesCount();

        // Mettre à jour le compteur
        if (favorisCountElement) {
            favorisCountElement.textContent = `Vos Favoris (${itemCount})`;
        }

        if (favorites.length === 0) {
            // Favoris vides
            if (favorisItemsContainer) favorisItemsContainer.style.display = 'none';
            if (emptyFavorisContainer) emptyFavorisContainer.style.display = 'block';
            if (addAllToCartButton) addAllToCartButton.style.display = 'none';
        } else {
            // Favoris avec des articles
            if (favorisItemsContainer) favorisItemsContainer.style.display = 'block';
            if (emptyFavorisContainer) emptyFavorisContainer.style.display = 'none';
            if (addAllToCartButton) addAllToCartButton.style.display = 'block';

            this.renderFavoriteItems(favorites);
        }

        // Mettre à jour les boutons cœur sur les pages
        this.updateHeartButtons();
    }

    // Rendre les articles des favoris
    renderFavoriteItems(favorites) {
        const favorisItemsContainer = document.querySelector('.favoris-items');
        if (!favorisItemsContainer) return;

        favorisItemsContainer.innerHTML = '';

        favorites.forEach(item => {
            const favoriteItemElement = document.createElement('li');
            favoriteItemElement.className = 'favoris-item';
            favoriteItemElement.dataset.productId = item.id;

            favoriteItemElement.innerHTML = `
                <div class="favoris-item-image">
                    <img src="${item.image || '../assets/images/d-product.png'}" alt="${item.name}">
                </div>
                <div class="favoris-item-details">
                    <div class="favoris-item-top">
                        <h5 class="favoris-item-title">${item.name}</h5>
                        <div class="favoris-item-actions">
                            <button class="favoris-item-cart" aria-label="Ajouter au panier" data-product-id="${item.id}">
                                <svg width="18" height="18" viewBox="0 0 24 24">
                                    <use xlink:href="#cart"></use>
                                </svg>
                            </button>
                            <button class="favoris-item-remove" aria-label="Retirer des favoris" data-product-id="${item.id}">
                                <svg width="18" height="18" viewBox="0 0 24 24">
                                    <use xlink:href="#trash"></use>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="favoris-item-price">${parseFloat(item.price).toFixed(2)} MAD</div>
                </div>
            `;

            favorisItemsContainer.appendChild(favoriteItemElement);
        });
    }

    // Mettre à jour les boutons cœur sur les pages
    updateHeartButtons() {
        const heartButtons = document.querySelectorAll('.add-to-favorites-btn');
        heartButtons.forEach(button => {
            const productId = parseInt(button.dataset.productId);
            if (this.isInFavorites(productId)) {
                button.classList.add('in-favorites');
            } else {
                button.classList.remove('in-favorites');
            }
        });
    }

    // Charger les favoris depuis localStorage au démarrage
    loadFavoritesFromStorage() {
        const favorites = this.getFavorites();
        console.log('Favoris chargés:', favorites);
    }

    // Lier les événements
    bindEvents() {
        // Délégation d'événements pour les éléments dynamiques des favoris
        document.addEventListener('click', (e) => {
            // Gestion des boutons "Ajouter au panier" depuis les favoris
            if (e.target.classList.contains('favoris-item-cart') || e.target.closest('.favoris-item-cart')) {
                e.preventDefault();
                const button = e.target.classList.contains('favoris-item-cart') ? e.target : e.target.closest('.favoris-item-cart');
                const productId = parseInt(button.dataset.productId);
                const item = button.closest('.favoris-item');
                const title = item.querySelector('.favoris-item-title').textContent;
                const price = parseFloat(item.querySelector('.favoris-item-price').textContent.replace(' MAD', ''));
                const image = item.querySelector('.favoris-item-image img').src;

                // Ajouter au panier via le CartManager
                if (window.cartManager) {
                    const productData = {
                        id: productId,
                        name: title,
                        price: price,
                        image: image,
                        quantity: 1
                    };
                    window.cartManager.addToCart(productData);
                } else {
                    this.showToast('Ajouté au panier', `${title} a été ajouté au panier.`, 'success');
                }
            }

            // Gestion des boutons de suppression des favoris
            if (e.target.classList.contains('favoris-item-remove') || e.target.closest('.favoris-item-remove')) {
                e.preventDefault();
                const button = e.target.classList.contains('favoris-item-remove') ? e.target : e.target.closest('.favoris-item-remove');
                const productId = parseInt(button.dataset.productId);
                const item = button.closest('.favoris-item');
                const title = item.querySelector('.favoris-item-title').textContent;

                // Animation de suppression
                item.style.transition = 'all 0.3s ease';
                item.style.opacity = '0';
                item.style.height = `${item.offsetHeight}px`;

                setTimeout(() => {
                    item.style.height = '0';
                    item.style.marginBottom = '0';
                    item.style.paddingBottom = '0';

                    setTimeout(() => {
                        this.removeFromFavorites(productId);
                        this.showToast('Retiré des favoris', `${title} a été retiré de vos favoris.`, 'remove');
                    }, 300);
                }, 300);
            }

            // Gestion des boutons "Ajouter aux favoris" sur les pages
            if (e.target.classList.contains('add-to-favorites-btn') || e.target.closest('.add-to-favorites-btn')) {
                e.preventDefault();
                const button = e.target.classList.contains('add-to-favorites-btn') ? e.target : e.target.closest('.add-to-favorites-btn');

                if (button.dataset.productId) {
                    const productData = {
                        id: parseInt(button.dataset.productId),
                        name: button.dataset.productName || 'Produit',
                        price: parseFloat(button.dataset.productPrice) || 0,
                        image: button.dataset.productImage || '../assets/images/d-product.png'
                    };

                    if (this.isInFavorites(productData.id)) {
                        // Retirer des favoris
                        this.removeFromFavorites(productData.id);
                        this.showToast('Retiré des favoris', `${productData.name} a été retiré de vos favoris.`, 'remove');
                    } else {
                        // Ajouter aux favoris
                        this.addToFavorites(productData);
                    }
                }
            }

            // Gestion du bouton "Tout ajouter au panier"
            if (e.target.classList.contains('add-all-to-cart-btn')) {
                e.preventDefault();
                const favorites = this.getFavorites();

                if (favorites.length > 0 && window.cartManager) {
                    favorites.forEach(item => {
                        const productData = {
                            id: item.id,
                            name: item.name,
                            price: item.price,
                            image: item.image,
                            quantity: 1
                        };
                        window.cartManager.addToCart(productData);
                    });
                    this.showToast('Ajoutés au panier', `${favorites.length} article${favorites.length > 1 ? 's' : ''} ajouté${favorites.length > 1 ? 's' : ''} au panier.`, 'success');
                }
            }
        });
    }

    // Afficher une notification toast
    showToast(title, message, type = 'success') {
        let toastContainer = document.querySelector('.toast-container');
        if (!toastContainer) {
            toastContainer = document.createElement('div');
            toastContainer.className = 'toast-container';
            document.body.appendChild(toastContainer);
        }

        // Créer le toast
        const toast = document.createElement('div');
        toast.className = 'favoris-toast';

        // Définir l'icône en fonction du type
        let iconName, iconBgColor;
        switch (type) {
            case 'success':
                iconName = 'check';
                iconBgColor = '#4CAF50';
                break;
            case 'remove':
                iconName = 'trash';
                iconBgColor = '#ff6b6b';
                break;
            case 'info':
                iconName = 'heart';
                iconBgColor = '#2196F3';
                break;
            default:
                iconName = 'heart';
                iconBgColor = '#ff6b6b';
        }

        toast.innerHTML = `
            <div class="favoris-toast-icon" style="background-color: ${iconBgColor}">
                <svg width="16" height="16" viewBox="0 0 24 24">
                    <use xlink:href="#${iconName}"></use>
                </svg>
            </div>
            <div class="favoris-toast-content">
                <div class="favoris-toast-title">${title}</div>
                <div class="favoris-toast-message">${message}</div>
            </div>
            <button class="favoris-toast-close">&times;</button>
        `;

        // Ajouter le toast au conteneur
        toastContainer.appendChild(toast);

        // Afficher le toast avec un petit délai
        setTimeout(() => {
            toast.classList.add('show');
        }, 10);

        // Fermer le toast après 3 secondes
        setTimeout(() => {
            toast.classList.remove('show');
            setTimeout(() => {
                toast.remove();
            }, 300);
        }, 3000);

        // Gérer le bouton de fermeture
        toast.querySelector('.favoris-toast-close').addEventListener('click', () => {
            toast.classList.remove('show');
            setTimeout(() => {
                toast.remove();
            }, 300);
        });
    }
}

// Initialiser le gestionnaire de favoris
document.addEventListener('DOMContentLoaded', function() {
    window.favoritesManager = new FavoritesManager();
});

// Fonctions globales pour compatibilité
function addToFavorites(productId, productName, productPrice, productImage) {
    if (window.favoritesManager) {
        const productData = {
            id: parseInt(productId),
            name: productName || 'Produit',
            price: parseFloat(productPrice) || 0,
            image: productImage || '../assets/images/d-product.png'
        };
        return window.favoritesManager.addToFavorites(productData);
    }
    return false;
}

function removeFromFavorites(productId) {
    if (window.favoritesManager) {
        window.favoritesManager.removeFromFavorites(parseInt(productId));
        return true;
    }
    return false;
}

function isInFavorites(productId) {
    if (window.favoritesManager) {
        return window.favoritesManager.isInFavorites(parseInt(productId));
    }
    return false;
}