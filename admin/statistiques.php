<?php
require_once('../connection/connection.php');

try {
    $reqProduits = $pdo->query("SELECT COUNT(*) AS total FROM produits");
    $totalProduits = $reqProduits->fetch(PDO::FETCH_ASSOC)['total'];

    $reqUsers = $pdo->query("SELECT COUNT(*) AS total FROM user WHERE role = 'user'");
    $totalUsers = $reqUsers->fetch(PDO::FETCH_ASSOC)['total'];

    $reqCategories = $pdo->query("SELECT COUNT(*) AS total FROM categories");
    $totalCategories = $reqCategories->fetch(PDO::FETCH_ASSOC)['total'];

    $reqCommandes = $pdo->query("SELECT COUNT(*) AS total FROM commandes");
    $totalCommandes = $reqCommandes->fetch(PDO::FETCH_ASSOC)['total'];

    // Récupérer le nombre de nouvelles commandes des dernières 24 heures
    $reqNouvellesCommandes = $pdo->query("SELECT COUNT(*) AS total FROM commandes WHERE date_commande >= DATE_SUB(NOW(), INTERVAL 24 HOUR)");
    $nouvellesCommandes = $reqNouvellesCommandes->fetch(PDO::FETCH_ASSOC)['total'];

    $reqVentesAujourdhuit = $pdo->query("SELECT sum(montant) AS total FROM paiements WHERE date_paiement >= DATE_SUB(NOW(), INTERVAL 24 HOUR)");
    $ventesAujourdhuit = $reqVentesAujourdhuit->fetch(PDO::FETCH_ASSOC)['total'];

} catch (PDOException $e) {
    $totalProduits = 0;
    $totalUsers = 0;
    $totalCategories = 0;
    $totalCommandes = 0;
    $nouvellesCommandes = 0;
    $ventesAujourdhuit = 0;
    error_log("Erreur récupération statistiques : " . $e->getMessage());
}

?>
<!DOCTYPE html>
<html lang="en">
<body>
<?php require_once('../includes/admin_nav.php'); ?>

<div class="grid-container">
    <!-- KPI Cards -->
    <div class="card">
        <div class="card-header">
            <div class="card-title">Ventes Totales</div>
        </div>
        <div class="total-earnings">
            <?php echo number_format($ventesAujourdhuit, 2); ?> MAD
        </div>
        <div class="earnings-detail">
            ▶ Aujourd'hui
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <div class="card-title">Commandes</div>
        </div>
        <div class="total-earnings">
            <?php echo number_format($nouvellesCommandes, 0); ?>
        </div>
        <div class="earnings-detail">
            ▶ Nouvelles commandes (24h)
        </div>
    </div>

    <!-- Graph Card -->
    <div class="card" style="grid-column: span 2;">
        <div class="card-header">
            <div class="card-title">Évolution des ventes</div>
            <div class="card-options">
                <select onchange="updateChart(this.value)">
                    <option value="week">Cette Semaine</option>
                    <option value="month">Ce Mois</option>
                    <option value="year">Cette Année</option>
                </select>
            </div>
        </div>
        <div class="chart-container">
            <svg width="100%" height="250" viewBox="0 0 800 250">
                <!-- Axe Y -->
                <line x1="50" y1="50" x2="50" y2="200" stroke="#ccc"/>
                <!-- Axe X -->
                <line x1="50" y1="200" x2="750" y2="200" stroke="#ccc"/>

                <!-- Labels Y -->
                <text x="30" y="60" text-anchor="end">100k</text>
                <text x="30" y="110" text-anchor="end">50k</text>
                <text x="30" y="200" text-anchor="end">0</text>

                <!-- Graph Line -->
                <path d="M50 200 L200 150 L350 180 L500 100 L650 120 L750 90"
                      fill="none" stroke="#FFD700" stroke-width="3"/>

                <!-- Points -->
                <circle cx="50" cy="200" r="4" fill="#FFD700"/>
                <circle cx="200" cy="150" r="4" fill="#FFD700"/>
                <circle cx="350" cy="180" r="4" fill="#FFD700"/>
                <circle cx="500" cy="100" r="4" fill="#FFD700"/>
                <circle cx="650" cy="120" r="4" fill="#FFD700"/>
                <circle cx="750" cy="90" r="4" fill="#FFD700"/>
            </svg>
        </div>
    </div>
</div>

<!-- Statistiques détaillées -->
<div class="card">
    <div class="card-header">
        <div class="card-title">Statistiques détaillées</div>
    </div>
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; padding: 20px;">
        <div class="stat-item">
            <h3>Produits</h3>
            <div class="stat-value"><?php echo number_format($totalProduits, 0); ?></div>
            <div class="stat-label">Total des produits</div>
        </div>
        <div class="stat-item">
            <h3>Utilisateurs</h3>
            <div class="stat-value"><?php echo number_format($totalUsers, 0); ?></div>
            <div class="stat-label">Clients actifs</div>
        </div>
        <div class="stat-item">
            <h3>Catégories</h3>
            <div class="stat-value"><?php echo number_format($totalCategories, 0); ?></div>
            <div class="stat-label">Types de produits</div>
        </div>
        <div class="stat-item">
            <h3>Commandes</h3>
            <div class="stat-value"><?php echo number_format($totalCommandes, 0); ?></div>
            <div class="stat-label">Total des commandes</div>
        </div>
    </div>
</div>

<style>
.stat-item {
    padding: 15px;
    background: #f8f9fa;
    border-radius: 8px;
    text-align: center;
}
.stat-value {
    font-size: 24px;
    font-weight: bold;
    color: var(--primary);
    margin: 10px 0;
}
.stat-label {
    color: #666;
    font-size: 14px;
}
</style>

<script>
function updateChart(period) {
    // Logique de mise à jour du graphique selon la période
    console.log('Mise à jour pour la période:', period);
}
</script>

</body>
</html>