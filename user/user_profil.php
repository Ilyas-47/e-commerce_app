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
            font-family: 'Inter', 'Segoe UI', sans-serif;
        }
        
        :root {
            --primary: #1e40af;          /* Deep blue */
            --secondary: #1e3a8a;        /* Darker blue */
            --accent: #3b82f6;           /* Bright blue */
            --accent-light: #93c5fd;     /* Light blue */
            --dark: #0f172a;             /* Almost black blue */
            --light: #f8fafc;            /* Off-white */
            --success: #0d9488;          /* Teal green */
            --danger: #dc2626;           /* Red */
            --gray: #64748b;             /* Slate gray */
            --light-gray: #e2e8f0;       /* Light gray */
            --card-bg: #ffffff;          /* Card background */
            --subtle-bg: #f1f5f9;        /* Subtle background */
            --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.1);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            --border-radius-sm: 6px;
            --border-radius-md: 8px;
            --border-radius-lg: 12px;
        }
        
        body {
            background-color: var(--subtle-bg);
            color: var(--dark);
            line-height: 1.6;
        }

        .container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .dashboard-section {
            display: grid;
            grid-template-columns: 280px 1fr;
            gap: 24px;
            margin: 30px 0;
        }

        .dashboard-content {
            background-color: var(--card-bg);
            border-radius: var(--border-radius-lg);
            box-shadow: var(--shadow-md);
            padding: 30px;
        }

        .section-title {
            color: var(--dark);
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 25px;
            border-bottom: 2px solid var(--light-gray);
            padding-bottom: 15px;
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(230px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }

        .stat-card {
            background: linear-gradient(135deg, var(--card-bg) 0%, var(--light) 100%);
            border-radius: var(--border-radius-md);
            padding: 25px;
            box-shadow: var(--shadow-sm);
            border-left: 4px solid var(--accent);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
        }

        .stat-card .stat-icon {
            font-size: 22px;
            color: var(--accent);
            margin-bottom: 15px;
            background-color: rgba(59, 130, 246, 0.1);
            width: 48px;
            height: 48px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .stat-card .stat-number {
            font-size: 32px;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 5px;
        }

        .stat-card .stat-label {
            color: var(--gray);
            font-size: 14px;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .stat-card::after {
            content: '';
            position: absolute;
            top: -20px;
            right: -20px;
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background-color: rgba(59, 130, 246, 0.05);
            z-index: 0;
        }

        /* Downloads Section */
        .downloads-section {
            margin-bottom: 40px;
        }

        .section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .section-header h2 {
            font-size: 20px;
            font-weight: 600;
            color: var(--primary);
        }

        .downloads-list {
            background-color: var(--light);
            border-radius: var(--border-radius-md);
            overflow: hidden;
            box-shadow: var(--shadow-sm);
        }

        .download-item {
            display: flex;
            align-items: center;
            padding: 18px 20px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            transition: background-color 0.3s ease;
        }

        .download-item:last-child {
            border-bottom: none;
        }

        .download-item:hover {
            background-color: rgba(59, 130, 246, 0.05);
        }

        .download-icon {
            font-size: 20px;
            width: 40px;
            height: 40px;
            border-radius: 8px;
            background-color: rgba(59, 130, 246, 0.1);
            color: var(--accent);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            flex-shrink: 0;
        }

        .download-details {
            flex: 1;
        }

        .download-name {
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 5px;
        }

        .download-meta {
            display: flex;
            gap: 15px;
            color: var(--gray);
            font-size: 13px;
        }

        .download-actions {
            display: flex;
            gap: 10px;
        }

        /* Subscription Section */
        .subscription {
            background-color: var(--light);
            border-radius: var(--border-radius-md);
            padding: 25px;
            box-shadow: var(--shadow-sm);
        }

        .subscription-title {
            font-size: 20px;
            font-weight: 600;
            color: var(--primary);
            margin-bottom: 20px;
        }

        .subscription-info {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 20px;
        }

        .subscription-badge {
            background-color: var(--primary);
            color: white;
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 14px;
        }

        .subscription-date {
            color: var(--gray);
            font-size: 14px;
        }

        .subscription-features {
            margin-bottom: 25px;
        }

        .feature {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 12px;
            color: var(--dark);
        }

        .feature-icon {
            color: var(--success);
            font-size: 16px;
        }

        .subscription-actions {
            display: flex;
            gap: 15px;
        }

        /* Buttons */
        .btn {
            padding: 10px 20px;
            border-radius: var(--border-radius-sm);
            font-weight: 500;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            border: none;
        }

        .btn-primary {
            background-color: var(--primary);
            color: white;
        }

        .btn-primary:hover {
            background-color: var(--secondary);
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .btn-outline {
            background-color: transparent;
            border: 1px solid var(--primary);
            color: var(--primary);
        }

        .btn-outline:hover {
            background-color: var(--primary);
            color: white;
        }

        .btn-icon {
            width: 38px;
            height: 38px;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
        }

        /* Toast Notification */
        .toast {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: white;
            color: var(--dark);
            padding: 15px 20px;
            border-radius: var(--border-radius-sm);
            box-shadow: var(--shadow-lg);
            display: flex;
            align-items: center;
            justify-content: space-between;
            min-width: 300px;
            z-index: 1000;
            border-left: 4px solid var(--accent);
            transform: translateY(100px);
            opacity: 0;
            transition: all 0.3s ease;
        }

        .toast-success {
            border-left-color: var(--success);
        }

        .toast-error {
            border-left-color: var(--danger);
        }

        .toast-content {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .toast-content i {
            color: var(--accent);
            font-size: 20px;
        }

        .toast-success i {
            color: var(--success);
        }

        .toast-error i {
            color: var(--danger);
        }

        .toast-message {
            font-weight: 500;
        }

        .toast-close {
            background: none;
            border: none;
            color: var(--gray);
            cursor: pointer;
            font-size: 16px;
        }

        @media (max-width: 992px) {
            .dashboard-section {
                grid-template-columns: 1fr;
            }
            
            .stats-grid {
                grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            }
        }

        @media (max-width: 768px) {
            .download-item {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .download-actions {
                margin-top: 15px;
                width: 100%;
                justify-content: space-between;
            }
            
            .subscription-actions {
                flex-direction: column;
            }
            
            .btn {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
   <main>
        <div class="container">
            <div class="dashboard-section">
                <?php include('user_nav.php'); ?>
                
                <div class="dashboard-content">
                    <h1 class="section-title">Tableau de bord</h1>
                    
                    <div class="stats-grid">
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
                    
                    <div class="downloads-section">
                        <div class="section-header">
                            <h2>Téléchargements récents</h2>
                            <a href="#" class="btn btn-outline">Voir tout</a>
                        </div>
                        <div class="downloads-list">
                            <div class="download-item">
                                <div class="download-icon"><i class="fas fa-file-pdf"></i></div>
                                <div class="download-details">
                                    <div class="download-name">Guide Complet Adobe Photoshop 2025</div>
                                    <div class="download-meta">
                                        <div class="download-date"><i class="far fa-calendar-alt"></i> 02/05/2025</div>
                                        <div class="download-size"><i class="fas fa-hdd"></i> 245 MB</div>
                                        <div class="download-format"><i class="far fa-file"></i> PDF</div>
                                    </div>
                                </div>
                                <div class="download-actions">
                                    <button class="btn btn-primary"><i class="fas fa-download"></i> Télécharger</button>
                                    <button class="btn btn-outline"><i class="fas fa-info-circle"></i> Détails</button>
                                </div>
                            </div>
                            <div class="download-item">
                                <div class="download-icon"><i class="fas fa-file-video"></i></div>
                                <div class="download-details">
                                    <div class="download-name">Masterclass Montage Vidéo Professionnel</div>
                                    <div class="download-meta">
                                        <div class="download-date"><i class="far fa-calendar-alt"></i> 28/04/2025</div>
                                        <div class="download-size"><i class="fas fa-hdd"></i> 1.2 GB</div>
                                        <div class="download-format"><i class="far fa-file"></i> MP4</div>
                                    </div>
                                </div>
                                <div class="download-actions">
                                    <button class="btn btn-primary"><i class="fas fa-download"></i> Télécharger</button>
                                    <button class="btn btn-outline"><i class="fas fa-info-circle"></i> Détails</button>
                                </div>
                            </div>
                            <div class="download-item">
                                <div class="download-icon"><i class="fas fa-file-archive"></i></div>
                                <div class="download-details">
                                    <div class="download-name">Pack 50 Templates WordPress Premium</div>
                                    <div class="download-meta">
                                        <div class="download-date"><i class="far fa-calendar-alt"></i> 15/04/2025</div>
                                        <div class="download-size"><i class="fas fa-hdd"></i> 785 MB</div>
                                        <div class="download-format"><i class="far fa-file"></i> ZIP</div>
                                    </div>
                                </div>
                                <div class="download-actions">
                                    <button class="btn btn-primary"><i class="fas fa-download"></i> Télécharger</button>
                                    <button class="btn btn-outline"><i class="fas fa-info-circle"></i> Détails</button>
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
                                <div class="feature-icon"><i class="fas fa-check-circle"></i></div>
                                <div>Téléchargements illimités</div>
                            </div>
                            <div class="feature">
                                <div class="feature-icon"><i class="fas fa-check-circle"></i></div>
                                <div>Accès à tous les produits Premium</div>
                            </div>
                            <div class="feature">
                                <div class="feature-icon"><i class="fas fa-check-circle"></i></div>
                                <div>Support prioritaire 24/7</div>
                            </div>
                            <div class="feature">
                                <div class="feature-icon"><i class="fas fa-check-circle"></i></div>
                                <div>Mises à jour gratuites</div>
                            </div>
                        </div>
                        <div class="subscription-actions">
                            <button class="btn btn-primary">Passer à l'offre Pro</button>
                            <button class="btn btn-outline">Annuler l'abonnement</button>
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
                toast.classList.add('toast');
                
                if (type === 'success') {
                    toast.classList.add('toast-success');
                } else if (type === 'error') {
                    toast.classList.add('toast-error');
                }
                
                toast.innerHTML = `
                    <div class="toast-content">
                        <i class="fas ${type === 'success' ? 'fa-check-circle' : type === 'error' ? 'fa-exclamation-circle' : 'fa-info-circle'}"></i>
                        <div class="toast-message">${message}</div>
                    </div>
                    <button class="toast-close"><i class="fas fa-times"></i></button>
                `;
                
                document.body.appendChild(toast);
                
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
                const closeButton = toast.querySelector('.toast-close');
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
            const downloadButtons = document.querySelectorAll('.download-actions .btn-primary');
            downloadButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const downloadName = this.closest('.download-item').querySelector('.download-name').textContent;
                    showToast(`Téléchargement de "${downloadName}" démarré.`, 'success');
                });
            });
            
            // Ajouter des événements aux boutons d'abonnement
            const upgradeButton = document.querySelector('.subscription-actions .btn-primary');
            if (upgradeButton) {
                upgradeButton.addEventListener('click', function() {
                    showToast('Redirection vers les options de mise à niveau...', 'info');
                });
            }
            
            const cancelButton = document.querySelector('.subscription-actions .btn-outline');
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
            
            // Simuler un chargement de données
            setTimeout(() => {
                showToast('Bienvenue, ' + userData.name + '!', 'success');
            }, 1000);
        });
    </script>
    <?php include("../includes/footer.php")?>
</body>
</html>