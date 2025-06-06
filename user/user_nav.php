<?php
// Démarrer la session seulement si elle n'est pas déjà active
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Vérifier si l'utilisateur est connecté et récupérer ses données
$userName = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : 'Utilisateur';
$userEmail = isset($_SESSION['user_gmail']) ? $_SESSION['user_gmail'] : '';
$userImage = isset($_SESSION['user_image']) ? $_SESSION['user_image'] : '../assets/images/user.png';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
     <link rel="stylesheet" href="../assets/css/user_nav.css">
</head>
<body>
    <div class="sidebar">
        <div class="user-info">
            <div class="avatar">
                <img src="<?php echo htmlspecialchars($userImage); ?>" alt="Profile" style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;" onerror="this.src='../assets/images/user.png'">
            </div>
            <div class="user-name"><?php echo htmlspecialchars($userName); ?></div>
            <div class="user-email"><?php echo htmlspecialchars($userEmail); ?></div>
        </div>
        <ul class="menu">
            <!-- <li><a href="user_profil.php"><i class="fas fa-tachometer-alt"></i> Tableau de bord</a></li> -->
            <li><a href="user_info.php"><i class="fas fa-user"></i> Informations personnelles</a></li>
            <li><a href="user_commande.php"><i class="fas fa-shopping-bag"></i> Mes commandes</a></li>
            <li><a href="user_pay.php"><i class="fas fa-credit-card"></i> Moyens de paiement</a></li>
            <li><a href="user_favoris.php"><i class="fas fa-heart"></i> Liste de souhaits</a></li>
            <li><a href="user_support.php"><i class="fas fa-headset"></i> Support</a></li>
            <li><a href="../includes/deconnect.php"><i class="fas fa-sign-out-alt"></i> Déconnexion</a></li>
        </ul>
    </div>
</body>
</html>