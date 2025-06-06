<?php
// Démarrer la session seulement si elle n'est pas déjà active
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: ../user/login.php");
    exit();
}

require_once('../connection/connection.php');

// Récupérer les informations de l'utilisateur connecté
try {
    $req = $pdo->prepare("SELECT id_user, nom, gmail, password, image, telephone, role FROM user WHERE id_user = :id_user");
    $req->bindParam(':id_user', $_SESSION['user_id'], PDO::PARAM_INT);
    $req->execute();

    $user = $req->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        // Si l'utilisateur n'existe pas, déconnecter
        session_destroy();
        header("Location: ../user/login.php");
        exit();
    }
} catch (Exception $e) {
    error_log("Erreur lors de la récupération des données utilisateur: " . $e->getMessage());
    header("Location: ../user/login.php");
    exit();
}
?>
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
                    
                    <form id="personal-info-form" action="../system/system_modif_user_info.php" method="POST" enctype="multipart/form-data">
                        <div class="form-section">
                            <h2 class="form-title">Informations de base</h2>
                            <div class="form-group">
                                <label for="avatar" class="form-label">Photo de profil</label>
                                <div class="file-upload">
                                    <div class="avatar-preview">
                                        <img src="<?php echo htmlspecialchars($user['image'] ?? '../assets/images/user.png'); ?>" alt="Avatar" onerror="this.src='../assets/images/user.png'">
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
                                    <input type="text" id="full-name" class="form-control" value="<?php echo htmlspecialchars($user['nom'] ?? ''); ?>">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" id="email" class="form-control" value="<?php echo htmlspecialchars($user['gmail'] ?? ''); ?>">
                                    <div class="account-verified">
                                        <i class="fas fa-check-circle"></i> Vérifié
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="phone" class="form-label">Téléphone</label>
                                    <input type="tel" id="phone" class="form-control" value="<?php echo htmlspecialchars($user['telephone'] ?? ''); ?>">
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
                                    <input type="password" id="current-password" class="form-control" placeholder="Saisissez votre mot de passe actuel">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="new-password" class="form-label">Nouveau mot de passe</label>
                                    <input type="password" id="new-password" class="form-control" placeholder="Saisissez votre nouveau mot de passe">
                                    <small class="form-text">Le mot de passe doit contenir au moins 8 caractères, une majuscule, un chiffre et un caractère spécial.</small>
                                </div>
                                <div class="form-group">
                                    <label for="confirm-password" class="form-label">Confirmer le nouveau mot de passe</label>
                                    <input type="password" id="confirm-password" class="form-control" placeholder="Confirmez votre nouveau mot de passe">
                                </div>
                            </div>
                        </div>

                        <div class="action-buttons">
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

            const currentPassword = document.getElementById('current-password').value;
            const newPassword = document.getElementById('new-password').value;
            const confirmPassword = document.getElementById('confirm-password').value;
            const fullName = document.getElementById('full-name').value;
            const email = document.getElementById('email').value;
            const phone = document.getElementById('phone').value;

            // Vérifier si l'utilisateur veut changer le mot de passe
            if (newPassword || confirmPassword) {
                // Si l'utilisateur veut changer le mot de passe, tous les champs doivent être remplis
                if (!currentPassword) {
                    showToast('Veuillez saisir votre mot de passe actuel', 'error');
                    return;
                }
                if (!newPassword) {
                    showToast('Veuillez saisir votre nouveau mot de passe', 'error');
                    return;
                }
                if (!confirmPassword) {
                    showToast('Veuillez confirmer votre nouveau mot de passe', 'error');
                    return;
                }
                if (newPassword !== confirmPassword) {
                    showToast('Les mots de passe ne correspondent pas', 'error');
                    return;
                }
            }

            // Validation des champs obligatoires
            if (!fullName.trim()) {
                showToast('Le nom complet est requis', 'error');
                return;
            }
            if (!email.trim()) {
                showToast('L\'email est requis', 'error');
                return;
            }
            if (!phone.trim()) {
                showToast('Le téléphone est requis', 'error');
                return;
            }

            if (confirm('Êtes-vous sûr de vouloir enregistrer ces modifications ?')) {
                // Préparer les données à envoyer
                const formData = new FormData();
                formData.append('id_user', '<?php echo $user['id_user']; ?>');
                formData.append('nom', fullName);
                formData.append('gmail', email);
                formData.append('telephone', phone);

                // Ajouter l'image si elle a été sélectionnée
                const avatarInput = document.getElementById('avatar-input');
                if (avatarInput.files.length > 0) {
                    formData.append('avatar', avatarInput.files[0]);
                }

                // Ajouter les données de mot de passe si nécessaire
                if (newPassword) {
                    formData.append('current_password', currentPassword);
                    formData.append('new_password', newPassword);
                }

                // Envoyer la requête AJAX
                fetch('../system_user/system_modif_user_info.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(data => {
                    if (data === 'success') {
                        showToast('Vos modifications ont été enregistrées avec succès !', 'success');
                        // Réinitialiser seulement les champs de mot de passe
                        document.getElementById('current-password').value = '';
                        document.getElementById('new-password').value = '';
                        document.getElementById('confirm-password').value = '';
                        // Recharger la page pour afficher les nouvelles données
                        setTimeout(() => {
                            window.location.reload();
                        }, 1500);
                    } else if (data === 'error_current_password') {
                        showToast('Le mot de passe actuel est incorrect', 'error');
                    } else if (data === 'error_email_exists') {
                        showToast('Cet email est déjà utilisé par un autre utilisateur', 'error');
                    } else if (data === 'error_unauthorized') {
                        showToast('Vous n\'êtes pas autorisé à effectuer cette modification', 'error');
                    } else {
                        showToast('Une erreur est survenue lors de la modification', 'error');
                    }
                })
                .catch(error => {
                    console.error('Erreur:', error);
                    showToast('Une erreur est survenue lors de la modification', 'error');
                });
            }
        });

        // Prévisualisation de l'image sélectionnée
        document.getElementById('avatar-input').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.querySelector('.avatar-preview img').src = e.target.result;
                };
                reader.readAsDataURL(file);
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