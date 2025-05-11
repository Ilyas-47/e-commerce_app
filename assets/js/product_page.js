// Système de notation (étoiles)
document.addEventListener('DOMContentLoaded', function() {
    const stars = document.querySelectorAll('.rating-input i');
    let selectedRating = 0;
    
    stars.forEach(star => {
        star.addEventListener('mouseover', function() {
            const rating = this.getAttribute('data-rating');
            highlightStars(rating);
        });
        
        star.addEventListener('mouseout', function() {
            highlightStars(selectedRating);
        });
        
        star.addEventListener('click', function() {
            selectedRating = this.getAttribute('data-rating');
            highlightStars(selectedRating);
        });
    });
    
    function highlightStars(rating) {
        stars.forEach(star => {
            const starRating = star.getAttribute('data-rating');
            if (starRating <= rating) {
                star.classList.remove('far');
                star.classList.add('fas');
            } else {
                star.classList.remove('fas');
                star.classList.add('far');
            }
        });
    }
    
    // Gestion du formulaire d'avis
    const reviewForm = document.querySelector('.add-review-form');
    reviewForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const reviewerName = document.getElementById('reviewer-name').value;
        const reviewText = document.getElementById('review-text').value;
        
        if (reviewerName && reviewText && selectedRating > 0) {
            // Création du nouvel avis
            const newReview = document.createElement('div');
            newReview.className = 'review';
            
            const currentDate = new Date();
            const formattedDate = `${currentDate.getDate()} ${currentDate.toLocaleString('fr-FR', { month: 'long' })} ${currentDate.getFullYear()}`;
            
            newReview.innerHTML = `
                <div class="review-header">
                    <div class="reviewer-name">${reviewerName}</div>
                    <div class="review-date">${formattedDate}</div>
                </div>
                <div class="stars">
                    ${generateStars(selectedRating)}
                </div>
                <p class="review-text">${reviewText}</p>
            `;
            
            // Ajout de l'avis à la liste
            const reviewsList = document.querySelector('.reviews-list');
            reviewsList.prepend(newReview);
            
            // Réinitialiser le formulaire
            reviewForm.reset();
            selectedRating = 0;
            highlightStars(0);
            
            // Mise à jour du nombre d'avis
            updateReviewCount();
            
            // Animation pour le nouvel avis
            newReview.classList.add('animate-fade');
            
            alert('Merci pour votre avis !');
        } else {
            alert('Veuillez remplir tous les champs et donner une note.');
        }
    });
    
    function generateStars(rating) {
        let starsHTML = '';
        for (let i = 1; i <= 5; i++) {
            if (i <= rating) {
                starsHTML += '<i class="fas fa-star"></i>';
            } else if (i - 0.5 === rating) {
                starsHTML += '<i class="fas fa-star-half-alt"></i>';
            } else {
                starsHTML += '<i class="far fa-star"></i>';
            }
        }
        return starsHTML;
    }
    
    function updateReviewCount() {
        const reviews = document.querySelectorAll('.review');
        const reviewCount = reviews.length;
        const reviewCountElements = document.querySelectorAll('.review-count');
        
        reviewCountElements.forEach(element => {
            element.textContent = `(${reviewCount} avis)`;
        });
    }
});