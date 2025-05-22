<!DOCTYPE html>
<html lang="en">
   <head>
      <title>E-commerce</title>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="format-detection" content="telephone=no">
      <meta name="apple-mobile-web-app-capable" content="yes">
      <meta name="author" content="">
      <meta name="keywords" content="">
      <meta name="description" content="">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
      <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
      <link rel="stylesheet" href="../assets/css/style_admin.css">
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&family=Open+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
   </head>
   <body>
    <style>
        .menu-item a,
.menu-item a:hover,
.menu-item a:visited,
.menu-item a:active {
    text-decoration: none;
    color: white;
}

.menu-item span {
    color: white;
}
    </style>
   <div class="container">
        <div class="sidebar">
            <div class="logo-container">
                <a href="../admin/dashboard.php">
                    <div class="logo-text">
                        <img src="../assets/images/d-product_admin.jpg" alt="D-PRODUCT" style="height: 40px;">
                    </div>
                </a>
            </div>
            <?php
                $current_page = basename($_SERVER['PHP_SELF']);
            ?>
            <ul class="menu-items">
                <li class="menu-item <?php echo ($current_page == 'dashboard.php') ? 'active' : ''; ?>">
                    <a href="../admin/dashboard.php">
                        <i class="fas fa-th-large"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="menu-item <?php echo ($current_page == 'produit.php') ? 'active' : ''; ?>">
                    <a href="../admin/produit.php">
                        <i class="fas fa-box"></i>
                        <span>Produits</span>
                    </a>
                </li>
                <li class="menu-item <?php echo ($current_page == 'user.php') ? 'active' : ''; ?>">
                    <a href="../admin/user.php">
                        <i class="fas fa-users"></i>
                        <span>Utilisateurs</span>
                    </a>
                </li>
                <li class="menu-item <?php echo ($current_page == 'categories.php') ? 'active' : ''; ?>">
                    <a href="../admin/categories.php">
                        <i class="fas fa-tags"></i>
                        <span>Catégories</span>
                    </a>
                </li>
                <li class="menu-item <?php echo ($current_page == 'commandes.php') ? 'active' : ''; ?>">
                    <a href="../admin/commandes.php">
                        <i class="fas fa-shopping-cart"></i>
                        <span>Commandes</span>
                    </a>
                </li>
                <li class="menu-item <?php echo ($current_page == 'team.php') ? 'active' : ''; ?>">
                    <a href="../admin/equipe.php">
                        <i class="fas fa-user-tie"></i>
                        <span>Équipe</span>
                    </a>
                </li>
                <li class="menu-item <?php echo ($current_page == 'statistiques.php') ? 'active' : ''; ?>">
                    <a href="../admin/statistiques.php">
                        <i class="fas fa-chart-bar"></i>
                        <span>Statistiques</span>
                    </a>
                </li>
                <li class="menu-item <?php echo ($current_page == 'rapports.php') ? 'active' : ''; ?>">
                    <a href="../admin/rapports.php">
                        <i class="fas fa-file-alt"></i>
                        <span>Rapports</span>
                    </a>
                </li>
                
                <li class="menu-item <?php echo ($current_page == 'tickets.php') ? 'active' : ''; ?>">
                    <a href="../admin/tickets.php">
                        <i class="fas fa-ticket-alt"></i>
                        <span>Tickets</span>
                    </a>
                </li>
                
                <li class="menu-item <?php echo ($current_page == 'logout.php') ? 'active' : ''; ?>">
                    <a href="../includes/logout.php">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Déconnexion</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="content">
            <div class="header">
                <div class="page-title">Dashboard</div>
                <div class="search-bar">
                    <input type="text" placeholder="Rechercher ici...">
                </div>
                <div class="user-profile">
                    <div class="user-info">
                        <div class="user-name">Ilyas Ilyas</div>
                        <div class="user-role">Admin d-product</div>
                    </div>
                    <img src="/api/placeholder/40/40" class="user-avatar" alt="User Avatar">
                </div>
            </div>
   </body>
</html>