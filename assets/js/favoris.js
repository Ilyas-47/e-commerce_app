document.addEventListener('DOMContentLoaded', function() {
    // Initialiser Bootstrap Offcanvas pour les favoris
    const myOffcanvasFavoris = new bootstrap.Offcanvas(document.getElementById('offcanvasFavoris'));
    // Éléments DOM
    const heartIcon = document.querySelector('a[href="#"] svg[use[xlink\\:href="#heart"]]').closest('a');
    const addToCartButtons = document.querySelectorAll('.favoris-item-cart');
    const removeButtons = document.querySelectorAll('.favoris-item-remove');
    const addAllToCartButton = document.querySelector('.add-all-to-cart-btn');
    const emptyFavorisEl = document.querySelector('.empty-favoris');
    const favorisItems = document.querySelector('.favoris-items');
    const favorisCountEl = document.querySelector('#offcanvasFavorisLabel');
    
    function updateFavorisCount() {
      const items = document.querySelectorAll('.favoris-item').length;
      favorisCountEl.textContent = `Vos Favoris (${items})`;
      
      if (items === 0) {
        emptyFavorisEl.style.display = 'block';
        favorisItems.style.display = 'none';
        addAllToCartButton.style.display = 'none';
      } else {
        emptyFavorisEl.style.display = 'none';
        favorisItems.style.display = 'block';
        addAllToCartButton.style.display = 'block';
      }
    }
    
    function showToast(title, message, type = 'success') {
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
      let iconName = type === 'success' ? 'check' : 'heart';
      let iconBgColor = type === 'success' ? '#4CAF50' : '#ff6b6b';
      
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
    
    // Ajouter l'offcanvas pour les favoris à l'élément body
    if (!document.getElementById('offcanvasFavoris')) {
      // L'élément offcanvas des favoris est déjà dans le HTML
      // Nous n'avons donc pas besoin de l'ajouter
    }
    
    // Ajouter l'attribut data-bs-toggle et data-bs-target à l'icône cœur
    heartIcon.setAttribute('data-bs-toggle', 'offcanvas');
    heartIcon.setAttribute('data-bs-target', '#offcanvasFavoris');
    
    // Gérer le clic sur les boutons "Ajouter au panier"
    addToCartButtons.forEach(button => {
      button.addEventListener('click', function() {
        const item = this.closest('.favoris-item');
        const title = item.querySelector('.favoris-item-title').textContent;
        
        // Ajouter le produit au panier (cette fonction doit être reliée à votre système de panier)
        // Ici nous simulons juste la notification
        showToast('Ajouté au panier', `${title} a été ajouté au panier.`, 'success');
      });
    });
    
    // Gérer le clic sur les boutons de suppression
    removeButtons.forEach(button => {
      button.addEventListener('click', function() {
        const item = this.closest('.favoris-item');
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
            item.remove();
            updateFavorisCount();
            showToast('Retiré des favoris', `${title} a été retiré de vos favoris.`, 'remove');
          }, 300);
        }, 300);
      });
    });
    
    // Gérer le clic sur "Tout ajouter au panier"
    addAllToCartButton.addEventListener('click', function() {
      const items = document.querySelectorAll('.favoris-item');
      const count = items.length;
      
      if (count > 0) {
        // Simuler l'ajout de tous les articles au panier
        showToast('Ajoutés au panier', `${count} article${count > 1 ? 's' : ''} ajouté${count > 1 ? 's' : ''} au panier.`, 'success');
      }
    });
    
    // Initialiser le compteur de favoris
    updateFavorisCount();
  });