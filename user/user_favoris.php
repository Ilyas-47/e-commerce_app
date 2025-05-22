<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include("../includes/nav.php")?>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/user_favoris.css">
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