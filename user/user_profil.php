<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DigiStore - Mon Profil</title>
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
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        .nav-links {
            display: flex;
            gap: 30px;
        }
        
        .nav-links a {
            text-decoration: none;
            color: var(--dark);
            font-weight: 500;
            transition: color 0.3s;
        }
        
        .nav-links a:hover {
            color: var(--primary);
        }
        
        .user-actions {
            display: flex;
            align-items: center;
            gap: 20px;
        }
        
        .user-actions .btn {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 4px;
            background-color: var(--primary);
            color: white;
            text-decoration: none;
            font-weight: 500;
            transition: background-color 0.3s;
        }
        
        .user-actions .btn:hover {
            background-color: var(--secondary);
        }
        
        .user-actions .cart {
            position: relative;
        }
        
        .cart-count {
            position: absolute;
            top: -10px;
            right: -10px;
            background-color: var(--accent);
            color: white;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: bold;
        }
        
        main {
            padding: 40px 0;
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
        
        .menu li:last-child {
            margin-bottom: 0;
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
        
        .content {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            padding: 30px;
        }
        
        .section-title {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 25px;
            color: var(--dark);
        }
        
        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }
        
        .stat-card {
            background-color: var(--light);
            border-radius: 8px;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            transition: transform 0.3s;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
        }
        
        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: rgba(67, 97, 238, 0.1);
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            margin-bottom: 15px;
        }
        
        .stat-number {
            font-size: 24px;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 5px;
        }
        
        .stat-label {
            color: var(--gray);
            font-size: 14px;
        }
        
        .recent-downloads {
            margin-bottom: 40px;
        }
        
        .recent-downloads-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 15px;
            color: var(--dark);
        }
        
        .download-list {
            background-color: var(--light);
            border-radius: 8px;
            overflow: hidden;
        }
        
        .download-item {
            display: flex;
            align-items: center;
            padding: 15px 20px;
            border-bottom: 1px solid var(--light-gray);
        }
        
        .download-item:last-child {
            border-bottom: none;
        }
        
        .download-icon {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            background-color: rgba(67, 97, 238, 0.1);
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            margin-right: 15px;
        }
        
        .download-details {
            flex: 1;
        }
        
        .download-name {
            font-weight: 600;
            margin-bottom: 5px;
        }
        
        .download-meta {
            display: flex;
            color: var(--gray);
            font-size: 12px;
        }
        
        .download-date {
            margin-right: 20px;
        }
        
        .download-size {
            margin-right: 20px;
        }
        
        .download-actions {
            display: flex;
            gap: 10px;
        }
        
        .download-actions button {
            background: none;
            border: none;
            cursor: pointer;
            color: var(--primary);
            font-size: 14px;
        }
        
        .download-actions button:hover {
            text-decoration: underline;
        }
        
        .subscription {
            background-color: var(--light);
            border-radius: 8px;
            padding: 20px;
        }
        
        .subscription-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 15px;
            color: var(--dark);
        }
        
        .subscription-info {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        
        .subscription-badge {
            background-color: var(--accent);
            color: white;
            font-weight: 500;
            padding: 5px 10px;
            border-radius: 20px;
            margin-right: 15px;
        }
        
        .subscription-date {
            color: var(--gray);
            font-size: 14px;
        }
        
        .subscription-features {
            margin-bottom: 20px;
        }
        
        .feature {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }
        
        .feature-icon {
            color: var(--success);
            margin-right: 10px;
        }
        
        .subscription-actions {
            display: flex;
            gap: 10px;
        }
        
        .btn-upgrade {
            background-color: var(--primary);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        
        .btn-upgrade:hover {
            background-color: var(--secondary);
        }
        
        .btn-cancel {
            background-color: transparent;
            color: var(--danger);
            border: 1px solid var(--danger);
            padding: 10px 20px;
            border-radius: 4px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        
        .btn-cancel:hover {
            background-color: rgba(244, 67, 54, 0.1);
        }
        
        @media (max-width: 768px) {
            .profile-section {
                grid-template-columns: 1fr;
            }
            
            .nav-links {
                display: none;
            }
            
            .stats {
                grid-template-columns: 1fr 1fr;
            }

            .sidebar {
                margin-bottom: 20px;
            }
        }
        
        @media (max-width: 480px) {
            .stats {
                grid-template-columns: 1fr;
            }
            
            .download-item {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .download-icon {
                margin-bottom: 10px;
            }
            
            .download-actions {
                width: 100%;
                margin-top: 10px;
                justify-content: flex-start;
            }
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
                    <h1 class="section-title">Tableau de bord</h1>
                    
                    <div class="stats">
                        <div class="stat-card">
                            <div class="stat-icon"><i class="fas fa-download"></i></div>
                            <div class="stat-number">12</div>
                            <div class="stat-label">Téléchargements</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon"><i class="fas fa-shopping-bag"></i></div>
                            <div class="stat-number">8</div>
                            <div class="stat-label">Produits achetés</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon"><i class="fas fa-heart"></i></div>
                            <div class="stat-number">5</div>
                            <div class="stat-label">Liste de souhaits</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon"><i class="fas fa-euro-sign"></i></div>
                            <div class="stat-number">320€</div>
                            <div class="stat-label">Total dépensé</div>
                        </div>
                    </div>
                    
                    <div class="recent-downloads">
                        <h2 class="recent-downloads-title">Téléchargements récents</h2>
                        <div class="download-list">
                            <div class="download-item">
                                <div class="download-icon"><i class="fas fa-file-pdf"></i></div>
                                <div class="download-details">
                                    <div class="download-name">Guide Complet Adobe Photoshop 2025</div>
                                    <div class="download-meta">
                                        <div class="download-date">02/05/2025</div>
                                        <div class="download-size">245 MB</div>
                                        <div class="download-format">PDF</div>
                                    </div>
                                </div>
                                <div class="download-actions">
                                    <button><i class="fas fa-download"></i> Télécharger</button>
                                    <button><i class="fas fa-info-circle"></i> Détails</button>
                                </div>
                            </div>
                            <div class="download-item">
                                <div class="download-icon"><i class="fas fa-file-video"></i></div>
                                <div class="download-details">
                                    <div class="download-name">Masterclass Montage Vidéo Professionnel</div>
                                    <div class="download-meta">
                                        <div class="download-date">28/04/2025</div>
                                        <div class="download-size">1.2 GB</div>
                                        <div class="download-format">MP4</div>
                                    </div>
                                </div>
                                <div class="download-actions">
                                    <button><i class="fas fa-download"></i> Télécharger</button>
                                    <button><i class="fas fa-info-circle"></i> Détails</button>
                                </div>
                            </div>
                            <div class="download-item">
                                <div class="download-icon"><i class="fas fa-file-archive"></i></div>
                                <div class="download-details">
                                    <div class="download-name">Pack 50 Templates WordPress Premium</div>
                                    <div class="download-meta">
                                        <div class="download-date">15/04/2025</div>
                                        <div class="download-size">785 MB</div>
                                        <div class="download-format">ZIP</div>
                                    </div>
                                </div>
                                <div class="download-actions">
                                    <button><i class="fas fa-download"></i> Télécharger</button>
                                    <button><i class="fas fa-info-circle"></i> Détails</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="subscription">
                        <h2 class="subscription-title">Abonnement</h2>
                        <div class="subscription-info">
                            <div class="subscription-badge">Premium</div>
                            <div class="subscription-date">Renouvellement prévu le 15/06/2025</div>
                        </div>
                        <div class="subscription-features">
                            <div class="feature">
                                <div class="feature-icon"><i class="fas fa-check"></i></div>
                                <div>Téléchargements illimités</div>
                            </div>
                            <div class="feature">
                                <div class="feature-icon"><i class="fas fa-check"></i></div>
                                <div>Accès à tous les produits Premium</div>
                            </div>
                            <div class="feature">
                                <div class="feature-icon"><i class="fas fa-check"></i></div>
                                <div>Support prioritaire 24/7</div>
                            </div>
                            <div class="feature">
                                <div class="feature-icon"><i class="fas fa-check"></i></div>
                                <div>Mises à jour gratuites</div>
                            </div>
                        </div>
                        <div class="subscription-actions">
                            <button class="btn-upgrade">Passer à l'offre Pro</button>
                            <button class="btn-cancel">Annuler l'abonnement</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Fonction pour afficher un toast de notification
            function showToast(message, type = 'info') {
                const toast = document.createElement('div');
                toast.classList.add('toast', `toast-${type}`);
                toast.innerHTML = `
                    <div class="toast-content">
                        <i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-info-circle'}"></i>
                        <div class="toast-message">${message}</div>
                    </div>
                    <button class="toast-close"><i class="fas fa-times"></i></button>
                `;
                
                document.body.appendChild(toast);
                
                // Styliser le toast
                Object.assign(toast.style, {
                    position: 'fixed',
                    bottom: '20px',
                    right: '20px',
                    backgroundColor: type === 'success' ? '#4caf50' : '#4361ee',
                    color: 'white',
                    padding: '15px 20px',
                    borderRadius: '4px',
                    boxShadow: '0 4px 12px rgba(0, 0, 0, 0.15)',
                    display: 'flex',
                    alignItems: 'center',
                    justifyContent: 'space-between',
                    minWidth: '300px',
                    zIndex: '1000',
                    transform: 'translateY(100px)',
                    opacity: '0',
                    transition: 'all 0.3s ease'
                });
                
                // Styliser le contenu du toast
                const toastContent = toast.querySelector('.toast-content');
                Object.assign(toastContent.style, {
                    display: 'flex',
                    alignItems: 'center',
                    gap: '10px'
                });
                
                // Styliser le bouton de fermeture
                const closeButton = toast.querySelector('.toast-close');
                Object.assign(closeButton.style, {
                    background: 'none',
                    border: 'none',
                    color: 'white',
                    cursor: 'pointer'
                });
                
                // Animer l'apparition du toast
                setTimeout(() => {
                    toast.style.transform = 'translateY(0)';
                    toast.style.opacity = '1';
                }, 10);
                
                // Fermer le toast après 5 secondes
                const timeout = setTimeout(() => {
                    closeToast();
                }, 5000);
                
                // Fermer le toast en cliquant sur le bouton de fermeture
                closeButton.addEventListener('click', () => {
                    clearTimeout(timeout);
                    closeToast();
                });
                
                // Fonction pour fermer le toast
                function closeToast() {
                    toast.style.transform = 'translateY(100px)';
                    toast.style.opacity = '0';
                    setTimeout(() => {
                        toast.remove();
                    }, 300);
                }
            }
            
            // Ajouter des événements aux boutons de téléchargement
            const downloadButtons = document.querySelectorAll('.download-actions button:first-child');
            downloadButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const downloadName = this.closest('.download-item').querySelector('.download-name').textContent;
                    showToast(`Téléchargement de "${downloadName}" démarré.`, 'success');
                });
            });
            
            // Ajouter des événements aux boutons d'abonnement
            const upgradeButton = document.querySelector('.btn-upgrade');
            if (upgradeButton) {
                upgradeButton.addEventListener('click', function() {
                    showToast('Redirection vers les options de mise à niveau...', 'info');
                });
            }
            
            const cancelButton = document.querySelector('.btn-cancel');
            if (cancelButton) {
                cancelButton.addEventListener('click', function() {
                    if (confirm('Êtes-vous sûr de vouloir annuler votre abonnement Premium ?')) {
                        showToast('Demande d\'annulation envoyée.', 'info');
                    }
                });
            }
            
            // Exemple de chargement asynchrone des données utilisateur
            const userData = {
                name: 'Jean Dupont',
                email: 'jean.dupont@example.com',
                stats: {
                    downloads: 12,
                    purchased: 8,
                    wishlist: 5,
                    totalSpent: '320€'
                }
            };
            
            // Mettre à jour les statistiques avec les données utilisateur
            function updateUserStats() {
                // Mettre à jour le nom et l'email
                document.querySelector('.user-name').textContent = userData.name;
                document.querySelector('.user-email').textContent = userData.email;
                
                // Mettre à jour les statistiques
                const statNumbers = document.querySelectorAll('.stat-number');
                statNumbers[0].textContent = userData.stats.downloads;
                statNumbers[1].textContent = userData.stats.purchased;
                statNumbers[2].textContent = userData.stats.wishlist;
                statNumbers[3].textContent = userData.stats.totalSpent;
                
                // Mettre à jour l'avatar avec les initiales
                const nameParts = userData.name.split(' ');
                const initials = nameParts.map(part => part[0]).join('');
                document.querySelector('.avatar').textContent = initials;
            }
            
            // Appeler la fonction pour mettre à jour les statistiques
            updateUserStats();
        });
    </script>
</body>
</html>