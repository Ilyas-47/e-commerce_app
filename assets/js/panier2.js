// Gestionnaire de panier avec localStorage
class CartManager {
    constructor() {
        this.storageKey = 'ecommerce_cart';
        this.init();
    }

    init() {
        this.loadCartFromStorage();
        this.bindEvents();
        this.updateCartDisplay();
    }

    // Récupérer le panier depuis localStorage
    getCart() {
        const cart = localStorage.getItem(this.storageKey);
        return cart ? JSON.parse(cart) : [];
    }

    // Sauvegarder le panier dans localStorage
    saveCart(cart) {
        localStorage.setItem(this.storageKey, JSON.stringify(cart));
    }

    // Ajouter un produit au panier
    addToCart(productData) {
        const cart = this.getCart();
        const existingItemIndex = cart.findIndex(item => item.id === productData.id);

        if (existingItemIndex > -1) {
            // Le produit existe déjà, augmenter la quantité
            cart[existingItemIndex].quantity += productData.quantity || 1;
        } else {
            // Nouveau produit
            cart.push({
                id: productData.id,
                name: productData.name,
                price: productData.price,
                image: productData.image,
                quantity: productData.quantity || 1
            });
        }

        this.saveCart(cart);
        this.updateCartDisplay();
        this.showToast(`${productData.name} ajouté au panier !`);
        return true;
    }

    // Mettre à jour la quantité d'un produit
    updateQuantity(productId, newQuantity) {
        const cart = this.getCart();
        const itemIndex = cart.findIndex(item => item.id === productId);

        if (itemIndex > -1) {
            if (newQuantity <= 0) {
                cart.splice(itemIndex, 1);
            } else {
                cart[itemIndex].quantity = newQuantity;
            }
            this.saveCart(cart);
            this.updateCartDisplay();
        }
    }

    // Supprimer un produit du panier
    removeFromCart(productId) {
        const cart = this.getCart();
        const filteredCart = cart.filter(item => item.id !== productId);
        this.saveCart(filteredCart);
        this.updateCartDisplay();
    }

    // Vider le panier
    clearCart() {
        localStorage.removeItem(this.storageKey);
        this.updateCartDisplay();
    }

    // Calculer le total du panier
    getCartTotal() {
        const cart = this.getCart();
        return cart.reduce((total, item) => total + (item.price * item.quantity), 0);
    }

    // Calculer le nombre total d'articles
    getCartItemCount() {
        const cart = this.getCart();
        return cart.reduce((total, item) => total + item.quantity, 0);
    }

    // Mettre à jour l'affichage du panier
    updateCartDisplay() {
        const cart = this.getCart();
        const cartItemsContainer = document.querySelector('.cart-items');
        const emptyCartContainer = document.querySelector('.empty-cart');
        const cartSummary = document.querySelector('.cart-summary');
        const checkoutBtn = document.querySelector('.checkout-btn');
        const promoContainer = document.querySelector('.promo-code-container');

        // Mettre à jour le compteur dans la navigation
        const cartCountElements = document.querySelectorAll('.cart-count, [data-cart-count]');
        const cartTotalElements = document.querySelectorAll('.cart-total');
        const cartLabelElement = document.getElementById('offcanvasCartLabel');

        const itemCount = this.getCartItemCount();
        const total = this.getCartTotal();

        // Mettre à jour les compteurs
        cartCountElements.forEach(el => {
            el.textContent = itemCount;
        });

        // Mettre à jour les totaux
        cartTotalElements.forEach(el => {
            el.textContent = `${total.toFixed(2)} MAD`;
        });

        // Mettre à jour le label du panier
        if (cartLabelElement) {
            cartLabelElement.textContent = `Votre Panier (${itemCount})`;
        }

        // Mettre à jour le texte du panier dans la navigation
        const cartNavText = document.querySelector('.cart span.fs-6');
        if (cartNavText) {
            cartNavText.textContent = `Votre Panier (${itemCount})`;
        }

        if (cart.length === 0) {
            // Panier vide
            if (cartItemsContainer) cartItemsContainer.style.display = 'none';
            if (emptyCartContainer) emptyCartContainer.style.display = 'block';
            if (cartSummary) cartSummary.parentElement.style.display = 'none'; // cart-footer
            if (checkoutBtn) checkoutBtn.style.display = 'none';
            if (promoContainer) promoContainer.style.display = 'none';
        } else {
            // Panier avec des articles
            if (cartItemsContainer) cartItemsContainer.style.display = 'block';
            if (emptyCartContainer) emptyCartContainer.style.display = 'none';
            if (cartSummary) cartSummary.parentElement.style.display = 'block'; // cart-footer
            if (checkoutBtn) checkoutBtn.style.display = 'block';
            if (promoContainer) promoContainer.style.display = 'block';

            this.renderCartItems(cart);
            this.updateCartSummary();
        }
    }

    // Rendre les articles du panier
    renderCartItems(cart) {
        const cartItemsContainer = document.querySelector('.cart-items');
        if (!cartItemsContainer) return;

        cartItemsContainer.innerHTML = '';

        cart.forEach(item => {
            const cartItemElement = document.createElement('li');
            cartItemElement.className = 'cart-item';
            cartItemElement.dataset.productId = item.id;

            cartItemElement.innerHTML = `
                <div class="cart-item-image">
                    <img src="${item.image || '../assets/images/d-product.png'}" alt="${item.name}">
                </div>
                <div class="cart-item-details">
                    <div class="cart-item-top">
                        <h5 class="cart-item-title">${item.name}</h5>
                        <button class="cart-item-remove" aria-label="Retirer l'article" data-product-id="${item.id}">×</button>
                    </div>
                    <div class="cart-item-price">${item.price.toFixed(2)} MAD</div>
                    <div class="cart-item-bottom">
                        <div class="quantity-selector">
                            <button class="quantity-btn" data-action="decrease" data-product-id="${item.id}">−</button>
                            <input type="number" class="quantity-input" value="${item.quantity}" min="1" max="10" aria-label="Quantité" data-product-id="${item.id}">
                            <button class="quantity-btn" data-action="increase" data-product-id="${item.id}">+</button>
                        </div>
                        <div class="cart-item-subtotal">${(item.price * item.quantity).toFixed(2)} MAD</div>
                    </div>
                </div>
            `;

            cartItemsContainer.appendChild(cartItemElement);
        });
    }

    // Mettre à jour le résumé du panier
    updateCartSummary() {
        const total = this.getCartTotal();
        const subtotalElement = document.querySelector('.summary-row:not(.total):not(.discount-row) span:last-child');
        const totalElement = document.querySelector('.summary-row.total span:last-child');

        if (subtotalElement) {
            subtotalElement.textContent = `${total.toFixed(2)} MAD`;
        }
        if (totalElement) {
            totalElement.textContent = `${total.toFixed(2)} MAD`;
        }
    }

    // Charger le panier depuis localStorage au démarrage
    loadCartFromStorage() {
        const cart = this.getCart();
        console.log('Panier chargé:', cart);

        // Optionnel: valider le panier avec le serveur
        if (cart.length > 0) {
            this.validateCartWithServer();
        }
    }

    // Synchroniser le panier avec la session PHP
    async syncToSession() {
        const cart = this.getCart();
        try {
            const response = await fetch('../system_user/sync_cart.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    action: 'sync_to_session',
                    cart: cart
                })
            });

            const data = await response.json();
            if (data.success) {
                console.log('Panier synchronisé avec la session PHP');
                return true;
            } else {
                console.error('Erreur de synchronisation:', data.error);
                return false;
            }
        } catch (error) {
            console.error('Erreur lors de la synchronisation:', error);
            return false;
        }
    }

    // Valider le panier avec le serveur
    async validateCartWithServer() {
        const cart = this.getCart();
        if (cart.length === 0) return;

        try {
            const response = await fetch('../system_user/sync_cart.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    action: 'validate_cart',
                    cart: cart
                })
            });

            const data = await response.json();
            if (data.success) {
                // Mettre à jour le panier avec les données validées
                this.saveCart(data.cart);
                this.updateCartDisplay();

                // Afficher les erreurs s'il y en a
                if (data.errors && data.errors.length > 0) {
                    data.errors.forEach(error => {
                        this.showToast(error, 'warning');
                    });
                }
            }
        } catch (error) {
            console.error('Erreur lors de la validation du panier:', error);
        }
    }

    // Lier les événements
    bindEvents() {
        // Délégation d'événements pour les éléments dynamiques du panier
        document.addEventListener('click', (e) => {
            // Gestion des boutons de quantité
            if (e.target.classList.contains('quantity-btn')) {
                const productId = parseInt(e.target.dataset.productId);
                const action = e.target.dataset.action;
                const input = e.target.parentNode.querySelector('.quantity-input');
                const currentValue = parseInt(input.value);

                if (action === 'increase') {
                    this.updateQuantity(productId, currentValue + 1);
                } else if (action === 'decrease' && currentValue > 1) {
                    this.updateQuantity(productId, currentValue - 1);
                }
            }

            // Gestion des boutons de suppression
            if (e.target.classList.contains('cart-item-remove')) {
                const productId = parseInt(e.target.dataset.productId);
                this.removeFromCart(productId);
            }

            // Gestion des boutons "Ajouter au panier"
            if (e.target.classList.contains('add-to-cart-btn') || e.target.closest('.add-to-cart-btn')) {
                e.preventDefault();
                const button = e.target.classList.contains('add-to-cart-btn') ? e.target : e.target.closest('.add-to-cart-btn');

                if (button.dataset.productId) {
                    const productData = {
                        id: parseInt(button.dataset.productId),
                        name: button.dataset.productName || 'Produit',
                        price: parseFloat(button.dataset.productPrice) || 0,
                        image: button.dataset.productImage || '../assets/images/d-product.png',
                        quantity: 1
                    };
                    this.addToCart(productData);
                }
            }
        });

        // Gestion des changements de quantité via input
        document.addEventListener('change', (e) => {
            if (e.target.classList.contains('quantity-input')) {
                const productId = parseInt(e.target.dataset.productId);
                const newQuantity = parseInt(e.target.value);
                if (newQuantity >= 1) {
                    this.updateQuantity(productId, newQuantity);
                } else {
                    e.target.value = 1;
                }
            }
        });

        // Gestion du code promo
        this.bindPromoEvents();

        // Gestion du toast
        this.bindToastEvents();

        // Gestion du bouton checkout
        this.bindCheckoutEvents();
    }

    // Gestion des événements du code promo
    bindPromoEvents() {
        const applyPromoBtn = document.getElementById('applyPromoBtn');
        const promoInput = document.getElementById('promoCodeInput');
        const promoFeedback = document.querySelector('.promo-feedback');
        const discountRow = document.querySelector('.discount-row');

        if (applyPromoBtn) {
            applyPromoBtn.addEventListener('click', async () => {
                const code = promoInput.value.trim();

                if (!code) {
                    this.showPromoError('Veuillez saisir un code promo');
                    return;
                }

                const cart = this.getCart();
                if (cart.length === 0) {
                    this.showPromoError('Votre panier est vide');
                    return;
                }

                // Désactiver le bouton pendant la vérification
                applyPromoBtn.disabled = true;
                applyPromoBtn.textContent = 'Vérification...';

                try {
                    const response = await fetch('../system_user/sync_cart.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            action: 'verify_promo_code',
                            promo_code: code,
                            cart: cart
                        })
                    });

                    const data = await response.json();

                    if (data.success) {
                        // Code promo valide - appliquer la réduction
                        this.applyPromoDiscount(data);

                        // Afficher le feedback de succès
                        if (promoFeedback) {
                            promoFeedback.textContent = data.message;
                            promoFeedback.style.display = 'block';
                            promoFeedback.className = 'promo-feedback text-success';
                        }

                        // Désactiver l'input et le bouton
                        promoInput.disabled = true;
                        applyPromoBtn.disabled = true;
                        applyPromoBtn.textContent = 'Appliqué';

                        // Montrer une notification
                        this.showToast(data.message);
                    } else {
                        // Code promo invalide
                        this.showPromoError(data.error || 'Code promo invalide');
                    }
                } catch (error) {
                    console.error('Erreur lors de la vérification du code promo:', error);
                    this.showPromoError('Erreur lors de la vérification du code promo');
                } finally {
                    // Réactiver le bouton si pas appliqué avec succès
                    if (!applyPromoBtn.disabled) {
                        applyPromoBtn.textContent = 'Appliquer';
                    }
                }
            });

            // Réinitialiser le feedback quand l'utilisateur modifie l'entrée
            promoInput.addEventListener('input', () => {
                if (promoFeedback && promoFeedback.classList.contains('text-danger')) {
                    promoFeedback.style.display = 'none';
                    promoFeedback.className = 'promo-feedback text-success';
                }

                // Réactiver le bouton si il était désactivé
                if (applyPromoBtn.disabled && applyPromoBtn.textContent === 'Appliqué') {
                    applyPromoBtn.disabled = false;
                    applyPromoBtn.textContent = 'Appliquer';
                    promoInput.disabled = false;

                    // Supprimer la réduction appliquée
                    this.removePromoDiscount();
                }
            });
        }
    }

    // Afficher une erreur de code promo
    showPromoError(message) {
        const promoFeedback = document.querySelector('.promo-feedback');
        const promoInput = document.getElementById('promoCodeInput');
        const applyPromoBtn = document.getElementById('applyPromoBtn');

        if (promoFeedback) {
            promoFeedback.textContent = message;
            promoFeedback.style.display = 'block';
            promoFeedback.className = 'promo-feedback text-danger';
        }

        // Secouer l'input pour indiquer l'erreur
        if (promoInput) {
            promoInput.classList.add('shake');
            setTimeout(() => {
                promoInput.classList.remove('shake');
            }, 500);
        }

        // Réactiver le bouton
        if (applyPromoBtn) {
            applyPromoBtn.disabled = false;
            applyPromoBtn.textContent = 'Appliquer';
        }
    }

    // Appliquer la réduction du code promo
    applyPromoDiscount(promoData) {
        const discountRow = document.querySelector('.discount-row');
        const subtotalElement = document.querySelector('.summary-row:not(.total):not(.discount-row) span:last-child');
        const totalElement = document.querySelector('.summary-row.total span:last-child');

        // Stocker les données du promo pour référence
        this.appliedPromo = promoData;

        // Afficher la ligne de réduction
        if (discountRow) {
            discountRow.querySelector('span:last-child').textContent = `-${promoData.total_discount.toFixed(2)} MAD`;
            discountRow.style.display = 'flex';
        }

        // Mettre à jour le sous-total
        if (subtotalElement) {
            subtotalElement.textContent = `${promoData.subtotal_before_discount.toFixed(2)} MAD`;
        }

        // Mettre à jour le total
        if (totalElement) {
            totalElement.textContent = `${promoData.final_total.toFixed(2)} MAD`;
        }

        // Mettre à jour les totaux dans la navigation
        document.querySelectorAll('.cart-total').forEach(el => {
            el.textContent = `${promoData.final_total.toFixed(2)} MAD`;
        });
    }

    // Supprimer la réduction du code promo
    removePromoDiscount() {
        const discountRow = document.querySelector('.discount-row');
        const promoFeedback = document.querySelector('.promo-feedback');

        // Masquer la ligne de réduction
        if (discountRow) {
            discountRow.style.display = 'none';
        }

        // Masquer le feedback
        if (promoFeedback) {
            promoFeedback.style.display = 'none';
        }

        // Remettre les totaux normaux
        this.updateCartSummary();

        // Supprimer les données du promo appliqué
        this.appliedPromo = null;
    }

    // Gestion des événements du toast
    bindToastEvents() {
        const toast = document.getElementById('addToCartToast');
        const toastClose = document.querySelector('.toast-close');

        // Fermer le toast manuellement
        if (toastClose) {
            toastClose.addEventListener('click', () => {
                if (toast) {
                    toast.classList.remove('show');
                }
            });
        }
    }

    // Afficher une notification toast (style admin)
    showToast(message = 'Article ajouté au panier', type = 'success') {
        console.log(`📢 PANIER ${type.toUpperCase()}: ${message}`);

        // Créer une notification avec le même style que l'admin (comme les favoris)
        const notification = document.createElement('div');
        notification.style.cssText = `
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translate(-50%, -100%);
            background-color: ${type === 'success' ? '#28a745' : type === 'error' ? '#da0a0a' : type === 'warning' ? '#ffc107' : type === 'info' ? '#17a2b8' : '#28a745'};
            color: ${type === 'warning' ? '#000' : 'white'};
            padding: 15px 25px;
            border-radius: 4px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
            z-index: 2000;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 14px;
            transition: transform 0.5s ease-out;
        `;

        // Contenu simple comme dans l'admin
        notification.innerHTML = `${message}`;

        document.body.appendChild(notification);

        // Animation d'apparition (slideDown comme dans l'admin)
        setTimeout(() => {
            notification.style.transform = 'translate(-50%, 0)';
        }, 10);

        // Animation de disparition
        setTimeout(() => {
            notification.style.transform = 'translate(-50%, -100%)';
            setTimeout(() => {
                notification.remove();
            }, 500);
        }, type === 'warning' || type === 'error' ? 5000 : 3000);
    }

    // Gestion des événements du checkout
    bindCheckoutEvents() {
        document.addEventListener('click', async (e) => {
            if (e.target.classList.contains('checkout-btn')) {
                e.preventDefault();

                const cart = this.getCart();
                if (cart.length === 0) {
                    this.showToast('Votre panier est vide !', 'warning');
                    return;
                }

                // Synchroniser le panier avec la session PHP avant de procéder
                this.showToast('Synchronisation en cours...', 'info');

                const syncSuccess = await this.syncToSession();
                if (syncSuccess) {
                    // Rediriger vers la page de checkout ou traitement de commande
                    window.location.href = '../user/checkout.php'; // Ajustez l'URL selon votre structure
                } else {
                    this.showToast('Erreur de synchronisation !', 'error');
                }
            }
        });
    }
}

// Initialiser le gestionnaire de panier
document.addEventListener('DOMContentLoaded', function() {
    window.cartManager = new CartManager();
});

// Fonction globale pour ajouter au panier (pour compatibilité avec le code existant)
function addToCart(productId, productName, productPrice, productImage, quantity = 1) {
    if (window.cartManager) {
        const productData = {
            id: parseInt(productId),
            name: productName || 'Produit',
            price: parseFloat(productPrice) || 0,
            image: productImage || '../assets/images/d-product.png',
            quantity: parseInt(quantity) || 1
        };
        return window.cartManager.addToCart(productData);
    }
    return false;
}

// Fonction globale pour synchroniser le panier avant checkout
async function syncCartBeforeCheckout() {
    if (window.cartManager) {
        const success = await window.cartManager.syncToSession();
        if (success) {
            console.log('Panier synchronisé avec succès');
            return true;
        } else {
            console.error('Échec de la synchronisation du panier');
            return false;
        }
    }
    return false;
}

// Fonction globale pour vider le panier
function clearCart() {
    if (window.cartManager) {
        window.cartManager.clearCart();
        return true;
    }
    return false;
}

// Fonction globale pour obtenir le contenu du panier
function getCartContents() {
    if (window.cartManager) {
        return window.cartManager.getCart();
    }
    return [];
}

// Fonction globale pour obtenir le total du panier
function getCartTotal() {
    if (window.cartManager) {
        return window.cartManager.getCartTotal();
    }
    return 0;
}

// Initialiser le CartManager automatiquement
document.addEventListener('DOMContentLoaded', function() {
    console.log('🛒 Initialisation automatique du CartManager...');
    window.cartManager = new CartManager();
    console.log('✅ CartManager initialisé et prêt !');
});

// Initialiser le CartManager automatiquement
document.addEventListener('DOMContentLoaded', function() {
    console.log('🛒 Initialisation automatique du CartManager...');
    window.cartManager = new CartManager();
    console.log('✅ CartManager initialisé et prêt !');
});