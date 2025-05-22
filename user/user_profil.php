<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include("../includes/nav.php")?>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/user_profil.css">
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