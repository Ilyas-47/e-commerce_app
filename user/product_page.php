<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #FFFDF7;
            color: #2A2A2A;
        }

        .container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 2rem;
        }

        .product-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 3rem;
            margin-bottom: 3rem;
            background: white;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(255, 206, 10, 0.1);
        }

        .product-title {
            font-size: 2rem;
            color: #2A2A2A;
            margin-bottom: 1rem;
        }

        .product-price {
            font-size: 2rem;
            font-weight: bold;
            color: #2A2A2A;
            margin-bottom: 1rem;
        }

        .product-description {
            color: #555555;
            line-height: 1.6;
            margin-bottom: 2rem;
        }

        .product-features {
            margin-bottom: 2rem;
        }

        .feature {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 0.5rem;
            color: #555555;
        }

        .feature i {
            color: #FFCE0A;
        }

        .cta-button {
            background: #FFCE0A;
            color: #2A2A2A;
            border: none;
            padding: 1rem 2rem;
            font-size: 1rem;
            font-weight: 600;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
            text-align: center;
        }

        .cta-button:hover {
            background: #FFD534;
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(255, 206, 10, 0.2);
        }

        :root {
            --primary-color: #FFCE0A;
            --secondary-color: #ffd840;
            --accent-color: #fff1b8;
            --light-bg: #fffdf7;
            --dark-text: #2A2A2A;
            --medium-text: #555555;
            --light-text: #e9ecef;
            --shadow: 0 4px 6px rgba(255, 206, 10, 0.15);
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: var(--light-bg);
            color: var(--dark-text);
        }
        
        .container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 2rem;
        }
        
        .product-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 3rem;
            margin-bottom: 3rem;
            background: white;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(255, 206, 10, 0.1);
        }
        
        .product-image {
            background-color: #FFFDF7;
            border: 1px solid #FFE97D;
            border-radius: 12px;
            padding: 1rem;
        }
        
        .product-image img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }
        
        .product-info {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }
        
        .product-title {
            font-size: 2.2rem;
            font-weight: 700;
            color: var(--dark-text);
            border-bottom: 2px solid #FFCE0A;
            padding-bottom: 0.5rem;
        }
        
        .product-price {
            font-size: 2rem;
            font-weight: bold;
            color: #2A2A2A;
            margin-bottom: 1rem;
        }
        
        .product-description {
            font-size: 1rem;
            line-height: 1.6;
            color: var(--medium-text);
        }
        
        .product-features {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }
        
        .feature {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            background: #FFFDF7;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            border: 1px solid #FFE97D;
        }
        
        .feature i {
            color: var(--primary-color);
            color: #FFCE0A;
        }
        
        .cta-button {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: var(--dark-text);
            border: none;
            padding: 1rem 2rem;
            font-size: 1rem;
            font-weight: 600;
            border-radius: 50px;
            cursor: pointer;
            box-shadow: var(--shadow);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            margin-top: 1rem;
            background: #FFCE0A;
            color: #2A2A2A;
            border: none;
            padding: 1rem 2rem;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .cta-button:hover {
            background: linear-gradient(135deg, var(--secondary-color), var(--primary-color));
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(255, 206, 10, 0.2);
            background: #FFD534;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(255, 206, 10, 0.2);
        }
        
        .section-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin: 2rem 0 1.5rem 0;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid var(--primary-color);
            color: #2A2A2A;
            border-bottom: 2px solid #FFCE0A;
        }
        
        .reviews-container {
            background-color: white;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: var(--shadow);
            margin-bottom: 3rem;
            background: white;
            border: 1px solid #FFE97D;
            box-shadow: 0 4px 6px rgba(255, 206, 10, 0.1);
        }
        
        .reviews-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }
        
        .review-stats {
            display: flex;
            gap: 1rem;
            align-items: center;
        }
        
        .average-rating {
            font-size: 2rem;
            font-weight: 700;
            color: var (--secondary-color);
        }
        
        .stars {
            color: var(--primary-color);
            font-size: 1.2rem;
            color: #FFCE0A;
        }
        
        .review-count {
            color: var(--medium-text);
        }
        
        .reviews-list {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }
        
        .review {
            border-bottom: 1px solid #e9ecef;
            padding-bottom: 1.5rem;
        }
        
        .review:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }
        
        .review-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.5rem;
        }
        
        .reviewer-name {
            font-weight: 600;
        }
        
        .review-date {
            color: var(--medium-text);
            font-size: 0.9rem;
        }
        
        .review-text {
            color: var(--dark-text);
            line-height: 1.5;
        }
        
        .add-review {
            margin-top: 2rem;
        }
        
        .add-review-form {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }
        
        .form-group {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }
        
        .form-label {
            font-weight: 600;
        }
        
        .form-input, .form-textarea {
            padding: 0.75rem;
            border: 1px solid #ced4da;
            border-radius: 4px;
            font-size: 1rem;
        }
        
        .form-textarea {
            min-height: 100px;
            resize: vertical;
        }
        
        .rating-input {
            display: flex;
            gap: 0.5rem;
        }
        
        .submit-button {
            background-color: var(--primary-color);
            color: var(--dark-text);
            border: none;
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
            font-weight: 600;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            align-self: flex-start;
        }
        
        .submit-button:hover {
            background-color: var(--secondary-color);
        }
        
        .recommended-products {
            margin-bottom: 3rem;
        }
        
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 2rem;
        }
        
        .product-card {
            background-color: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }
        
        .card-image {
            height: 180px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f8f9fa;
        }
        
        .card-image img {
            max-width: 90%;
            max-height: 90%;
            object-fit: contain;
        }
        
        .card-content {
            padding: 1.5rem;
        }
        
        .card-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--dark-text);
        }
        
        .card-price {
            font-size: 1.2rem;
            font-weight: 600;
            color: #2A2A2A;
            margin-bottom: 1rem;
        }
        
        .card-button {
            background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
            color: var(--dark-text);
            border: none;
            padding: 0.5rem 1rem;
            font-size: 0.9rem;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            width: 100%;
        }
        
        .card-button:hover {
            background: linear-gradient(to right, var(--secondary-color), var(--primary-color));
        }
        
        @media (max-width: 768px) {
            .product-container {
                grid-template-columns: 1fr;
            }
            
            .nav-links {
                display: none;
            }
            
            .mobile-menu-btn {
                display: block;
                color: white;
                font-size: 1.5rem;
                cursor: pointer;
            }
        }
        
        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .animate-fade {
            animation: fadeIn 0.5s ease forwards;
        }

        /* Supprimer les anciens styles d'avis */
        
        /* Nouveaux styles pour les avis défilants */
        .title4 {
            text-align: center;
            margin: 60px 0 30px;
        }

        .highlight {
            color: var(--primary-color);
        }

        .container_review {
            width: 90vw;
            height: 282px;
            overflow: hidden;
            position: relative;
            margin: 50px auto;
        }

        .marquee {
            --duration: 60s;
            --card-width: 16rem;
            width: 100%;
            height: 100%;
            position: relative;
            display: flex;
            overflow: hidden;
            mask-image: linear-gradient(to right, rgb(0 0 0 / 0), rgb(0 0 0 / 1) 5%, rgb(0 0 0 / 1) 95%, rgb(0 0 0 / 0));
        }

        .marquee.reverse review-card {
            animation-direction: reverse;
        }

        .marquee review-card {
            position: absolute;
            inset-inline-start: max(calc(var(--card-width) * var(--total)), 100%);
            animation: scroll-left var(--duration) linear infinite;
            animation-delay: calc(var(--duration) / var(--total) * (var(--total) - var(--index)) * -1);
        }

        @keyframes scroll-left {
            to {
                inset-inline-start: calc((var(--card-width) + 50px) * -1);
            }
        }

        review-card {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: var(--shadow);
            width: 280px;
            margin: 10px;
            flex-shrink: 0;
        }
    </style>
</head>
<body>
    <?php include_once '../includes/nav.php'; ?>
    
    <main class="container">
        <div class="product-container animate-fade">
            <div class="product-image">
                <img src="../assets/images/office.png" alt="Produit Digital">
            </div>
            <div class="product-info">
                <h1 class="product-title">Lorem Ipsum Dolor Sit Amet</h1>
                <div class="product-price">0.00 Prix</div>
                <div class="product-rating">
                    <span class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </span>
                    <span class="review-count">(00 Lorem)</span>
                </div>
                <p class="product-description">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                </p>
                <div class="product-features">
                    <div class="feature">
                        <i class="fas fa-check-circle"></i>
                        <span>Lorem ipsum dolor</span>
                    </div>
                    <div class="feature">
                        <i class="fas fa-check-circle"></i>
                        <span>Consectetur adipiscing</span>
                    </div>
                    <div class="feature">
                        <i class="fas fa-check-circle"></i>
                        <span>Sed do eiusmod</span>
                    </div>
                    <div class="feature">
                        <i class="fas fa-check-circle"></i>
                        <span>Tempor incididunt</span>
                    </div>
                    <div class="feature">
                        <i class="fas fa-check-circle"></i>
                        <span>Ut labore et dolore</span>
                    </div>
                </div>
                <div class="product-actions">
                    <button class="cta-button">
                        <i class="fas fa-shopping-cart"></i> Ajouter au panier
                    </button>
                </div>
            </div>
        </div>
        
        <h2 class="title4"><strong>Lorem <span class="highlight">Ipsum </span>Dolor Sit</strong></h2>
        <main class="container_review">
            <div class="marquee pause-on-hover" style="--total: 6;">
                <!-- le contenu des review-cards -->
            </div>

            <div class="marquee pause-on-hover reverse" style="--total: 6;">
                <!-- le contenu des review-cards -->
            </div>
        </main>
        <br><br><br><br>

        <section class="py-5 overflow-hidden">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="section-header d-flex justify-content-between">
                    <h2 class="section-title">Lorem Ipsum</h2>
                    <div class="d-flex align-items-center">
                        <a href="#" class="btn-link text-decoration-none">Voir tous les produits →</a>
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
                        <?php for($i = 1; $i <= 4; $i++): ?>
                            <div class="product-item swiper-slide">
                                <a href="#" class="btn-wishlist">
                                    <svg width="24" height="24"><use xlink:href="#heart"></use></svg>
                                </a>
                                <figure>
                                    <a href="product_page.php" title="Product Title">
                                        <img src="../assets/images/office.png" class="tab-image">
                                    </a>
                                </figure>
                                <h3>Lorem Ipsum Dolor</h3>
                                <span class="qty">0 Lorem</span>
                                <span class="rating">
                                    <svg width="24" height="24" class="text-primary">
                                        <use xlink:href="#star-solid"></use>
                                    </svg> 0.0
                                </span>
                                <span class="price">0.00 Prix</span>
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="input-group product-qty">
                                        <span class="input-group-btn">
                                            <button type="button" class="quantity-left-minus btn btn-danger btn-number" data-type="minus">
                                                <svg width="16" height="16"><use xlink:href="#minus"></use></svg>
                                            </button>
                                        </span>
                                        <input type="text" name="quantity" class="form-control input-number" value="1">
                                        <span class="input-group-btn">
                                            <button type="button" class="quantity-right-plus btn btn-success btn-number" data-type="plus">
                                                <svg width="16" height="16"><use xlink:href="#plus"></use></svg>
                                            </button>
                                        </span>
                                    </div>
                                    <a href="#" class="nav-link">Add to Cart <iconify-icon icon="uil:shopping-cart"></iconify-icon></a>
                                </div>
                            </div>
                        <?php endfor; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
    </main>
    
    <?php include_once '../includes/footer.php'; ?>
    
    <script>
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
    </script>
</body>
</html>