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
            --warning: #ff9800;
            --gray: #6c757d;
            --light-gray: #e9ecef;
        }

        :root {
            --info-primary: #2D3250;
            --info-secondary: #424769;
            --info-accent: #676F9D;
            --info-light: #F9F9F9;
            --info-success: #43A047;
            --info-danger: #E53935;
            --info-warning: #FB8C00;
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
        
        .profile-section {
            display: grid;
            grid-template-columns: 250px 1fr;
            gap: 30px;
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
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .section-title i {
            color: var(--primary);
        }
        
        .section-description {
            color: var(--gray);
            margin-bottom: 30px;
            font-size: 14px;
        }
        
        .form-section {
            margin-bottom: 40px;
        }
        
        .form-section:last-child {
            margin-bottom: 0;
        }
        
        .form-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 20px;
            color: var(--dark);
            padding-bottom: 10px;
            border-bottom: 1px solid var(--light-gray);
        }
        
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
        }
        
        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid var(--light-gray);
            border-radius: 4px;
            font-size: 14px;
            transition: border-color 0.3s;
        }
        
        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.1);
        }
        
        .form-select {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid var(--light-gray);
            border-radius: 4px;
            font-size: 14px;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%236c757d' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14L2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 15px center;
            background-size: 16px;
        }
        
        .form-check {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }
        
        .form-check:last-child {
            margin-bottom: 0;
        }
        
        .form-check-input {
            margin-right: 10px;
            width: 18px;
            height: 18px;
            border: 1px solid var(--light-gray);
            border-radius: 3px;
            appearance: none;
            background-color: white;
            position: relative;
            cursor: pointer;
            transition: border-color 0.3s, background-color 0.3s;
        }
        
        .form-check-input:checked {
            background-color: var(--primary);
            border-color: var(--primary);
        }
        
        .form-check-input:checked::after {
            content: "";
            position: absolute;
            top: 3px;
            left: 6px;
            width: 4px;
            height: 8px;
            border: solid white;
            border-width: 0 2px 2px 0;
            transform: rotate(45deg);
        }
        
        .form-check-label {
            font-size: 14px;
            cursor: pointer;
        }
        
        .form-text {
            display: block;
            margin-top: 5px;
            font-size: 12px;
            color: var(--gray);
        }
        
        .action-buttons {
            display: flex;
            justify-content: flex-end;
            gap: 15px;
            margin-top: 30px;
        }
        
        .btn {
            padding: 12px 20px;
            border-radius: 4px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s;
            border: none;
            font-size: 14px;
        }
        
        .btn-primary {
            background-color: var(--primary);
            color: white;
        }
        
        .btn-primary:hover {
            background-color: var(--secondary);
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
        
        .account-verified {
            display: inline-flex;
            align-items: center;
            background-color: rgba(76, 201, 240, 0.1);
            color: var(--accent);
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 500;
            margin-left: 10px;
        }
        
        .account-verified i {
            margin-right: 5px;
        }
        
        .account-not-verified {
            display: inline-flex;
            align-items: center;
            background-color: rgba(255, 152, 0, 0.1);
            color: var(--warning);
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 500;
            margin-left: 10px;
        }
        
        .account-not-verified i {
            margin-right: 5px;
        }
        
        .change-password-link {
            color: var(--primary);
            text-decoration: none;
            font-size: 14px;
            display: inline-flex;
            align-items: center;
        }
        
        .change-password-link i {
            margin-right: 5px;
        }
        
        .change-password-link:hover {
            text-decoration: underline;
        }
        
        .avatar-preview {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background-color: var(--light-gray);
            overflow: hidden;
            margin-right: 20px;
        }
        
        .avatar-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .file-upload {
            display: flex;
            align-items: center;
        }
        
        .file-upload-btn {
            display: inline-block;
            padding: 8px 16px;
            background-color: var(--light-gray);
            border-radius: 4px;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        
        .file-upload-btn:hover {
            background-color: var(--gray);
            color: white;
        }
        
        .file-upload-input {
            display: none;
        }
        
        .upload-hint {
            color: var(--gray);
            font-size: 12px;
            margin-top: 5px;
        }
        
        .notification-group {
            margin-bottom: 15px;
        }
        
        .notification-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }
        
        .notification-title {
            font-weight: 500;
        }
        
        .toggle-switch {
            position: relative;
            display: inline-block;
            width: 50px;
            height: 24px;
        }
        
        .toggle-switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }
        
        .toggle-slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: var(--light-gray);
            transition: .4s;
            border-radius: 24px;
        }
        
        .toggle-slider:before {
            position: absolute;
            content: "";
            height: 18px;
            width: 18px;
            left: 3px;
            bottom: 3px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }
        
        input:checked + .toggle-slider {
            background-color: var(--primary);
        }
        
        input:checked + .toggle-slider:before {
            transform: translateX(26px);
        }
        
        .notification-description {
            color: var (--gray);
            font-size: 12px;
        }
        
        .delete-account {
            color: var(--danger);
            text-decoration: none;
            font-size: 14px;
            margin-top: 20px;
            display: inline-block;
        }
        
        .delete-account:hover {
            text-decoration: underline;
        }
        
        @media (max-width: 768px) {
            .profile-section {
                grid-template-columns: 1fr;
            }
            
            .form-row {
                grid-template-columns: 1fr;
                gap: 15px;
            }
        }
        
        /* Toast notifications */
        .toast {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: white;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            border-radius: 4px;
            padding: 15px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            min-width: 300px;
            z-index: 1000;
            transition: all 0.3s ease;
            border-left: 4px solid var(--primary);
        }
        
        .toast-success {
            border-left-color: var(--success);
        }
        
        .toast-warning {
            border-left-color: var(--warning);
        }
        
        .toast-error {
            border-left-color: var(--danger);
        }
        
        .toast-content {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .toast-success .toast-icon {
            color: var (--success);
        }
        
        .toast-warning .toast-icon {
            color: var(--warning);
        }
        
        .toast-error .toast-icon {
            color: var(--danger);
        }
        
        .toast-info .toast-icon {
            color: var(--primary);
        }
        
        .toast-close {
            background: none;
            border: none;
            color: var(--gray);
            cursor: pointer;
        }
        
        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
        }
        
        .modal-content {
            position: relative;
            background-color: white;
            margin: 100px auto;
            padding: 30px;
            width: 90%;
            max-width: 500px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }
        
        .modal-close {
            position: absolute;
            top: 20px;
            right: 20px;
            font-size: 20px;
            cursor: pointer;
            color: var(--gray);
        }
        
        .modal-title {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid var(--light-gray);
        }

        .info-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .info-profile-section {
            display: grid;
            grid-template-columns: 250px 1fr;
            gap: 30px;
        }

        .info-content {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
            padding: 30px;
        }

        .info-form-control {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #E0E0E0;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .info-form-control:focus {
            border-color: var(--info-accent);
            box-shadow: 0 0 0 3px rgba(103, 111, 157, 0.1);
        }

        .info-btn {
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .info-btn-primary {
            background-color: var(--info-primary);
            color: white;
        }

        .info-btn-primary:hover {
            background-color: var(--info-secondary);
            transform: translateY(-1px);
        }

        .info-toast {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: white;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            border-radius: 8px;
            padding: 15px 20px;
            z-index: 1000;
            border-left: 4px solid var(--info-primary);
        }
    </style>
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
                                        <img src="/api/placeholder/200/200" alt="Avatar">
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
                            <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
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