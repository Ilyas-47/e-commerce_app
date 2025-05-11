document.addEventListener('DOMContentLoaded', function() {
    // Sélection des éléments
    const cartItems = document.querySelectorAll('.cart-item');
    const quantityBtns = document.querySelectorAll('.quantity-btn');
    const removeButtons = document.querySelectorAll('.cart-item-remove');
    const cartCount = document.querySelectorAll('.cart-count');
    const toast = document.getElementById('addToCartToast');
    const toastClose = document.querySelector('.toast-close');
    
    // Fonction pour mettre à jour le total du panier
    function updateCartTotal() {
      let total = 0;
      document.querySelectorAll('.cart-item').forEach(item => {
        const price = parseFloat(item.querySelector('.cart-item-price').textContent.replace('MAD', ''));
        const quantity = parseInt(item.querySelector('.quantity-input').value);
        total += price * quantity;
        
        // Mettre à jour le sous-total de l'article
        item.querySelector('.cart-item-subtotal').textContent = price * quantity + ' MAD';
      });
      
      // Mettre à jour le résumé du panier
      document.querySelector('.summary-row.total span:last-child').textContent = total + ' MAD';
      document.querySelectorAll('.cart-total').forEach(el => {
        el.textContent = total + ' MAD';
      });
      
      // Mettre à jour le nombre d'articles
      const totalItems = Array.from(document.querySelectorAll('.quantity-input'))
                             .reduce((sum, input) => sum + parseInt(input.value), 0);
      document.getElementById('offcanvasCartLabel').textContent = `Votre Panier (${totalItems})`;
      cartCount.forEach(count => {
        count.textContent = totalItems;
      });
    }
    
    // Gestion des boutons de quantité
    quantityBtns.forEach(btn => {
      btn.addEventListener('click', function() {
        const input = this.parentNode.querySelector('.quantity-input');
        const currentValue = parseInt(input.value);
        if (this.dataset.action === 'increase') {
          input.value = currentValue + 1;
        } else if (this.dataset.action === 'decrease' && currentValue > 1) {
          input.value = currentValue - 1;
        }
        updateCartTotal();
      });
    });
    
    // Gestion des inputs de quantité
    document.querySelectorAll('.quantity-input').forEach(input => {
      input.addEventListener('change', function() {
        if (this.value < 1) this.value = 1;
        updateCartTotal();
      });
    });
    
    // Gestion des boutons de suppression
    removeButtons.forEach(button => {
      button.addEventListener('click', function() {
        const item = this.closest('.cart-item');
        item.style.opacity = '0';
        setTimeout(() => {
          item.remove();
          updateCartTotal();
          
          // Vérifier si le panier est vide
          if (document.querySelectorAll('.cart-item').length === 0) {
            document.querySelector('.cart-items').style.display = 'none';
            document.querySelector('.empty-cart').style.display = 'block';
            document.querySelector('.cart-summary').style.display = 'none';
            document.querySelector('.checkout-btn').style.display = 'none';
            document.querySelector('.promo-code-container').style.display = 'none';
          }
        }, 300);
      });
    });
    
    // Gestion du code promo
    const applyPromoBtn = document.getElementById('applyPromoBtn');
    const promoInput = document.getElementById('promoCodeInput');
    const promoFeedback = document.querySelector('.promo-feedback');
    const discountRow = document.querySelector('.discount-row');
    
    // Codes promo valides (normalement ceci serait vérifié côté serveur)
    const validPromoCodes = {
      'BIENVENUE10': 10,
      'ETE2025': 15,
      'PROMO25': 25
    };
    
    if (applyPromoBtn) {
      applyPromoBtn.addEventListener('click', function() {
        const code = promoInput.value.trim().toUpperCase();
        
        if (code && validPromoCodes[code]) {
          // Code valide
          const discount = validPromoCodes[code];
          const subtotal = parseFloat(document.querySelector('.summary-row:first-child span:last-child').textContent.replace('MAD', ''));
          const discountAmount = (subtotal * discount / 100).toFixed(2);
          const newTotal = (subtotal - discountAmount).toFixed(2);
          
          // Mise à jour de l'UI
          discountRow.querySelector('span:last-child').textContent = `-${discountAmount} MAD`;
          discountRow.style.display = 'flex';
          document.querySelector('.summary-row.total span:last-child').textContent = `${newTotal} MAD`;
          document.querySelectorAll('.cart-total').forEach(el => {
            el.textContent = `${newTotal} MAD`;
          });
          
          // Afficher le feedback
          promoFeedback.textContent = `Code "${code}" appliqué : -${discountAmount} MAD (${discount}%)`;
          promoFeedback.style.display = 'block';
          
          // Désactiver l'input et le bouton
          promoInput.disabled = true;
          applyPromoBtn.disabled = true;
          
          // Montrer une notification
          showToast(`Code promo "${code}" appliqué avec succès!`);
        } else {
          // Code invalide
          promoFeedback.textContent = 'Code promo invalide';
          promoFeedback.style.display = 'block';
          promoFeedback.className = 'promo-feedback text-danger';
          
          // Secouer l'input pour indiquer l'erreur
          promoInput.classList.add('shake');
          setTimeout(() => {
            promoInput.classList.remove('shake');
          }, 500);
        }
      });
      
      // Réinitialiser le feedback quand l'utilisateur modifie l'entrée
      promoInput.addEventListener('input', function() {
        if (promoFeedback.classList.contains('text-danger')) {
          promoFeedback.style.display = 'none';
          promoFeedback.className = 'promo-feedback text-success';
        }
      });
    }
    
    // Afficher une notification toast
    function showToast(message = 'Article ajouté au panier') {
      toast.querySelector('.toast-message').textContent = message;
      toast.classList.add('show');
      setTimeout(() => {
        toast.classList.remove('show');
      }, 3000);
    }
    
    // Fermer le toast manuellement
    if (toastClose) {
      toastClose.addEventListener('click', function() {
        toast.classList.remove('show');
      });
    }
    
    // Exemple d'ajout au panier (pour démonstration)
    document.addEventListener('click', function(e) {
      if (e.target.classList.contains('add-to-cart-btn')) {
        e.preventDefault();
        
        // Mettre à jour le compteur
        const currentCount = parseInt(cartCount[0].textContent);
        cartCount.forEach(count => {
          count.textContent = currentCount + 1;
        });
        
        // Afficher le toast
        showToast(e.target.dataset.productName + ' a été ajouté à votre panier.');
      }
    });
    
    // Initialiser les totaux au chargement
    updateCartTotal();
  });