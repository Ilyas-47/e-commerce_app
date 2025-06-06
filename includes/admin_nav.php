<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header("Location: ../user/login.php"); 
    exit();
}

$user_name = $_SESSION['user_name'];
$user_role = $_SESSION['user_role'];
$user_image = $_SESSION['user_image'];

// partie de recherche
$search_results = [];
$search_query = '';

// Préserver la valeur de recherche même si $pdo n'est pas disponible
if (isset($_GET['query']) && !empty(trim($_GET['query']))) {
    $search_query = trim($_GET['query']);
}

// Effectuer la recherche seulement si $pdo est disponible
if (isset($_GET['query']) && !empty(trim($_GET['query'])) && isset($pdo)) {

    try {
        // Recherche dans les produits
        $stmt_produits = $pdo->prepare("
            SELECT 'produit' as type, p.id_produit as id, p.nom_produit as nom, p.prix, c.nom_categorie as categorie
            FROM produits p
            LEFT JOIN categories c ON p.id_categorie = c.id_categorie
            WHERE p.nom_produit LIKE ? OR p.description LIKE ? OR c.nom_categorie LIKE ?
            LIMIT 5
        ");
        $search = "%" . $search_query . "%";
        $stmt_produits->execute([$search, $search, $search]);
        $produits_results = $stmt_produits->fetchAll(PDO::FETCH_ASSOC);

        // Recherche dans les commandes
        $stmt_commandes = $pdo->prepare("
            SELECT 'commande' as type, c.id_commande as id, u.nom as nom, c.statut, c.date_commande
            FROM commandes c
            LEFT JOIN user u ON c.id_user = u.id_user
            WHERE c.id_commande LIKE ? OR u.nom LIKE ? OR c.statut LIKE ?
            LIMIT 5
        ");
        $stmt_commandes->execute([$search, $search, $search]);
        $commandes_results = $stmt_commandes->fetchAll(PDO::FETCH_ASSOC);

        // Recherche dans les utilisateurs
        $stmt_users = $pdo->prepare("
            SELECT 'user' as type, id_user as id, nom, gmail, role
            FROM user
            WHERE nom LIKE ? OR gmail LIKE ? OR role LIKE ?
            LIMIT 5
        ");
        $stmt_users->execute([$search, $search, $search]);
        $users_results = $stmt_users->fetchAll(PDO::FETCH_ASSOC);

        // Recherche dans les tickets de support
        $stmt_support = $pdo->prepare("
            SELECT 'support' as type, s.id_support as id, s.sujet as nom, s.statut_ticket as statut, u.nom as client
            FROM support s
            LEFT JOIN user u ON s.id_user = u.id_user
            WHERE s.sujet LIKE ? OR s.probleme LIKE ? OR s.message LIKE ?
            LIMIT 5
        ");
        $stmt_support->execute([$search, $search, $search]);
        $support_results = $stmt_support->fetchAll(PDO::FETCH_ASSOC);

        // Combiner tous les résultats
        $search_results = array_merge($produits_results, $commandes_results, $users_results, $support_results);

    } catch (PDOException $e) {
        error_log("Erreur de recherche : " . $e->getMessage());
        $search_results = [];
    }
}
?>

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
   <div class="container">
        <div class="sidebar">
            <div class="logo-container">
                <a href="../admin/dashboard.php">
                    <div class="logo-text">
                        <img src="../assets/images/d-product_admin.jpg" alt="D-PRODUCT" style="height: 40px;">
                    </div>
                </a>
            </div>
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
                    <a href="../includes/deconnect.php">
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
                    <form method="GET" action="" class="search-form">
                        <input type="text" name="query" placeholder="Rechercher ici..." value="<?php echo htmlspecialchars($search_query); ?>" class="search-input">
                        <button type="submit" class="search-btn">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>

                    <!-- Résultats de recherche -->
                    <?php if (!empty($search_query)): ?>
                    <div class="search-results">
                        <div class="search-results-header">
                            <span>Résultats pour "<?php echo htmlspecialchars($search_query); ?>"</span>
                            <button onclick="clearSearch()" class="clear-search">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <div class="search-results-content">
                            <?php if (!empty($search_results)): ?>
                                <?php foreach ($search_results as $result): ?>
                                    <div class="search-result-item" onclick="goToResult('<?php echo $result['type']; ?>', <?php echo $result['id']; ?><?php echo ($result['type'] == 'user') ? ", '" . htmlspecialchars($result['role']) . "'" : ''; ?>)">
                                        <div class="result-type">
                                            <?php
                                            switch($result['type']) {
                                                case 'produit':
                                                    echo '<i class="fas fa-box"></i> Produit';
                                                    break;
                                                case 'commande':
                                                    echo '<i class="fas fa-shopping-cart"></i> Commande';
                                                    break;
                                                case 'user':
                                                    echo '<i class="fas fa-user"></i> Utilisateur';
                                                    break;
                                                case 'support':
                                                    echo '<i class="fas fa-ticket-alt"></i> Ticket';
                                                    break;
                                            }
                                            ?>
                                        </div>
                                        <div class="result-details">
                                            <div class="result-name"><?php echo htmlspecialchars($result['nom']); ?></div>
                                            <div class="result-info">
                                                <?php if ($result['type'] == 'produit'): ?>
                                                    <?php echo htmlspecialchars($result['prix']); ?> MAD - <?php echo htmlspecialchars($result['categorie'] ?? 'Sans catégorie'); ?>
                                                <?php elseif ($result['type'] == 'commande'): ?>
                                                    #<?php echo $result['id']; ?> - <?php echo htmlspecialchars($result['statut']); ?>
                                                <?php elseif ($result['type'] == 'user'): ?>
                                                    <?php echo htmlspecialchars($result['gmail']); ?> - <?php echo htmlspecialchars($result['role']); ?>
                                                <?php elseif ($result['type'] == 'support'): ?>
                                                    <?php echo htmlspecialchars($result['statut'] ?? 'En cours'); ?> - <?php echo htmlspecialchars($result['client'] ?? 'Client inconnu'); ?>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="no-results">
                                    <i class="fas fa-search"></i>
                                    <p>Aucun résultat trouvé pour "<?php echo htmlspecialchars($search_query); ?>"</p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
                <div class="user-profile">
                    <div class="user-info">
                        <div class="user-name"><?php echo htmlspecialchars($user_name); ?></div>
                        <div class="user-role"><?php echo htmlspecialchars($user_role); ?></div>
                    </div>
                    <img src="<?php echo htmlspecialchars($user_image); ?>" class="user-avatar" alt="User Avatar">
                </div>
            </div>
<script src="../assets/js/admin_nav.js"></script>

   </body>
</html>