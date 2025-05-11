<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DigiStore - Mes Favoris</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        :root {
            --primary: #4361ee;
            --secondary: #3f37c9;
            --accent: #4cc9f0;
            --dark: #212529;
            --light: #f8f9fa;
            --success: #4caf50;
            --danger: #f44336;
            --gray: #6c757d;
            --light-gray: #e9ecef;
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

        .sidebar {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            padding: 20px;
            height: fit-content;
        }

        .user-info {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding-bottom: 20px;
            border-bottom: 1px solid var(--light-gray);
            margin-bottom: 20px;
        }

        .avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background-color: var(--accent);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 36px;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .user-name {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .user-email {
            color: var(--gray);
            font-size: 14px;
        }

        .menu {
            list-style: none;
        }

        .menu li {
            margin-bottom: 10px;
        }

        .menu a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px;
            border-radius: 4px;
            text-decoration: none;
            color: var(--dark);
            transition: background-color 0.3s;
        }

        .menu a:hover {
            background-color: var(--light-gray);
        }

        .menu a.active {
            background-color: var(--primary);
            color: white;
        }

        @media (max-width: 768px) {
            .profile-section {
                grid-template-columns: 1fr;
            }
            
            .sidebar {
                margin-bottom: 20px;
            }
        }

        /* Styles pour les favoris */
        .favorites-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .product-card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            transition: transform 0.3s;
        }

        .product-card:hover {
            transform: translateY(-5px);
        }

        .product-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .product-info {
            padding: 15px;
        }

        .product-name {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .product-price {
            color: var(--primary);
            font-weight: 700;
            font-size: 18px;
            margin-bottom: 10px;
        }

        .product-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 15px;
        }

        .remove-favorite {
            background: none;
            border: none;
            color: var(--danger);
            cursor: pointer;
            transition: opacity 0.3s;
        }

        .remove-favorite:hover {
            opacity: 0.8;
        }

        .add-to-cart {
            background: var(--primary);
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .add-to-cart:hover {
            background: var(--secondary);
        }

        .empty-favorites {
            text-align: center;
            padding: 40px;
            background: white;
            border-radius: 8px;
            margin-top: 20px;
        }

        .empty-favorites i {
            font-size: 48px;
            color: var(--gray);
            margin-bottom: 20px;
        }

        @media (max-width: 768px) {
            .profile-section {
                grid-template-columns: 1fr;
            }
            
            .favorites-grid {
                grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            }
        }

        /* Nouveaux styles pour les favoris */
        .favorites-list {
            list-style: none;
            padding: 0;
        }

        .favoris-item {
            display: flex;
            gap: 20px;
            padding: 20px;
            background: white;
            border-radius: 8px;
            margin-bottom: 15px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s;
        }

        .favoris-item:hover {
            transform: translateY(-2px);
        }

        .favoris-item-image {
            width: 120px;
            height: 120px;
            flex-shrink: 0;
        }

        .favoris-item-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 4px;
        }

        .favoris-item-details {
            flex: 1;
        }

        .favoris-item-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 10px;
        }

        .favoris-item-title {
            font-size: 18px;
            margin: 0;
        }

        .favoris-item-actions {
            display: flex;
            gap: 10px;
        }

        .favoris-item-actions button {
            background: none;
            border: none;
            padding: 5px;
            cursor: pointer;
            transition: color 0.3s;
        }

        .favoris-item-cart {
            color: var(--primary);
        }

        .favoris-item-remove {
            color: var(--danger);
        }

        .favoris-item-price {
            font-size: 20px;
            font-weight: 600;
            color: var(--primary);
            margin: 10px 0;
        }

        .favoris-item-description {
            color: var(--gray);
            font-size: 14px;
        }

        @media (max-width: 768px) {
            .favoris-item {
                flex-direction: column;
            }

            .favoris-item-image {
                width: 100%;
                height: 200px;
            }
        }

        /* Styles du profil */
        .sidebar {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            padding: 20px;
            height: fit-content;
        }
        
        .user-info {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding-bottom: 20px;
            border-bottom: 1px solid var(--light-gray);
            margin-bottom: 20px;
        }
        
        .avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background-color: var(--accent);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 36px;
            font-weight: bold;
            margin-bottom: 15px;
        }
        
        .user-name {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 5px;
        }
        
        .user-email {
            color: var(--gray);
            font-size: 14px;
        }
        
        .menu {
            list-style: none;
        }
        
        .menu li {
            margin-bottom: 10px;
        }
        
        .menu a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px;
            border-radius: 4px;
            text-decoration: none;
            color: var(--dark);
            transition: background-color 0.3s;
        }
        
        .menu a:hover {
            background-color: var(--light-gray);
        }
        
        .menu a.active {
            background-color: var(--primary);
            color: white;
        }
    </style>
</head>
<body>
    <main>
        <div class="container">
            <div class="profile-section">
                <!-- Sidebar avec profil utilisateur -->
                <div class="sidebar">
                    <div class="user-info">
                        <div class="avatar">
                            <img src="../assets/images/office.png" alt="Profile" style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">
                        </div>
                        <div class="user-name">Jean Dupont</div>
                        <div class="user-email">jean.dupont@example.com</div>
                    </div>
                    <ul class="menu">
                        <li><a href="user_profil.php"><i class="fas fa-tachometer-alt"></i> Tableau de bord</a></li>
                        <li><a href="user_info.php"><i class="fas fa-user"></i> Informations personnelles</a></li>
                        <li><a href="user_commande.php"><i class="fas fa-shopping-bag"></i> Mes commandes</a></li>
                        <li><a href="user_pay.php"><i class="fas fa-credit-card"></i> Moyens de paiement</a></li>
                        <li><a href="user_favoris.php"><i class="fas fa-heart"></i> Liste de souhaits</a></li>
                        <li><a href="user_support.php" class="active"><i class="fas fa-headset"></i> Support</a></li>
                        <li><a href="#"><i class="fas fa-sign-out-alt"></i> Déconnexion</a></li>
                    </ul>
                </div>

                <div class="content">
                    <h1 class="section-title"><i class="fas fa-heart"></i> Mes Favoris (3)</h1>
                    <p class="section-description">Gérez vos produits favoris et ajoutez-les facilement au panier</p>

                    <ul class="favorites-list">
                        <!-- Item 1 -->
                        <li class="favoris-item">
                            <div class="favoris-item-image">
                                <img src="../assets/images/d-product.png" alt="Produit 1">
                            </div>
                            <div class="favoris-item-details">
                                <div class="favoris-item-top">
                                    <h5 class="favoris-item-title">Microsoft Office 2024 Home PC</h5>
                                    <div class="favoris-item-actions">
                                        <button class="favoris-item-cart" aria-label="Ajouter au panier">
                                            <i class="fas fa-shopping-cart"></i>
                                        </button>
                                        <button class="favoris-item-remove" aria-label="Retirer des favoris">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="favoris-item-price">200 MAD</div>
                                <div class="favoris-item-description">
                                    Microsoft Office 2024 Home PC - Licence à vie
                                </div>
                            </div>
                        </li>

                        <!-- Item 2 -->
                        <li class="favoris-item">
                            <div class="favoris-item-image">
                                <img src="../assets/images/d-product.png" alt="Produit 2">
                            </div>
                            <div class="favoris-item-details">
                                <div class="favoris-item-top">
                                    <h5 class="favoris-item-title">Microsoft Visual Studio 2024</h5>
                                    <div class="favoris-item-actions">
                                        <button class="favoris-item-cart" aria-label="Ajouter au panier">
                                            <i class="fas fa-shopping-cart"></i>
                                        </button>
                                        <button class="favoris-item-remove" aria-label="Retirer des favoris">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="favoris-item-price">300 MAD</div>
                                <div class="favoris-item-description">
                                    Microsoft Visual Studio 2024 Professional
                                </div>
                            </div>
                        </li>

                        <!-- Item 3 -->
                        <li class="favoris-item">
                            <div class="favoris-item-image">
                                <img src="../assets/images/d-product.png" alt="Produit 3">
                            </div>
                            <div class="favoris-item-details">
                                <div class="favoris-item-top">
                                    <h5 class="favoris-item-title">Microsoft Windows 11 Pro</h5>
                                    <div class="favoris-item-actions">
                                        <button class="favoris-item-cart" aria-label="Ajouter au panier">
                                            <i class="fas fa-shopping-cart"></i>
                                        </button>
                                        <button class="favoris-item-remove" aria-label="Retirer des favoris">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="favoris-item-price">400 MAD</div>
                                <div class="favoris-item-description">
                                    Microsoft Windows 11 Pro - Licence à vie
                                </div>
                            </div>
                        </li>
                    </ul>

                    <!-- Message si aucun favori -->
                    <div class="empty-favorites" style="display: none;">
                        <i class="far fa-heart"></i>
                        <h2>Aucun favori pour le moment</h2>
                        <p>Explorez notre catalogue et ajoutez des produits à vos favoris</p>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Gestion des boutons de suppression des favoris
            const removeButtons = document.querySelectorAll('.remove-favorite');
            removeButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const card = this.closest('.product-card');
                    card.style.opacity = '0';
                    setTimeout(() => {
                        card.remove();
                        checkEmptyFavorites();
                    }, 300);
                });
            });

            // Vérifier si la liste des favoris est vide
            function checkEmptyFavorites() {
                const products = document.querySelectorAll('.product-card');
                const emptyMessage = document.querySelector('.empty-favorites');
                if (products.length === 0) {
                    emptyMessage.style.display = 'block';
                }
            }
        });
    </script>
</body>
</html>
