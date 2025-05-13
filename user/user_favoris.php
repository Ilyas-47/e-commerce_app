<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include("../includes/nav.php")?>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        :root {
            --primary: #4361ee;
            --primary-light: #ebefff;
            --secondary: #3a0ca3;
            --accent: #4cc9f0;
            --dark: #212529;
            --light: #f8f9fa;
            --success: #4caf50;
            --danger: #f44336;
            --danger-light: #ffebee;
            --gray: #6c757d;
            --light-gray: #e9ecef;
            --shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            --border-radius: 12px;
        }

        body {
            background-color: #f5f7fb;
            color: var(--dark);
            line-height: 1.6;
            padding-top: 40px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .profile-section {
            display: grid;
            grid-template-columns: 250px 1fr;
            gap: 30px;
        }

        /* Styles pour la page des favoris */
        .fav-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .fav-profile-section {
            display: grid;
            grid-template-columns: 250px 1fr;
            gap: 30px;
        }

        .fav-content {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            padding: 30px;
        }

        .section-title {
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 10px;
            color: var(--dark);
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .section-title i {
            color: var(--primary);
            font-size: 32px;
            margin-right: 15px;
        }

        .section-description {
            color: var(--gray);
            margin-bottom: 30px;
            font-size: 16px;
        }

        .fav-favorites-list {
            list-style: none;
            padding: 0;
        }

        .fav-item {
            display: flex;
            gap: 25px;
            padding: 25px;
            background: white;
            border-radius: var(--border-radius);
            margin-bottom: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
            transition: all 0.3s ease;
            border: 1px solid #f0f0f0;
            position: relative;
            overflow: hidden;
        }

        .fav-item::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 4px;
            background: var(--primary);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .fav-item:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow);
            border-color: #e8eaf6;
        }

        .fav-item:hover::before {
            opacity: 1;
        }

        .fav-item-image {
            width: 140px;
            height: 140px;
            flex-shrink: 0;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .fav-item-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .fav-item:hover .fav-item-image img {
            transform: scale(1.08);
        }

        .fav-item-details {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .fav-item-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 12px;
        }

        .fav-item-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--dark);
            margin: 0;
            transition: color 0.3s ease;
        }

        .fav-item:hover .fav-item-title {
            color: var(--dark);
        }

        .fav-item-actions {
            display: flex;
            gap: 12px;
        }

        .fav-item-cart, 
        .fav-item-remove {
            border: none;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .fav-item-cart {
            background-color: var(--primary-light);
            color: var(--primary);
        }

        .fav-item-remove {
            background-color: var(--danger-light);
            color: var(--danger);
        }

        .fav-item-cart:hover {
            background-color: var(--primary);
            color: white;
            transform: translateY(-2px);
        }

        .fav-item-remove:hover {
            background-color: var(--danger);
            color: white;
            transform: translateY(-2px);
        }

        .fav-item-price {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--dark);
            margin: 10px 0;
            display: flex;
            align-items: center;
        }

        .fav-item-description {
            color: var(--gray);
            font-size: 0.95rem;
            line-height: 1.6;
            flex-grow: 1;
        }

        .fav-item-tags {
            display: flex;
            gap: 8px;
            margin-top: 15px;
        }

        .fav-item-tag {
            background-color: var(--light-gray);
            color: var(--gray);
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
        }

        .fav-empty {
            text-align: center;
            padding: 60px 40px;
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            margin-top: 20px;
        }

        .fav-empty i {
            font-size: 60px;
            color: var(--light-gray);
            margin-bottom: 20px;
            display: inline-block;
            background-color: var(--light);
            width: 120px;
            height: 120px;
            line-height: 120px;
            border-radius: 60px;
        }

        .fav-empty h2 {
            font-size: 24px;
            color: var(--dark);
            margin-bottom: 15px;
        }

        .fav-empty p {
            color: var(--gray);
            margin-bottom: 25px;
        }

        .fav-empty-btn {
            background-color: var(--primary);
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 500;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .fav-empty-btn:hover {
            background-color: var(--secondary);
            transform: translateY(-2px);
        }

        /* Animation des items supprimés */
        .fav-item.removing {
            animation: fadeOutRight 0.5s forwards;
        }

        @keyframes fadeOutRight {
            from {
                opacity: 1;
                transform: translateX(0);
            }
            to {
                opacity: 0;
                transform: translateX(50px);
            }
        }

        @media (max-width: 768px) {
            .fav-profile-section {
                grid-template-columns: 1fr;
            }

            .fav-item {
                flex-direction: column;
                padding: 20px;
            }

            .fav-item-image {
                width: 100%;
                height: 200px;
            }

            .section-title {
                font-size: 24px;
            }

            .section-title i {
                width: 40px;
                height: 40px;
                font-size: 18px;
            }
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
                        <span>Mes Favoris <span class="favorite-count">(3)</span></span>
                    </h1>
                    <p class="section-description">Gérez vos produits favoris et ajoutez-les facilement au panier</p>

                    <ul class="fav-favorites-list">
                        <!-- Item 1 -->
                        <li class="fav-item">
                            <div class="fav-item-image">
                                <img src="../assets/images/d-product.png" alt="Produit 1">
                            </div>
                            <div class="fav-item-details">
                                <div class="fav-item-top">
                                    <h5 class="fav-item-title">Microsoft Office 2024 Home PC</h5>
                                    <div class="fav-item-actions">
                                        <button class="fav-item-cart" aria-label="Ajouter au panier">
                                            <i class="fas fa-shopping-cart"></i>
                                        </button>
                                        <button class="fav-item-remove" aria-label="Retirer des favoris">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="fav-item-price">200 MAD</div>
                                <div class="fav-item-description">
                                    Microsoft Office 2024 Home PC - Licence à vie pour 1 PC Windows ou Mac. Suite complète incluant Word, Excel, PowerPoint, Outlook et OneNote.
                                </div>
                                <div class="fav-item-tags">
                                    <span class="fav-item-tag">Office</span>
                                    <span class="fav-item-tag">Licence à vie</span>
                                </div>
                            </div>
                        </li>

                        <!-- Item 2 -->
                        <li class="fav-item">
                            <div class="fav-item-image">
                                <img src="../assets/images/d-product.png" alt="Produit 2">
                            </div>
                            <div class="fav-item-details">
                                <div class="fav-item-top">
                                    <h5 class="fav-item-title">Microsoft Visual Studio 2024</h5>
                                    <div class="fav-item-actions">
                                        <button class="fav-item-cart" aria-label="Ajouter au panier">
                                            <i class="fas fa-shopping-cart"></i>
                                        </button>
                                        <button class="fav-item-remove" aria-label="Retirer des favoris">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="fav-item-price">300 MAD</div>
                                <div class="fav-item-description">
                                    Microsoft Visual Studio 2024 Professional - Environnement de développement intégré pour les développeurs professionnels avec toutes les fonctionnalités avancées.
                                </div>
                                <div class="fav-item-tags">
                                    <span class="fav-item-tag">Développement</span>
                                    <span class="fav-item-tag">Professionnel</span>
                                </div>
                            </div>
                        </li>

                        <!-- Item 3 -->
                        <li class="fav-item">
                            <div class="fav-item-image">
                                <img src="../assets/images/d-product.png" alt="Produit 3">
                            </div>
                            <div class="fav-item-details">
                                <div class="fav-item-top">
                                    <h5 class="fav-item-title">Microsoft Windows 11 Pro</h5>
                                    <div class="fav-item-actions">
                                        <button class="fav-item-cart" aria-label="Ajouter au panier">
                                            <i class="fas fa-shopping-cart"></i>
                                        </button>
                                        <button class="fav-item-remove" aria-label="Retirer des favoris">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="fav-item-price">400 MAD</div>
                                <div class="fav-item-description">
                                    Microsoft Windows 11 Pro - Licence à vie. Système d'exploitation pour les professionnels avec des fonctionnalités de sécurité et de gestion avancées.
                                </div>
                                <div class="fav-item-tags">
                                    <span class="fav-item-tag">Système</span>
                                    <span class="fav-item-tag">Windows</span>
                                </div>
                            </div>
                        </li>
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
        document.addEventListener('DOMContentLoaded', function() {
            // Gestion des boutons de suppression des favoris
            const removeButtons = document.querySelectorAll('.fav-item-remove');
            const favoriteCount = document.querySelector('.favorite-count');
            let count = parseInt(favoriteCount.textContent.replace(/[()]/g, ''));
            
            removeButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const item = this.closest('.fav-item');
                    item.classList.add('removing');
                    
                    // Mettre à jour le compteur
                    count--;
                    favoriteCount.textContent = `(${count})`;
                    
                    setTimeout(() => {
                        item.remove();
                        checkEmptyFavorites();
                    }, 500);
                });
            });

            // Effets hover sur les boutons d'action
            const actionButtons = document.querySelectorAll('.fav-item-cart, .fav-item-remove');
            actionButtons.forEach(button => {
                button.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-2px)';
                });
                button.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });

            // Vérifier si la liste des favoris est vide
            function checkEmptyFavorites() {
                const items = document.querySelectorAll('.fav-item');
                const emptyMessage = document.querySelector('.fav-empty');
                const favoritesList = document.querySelector('.fav-favorites-list');
                
                if (items.length === 0) {
                    emptyMessage.style.display = 'block';
                    favoritesList.style.display = 'none';
                }
            }
        });
    </script>
    
    <?php include("../includes/footer.php")?>
</body>
</html>