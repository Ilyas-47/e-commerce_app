<!DOCTYPE html>
<html lang="fr">
<head>
        <?php include("../includes/nav.php")?>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/user_info.css">
</head>
<body>
    <main>
        <div class="container">
            <div class="profile-section">
                <?php include('user_nav.php'); ?>
                
                <div class="content">
                    <h1 class="section-title"><i class="fas fa-user-circle"></i> Informations Personnelles</h1>
                    <p class="section-description">Gérez vos informations personnelles et modifiez votre profil. Ces informations nous aident à personnaliser votre expérience et à sécuriser votre compte.</p>
                    
                    <form id="personal-info-form">
                        <div class="form-section">
                            <h2 class="form-title">Informations de base</h2>
                            <div class="form-group">
                                <label for="avatar" class="form-label">Photo de profil</label>
                                <div class="file-upload">
                                    <div class="avatar-preview">
                                        <img src="../assets/images/office.png" alt="Avatar">
                                    </div>
                                    <div>
                                        <label for="avatar-input" class="file-upload-btn">
                                            <i class="fas fa-upload"></i> Choisir une image
                                        </label>
                                        <input type="file" id="avatar-input" class="file-upload-input" accept="image/*">
                                        <p class="upload-hint">JPG, PNG ou GIF, 2 MB maximum</p>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="full-name" class="form-label">Nom complet</label>
                                    <input type="text" id="full-name" class="form-control" value="Jean Dupont">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" id="email" class="form-control" value="jean.dupont@example.com">
                                    <div class="account-verified">
                                        <i class="fas fa-check-circle"></i> Vérifié
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="phone" class="form-label">Téléphone</label>
                                    <input type="tel" id="phone" class="form-control" value="+33 6 12 34 56 78">
                                    <div class="account-not-verified">
                                        <i class="fas fa-exclamation-circle"></i> Non vérifié
                                    </div>
                                    <button type="button" class="verify-btn" style="margin-top: 10px; padding: 5px 10px; font-size: 12px; background-color: var(--primary); color: white; border: none; border-radius: 4px; cursor: pointer;">Vérifier maintenant</button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-section">
                            <h2 class="form-title">Modifier le mot de passe</h2>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="current-password" class="form-label">Mot de passe actuel</label>
                                    <input type="password" id="current-password" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="new-password" class="form-label">Nouveau mot de passe</label>
                                    <input type="password" id="new-password" class="form-control" required>
                                    <small class="form-text">Le mot de passe doit contenir au moins 8 caractères, une majuscule, un chiffre et un caractère spécial.</small>
                                </div>
                                <div class="form-group">
                                    <label for="confirm-password" class="form-label">Confirmer le nouveau mot de passe</label>
                                    <input type="password" id="confirm-password" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <div class="action-buttons">
                            <button type="button" class="btn btn-outline">Annuler</button>
                            <button type="submit" class="supp-btn">Enregistrer les modifications</button>
                        </div>
                    </form>
                    
                    <a href="#" class="delete-account">
                        <i class="fas fa-trash-alt"></i> Supprimer mon compte
                    </a>
                </div>
            </div>
        </div>
    </main>

    <!-- Toast notification will be dynamically added here -->
    <script>
        // Toast notification function
        function showToast(message, type = 'info') {
            const toast = document.createElement('div');
            toast.className = `toast toast-${type}`;
            toast.innerHTML = `
                <div class="toast-content">
                    <i class="fas fa-info-circle toast-icon"></i>
                    <span>${message}</span>
                </div>
                <button class="toast-close">
                    <i class="fas fa-times"></i>
                </button>
            `;
            
            document.body.appendChild(toast);
            
            // Remove toast after 3 seconds
            setTimeout(() => {
                toast.remove();
            }, 3000);
            
            // Close toast on click
            toast.querySelector('.toast-close').addEventListener('click', () => {
                toast.remove();
            });
        }

        function showInfoToast(message, type = 'info') {
            const toast = document.createElement('div');
            toast.className = `info-toast info-toast-${type}`;
            toast.innerHTML = `
                <div class="info-toast-content">
                    <i class="fas fa-info-circle info-toast-icon"></i>
                    <span>${message}</span>
                </div>
                <button class="info-toast-close">
                    <i class="fas fa-times"></i>
                </button>
            `;
            
            document.body.appendChild(toast);
            
            setTimeout(() => {
                toast.remove();
            }, 3000);
            
            toast.querySelector('.info-toast-close').addEventListener('click', () => {
                toast.remove();
            });
        }
        
        // Form submission handler avec validation du mot de passe
        document.getElementById('personal-info-form').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const newPassword = document.getElementById('new-password').value;
            const confirmPassword = document.getElementById('confirm-password').value;
            
            if (newPassword && newPassword !== confirmPassword) {
                showToast('Les mots de passe ne correspondent pas', 'error');
                return;
            }
            
            if (confirm('Êtes-vous sûr de vouloir enregistrer ces modifications ?')) {
                showToast('Vos modifications ont été enregistrées avec succès !', 'success');
                this.reset();
            }
        });

        // Delete account handler
        document.querySelector('.delete-account').addEventListener('click', function(e) {
            e.preventDefault();
            
            if (confirm('ATTENTION : Êtes-vous sûr de vouloir supprimer votre compte ? Cette action est irréversible.')) {
                if (confirm('Cette action supprimera définitivement toutes vos données. Confirmez-vous la suppression ?')) {
                    showToast('Votre compte a été supprimé avec succès', 'warning');
                    // Redirection vers la page d'accueil après 2 secondes
                    setTimeout(() => {
                        window.location.href = '/';
                    }, 2000);
                }
            }
        });
    </script>
    <?php include("../includes/footer.php")?>

</body>
</html>