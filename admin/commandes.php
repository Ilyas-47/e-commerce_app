<?php
require_once('../connection/connection.php');

// Nombre de commandes par page
$CommandesParPage = 10;
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$start = ($page - 1) * $CommandesParPage;

// Initialisation des variables par défaut
$commandes = [];
$totalPages = 0;
$totalCommandes = 0;

try {
    // Récupération des commandes avec les informations des clients et produits
    $req = $pdo->prepare("
        SELECT
            c.id_commande,
            c.statut,
            c.date_commande,
            u.nom as nom_client,
            p.nom_produit,
            dc.quantite,
            dc.prix_unitaire
        FROM commandes c
        LEFT JOIN user u ON c.id_user = u.id_user
        LEFT JOIN details_commande dc ON c.id_commande = dc.id_commande
        LEFT JOIN produits p ON dc.id_produit = p.id_produit
        ORDER BY c.date_commande DESC
        LIMIT :limit OFFSET :offset");
    $req->bindValue(':limit', $CommandesParPage, PDO::PARAM_INT);
    $req->bindValue(':offset', $start, PDO::PARAM_INT);
    $req->execute();
    $commandes = $req->fetchAll(PDO::FETCH_ASSOC);

    // Nombre total de commandes pour la pagination
    $countReq = $pdo->query("SELECT COUNT(*) AS total FROM commandes");
    $totalCommandes = $countReq->fetch(PDO::FETCH_ASSOC)['total'];
    $totalPages = ceil($totalCommandes / $CommandesParPage);

    $i = ($page - 1) * $CommandesParPage + 1; // Correction du compteur
} catch (PDOException $e) {
    $commandes = [];
    $totalPages = 0;
    $totalCommandes = 0;
    error_log("Erreur de chargement des commandes : " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<body>
<?php include_once '../includes/admin_nav.php'; ?>

<div class="card">
    <div class="card-header">
        <div class="card-title">Commandes</div>
    </div>
    <table class="orders-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Client</th>
                <th>Produit</th>
                <th>Date</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($commandes)): ?>
                <?php foreach ($commandes as $commande): ?>
                    <tr>
                        <td>#<?php echo htmlspecialchars($commande['id_commande']); ?></td>
                        <td><?php echo htmlspecialchars($commande['nom_client'] ?? 'Client inconnu'); ?></td>
                        <td><?php echo htmlspecialchars($commande['nom_produit'] ?? 'Produit inconnu'); ?></td>
                        <td><?php echo date('d/m/Y', strtotime($commande['date_commande'])); ?></td>
                        <td>
                            <?php
                            $statusClass = '';
                            switch(strtolower($commande['statut'])) {
                                case 'complété':
                                    $statusClass = 'status-completed';
                                    break;
                                case 'en attente':
                                    $statusClass = 'status-pending';
                                    break;
                                default:
                                    $statusClass = 'status-pending';
                            }
                            ?>
                            <span class="status-badge <?php echo $statusClass; ?>">
                                <?php echo htmlspecialchars($commande['statut']); ?>
                            </span>
                        </td>
                        <td>
                            <a href="details_commande.php?id=<?php echo htmlspecialchars($commande['id_commande']); ?>"
                               class="btn btn-warning">Détails</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
      <?php if ($totalPages > 1): ?>
        <div class="pagination">
            <?php if ($page > 1): ?>
                <a href="?page=<?php echo ($page - 1); ?>">&laquo;</a>
            <?php endif; ?>

            <?php for ($p = 1; $p <= $totalPages; $p++): ?>
                <a href="?page=<?php echo $p; ?>"
                   class="<?php echo ($p == $page) ? 'active' : ''; ?>">
                   <?php echo $p; ?>
                </a>
            <?php endfor; ?>

            <?php if ($page < $totalPages): ?>
                <a href="?page=<?php echo ($page + 1); ?>">&raquo;</a>
            <?php endif; ?>
        </div>
      <?php endif; ?>
</div>
</body>
</html>
