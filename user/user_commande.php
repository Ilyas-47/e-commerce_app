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

// Récupérer les commandes de l'utilisateur connecté avec les détails
try {
    $req = $pdo->prepare("
        SELECT
            c.id_commande,
            c.statut,
            c.date_commande,
            COALESCE(SUM(dc.quantite * dc.prix_unitaire), 0) as total_commande
        FROM commandes c
        LEFT JOIN details_commande dc ON c.id_commande = dc.id_commande
        WHERE c.id_user = :id_user
        GROUP BY c.id_commande, c.statut, c.date_commande
        ORDER BY c.date_commande DESC
    ");
    $req->bindParam(':id_user', $_SESSION['user_id'], PDO::PARAM_INT);
    $req->execute();
    $commandes = $req->fetchAll(PDO::FETCH_ASSOC);

    // Récupérer tous les détails des commandes en une seule requête pour optimiser
    $commandeIds = array_column($commandes, 'id_commande');
    $detailsParCommande = [];

    if (!empty($commandeIds)) {
        $placeholders = str_repeat('?,', count($commandeIds) - 1) . '?';
        $reqAllDetails = $pdo->prepare("
            SELECT
                dc.id_commande,
                p.nom_produit,
                p.image_url as image,
                dc.quantite,
                dc.prix_unitaire,
                (dc.quantite * dc.prix_unitaire) as total_produit
            FROM details_commande dc
            LEFT JOIN produits p ON dc.id_produit = p.id_produit
            WHERE dc.id_commande IN ($placeholders)
            ORDER BY dc.id_commande, dc.id_produit
        ");
        $reqAllDetails->execute($commandeIds);
        $allDetails = $reqAllDetails->fetchAll(PDO::FETCH_ASSOC);

        // Organiser les détails par commande
        foreach ($allDetails as $detail) {
            $detailsParCommande[$detail['id_commande']][] = $detail;
        }
    }

} catch (Exception $e) {
    error_log("Erreur lors de la récupération des commandes: " . $e->getMessage());
    $commandes = [];
    $detailsParCommande = [];
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/user_commande.css">
</head>
<body>
    <?php include("../includes/nav.php") ?>
    <main>
        <div class="cmd-container">
            <div class="cmd-grid">
                <?php include('user_nav.php'); ?>
                
                <div class="cmd-content">
                    <div class="cmd-header">
                        <h1><i class="fas fa-shopping-bag"></i> Mes Commandes</h1>
                    </div>
                    <p class="section-description">Retrouvez l'historique de vos achats et le détail de vos commandes.</p>

                    <div class="cmd-table-container">
                        <table class="cmd-table">
                            <thead>
                                <tr>
                                    <th>Commande</th>
                                    <th>Date</th>
                                    <th>Total</th>
                                    <th>Statut</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($commandes)): ?>
                                    <?php foreach ($commandes as $commande): ?>
                                        <tr>
                                            <td class="order-number">#<?php echo htmlspecialchars($commande['id_commande']); ?></td>
                                            <td class="order-date"><?php echo date('d M Y', strtotime($commande['date_commande'])); ?></td>
                                            <td class="order-total"><?php echo number_format($commande['total_commande'], 2); ?> MAD</td>
                                            <td>
                                                <?php
                                                $statusClass = '';
                                                $statusText = $commande['statut'];
                                                switch(strtolower($commande['statut'])) {
                                                    case 'complété':
                                                    case 'completé':
                                                    case 'completed':
                                                        $statusClass = 'status-completed';
                                                        $statusText = 'Complétée';
                                                        break;
                                                    case 'en attente':
                                                    case 'pending':
                                                        $statusClass = 'status-pending';
                                                        $statusText = 'En attente';
                                                        break;
                                                    case 'annulé':
                                                    case 'cancelled':
                                                        $statusClass = 'status-cancelled';
                                                        $statusText = 'Annulée';
                                                        break;
                                                    default:
                                                        $statusClass = 'status-pending';
                                                        $statusText = $commande['statut'];
                                                }
                                                ?>
                                                <span class="order-status <?php echo $statusClass; ?>"><?php echo htmlspecialchars($statusText); ?></span>
                                            </td>
                                            <td><button class="view-details-btn" onclick="toggleOrderDetails('<?php echo $commande['id_commande']; ?>')">Voir détails</button></td>
                                        </tr>
                                        <tr class="order-details" id="details-<?php echo $commande['id_commande']; ?>">
                                            <td colspan="5">
                                                <div class="order-details-content">
                                                    <div class="order-details-header">
                                                        <h3>Détails de la commande #<?php echo htmlspecialchars($commande['id_commande']); ?></h3>
                                                    </div>
                                                    <ul class="order-items">
                                                        <?php
                                                        // Utiliser les détails pré-chargés pour cette commande
                                                        $details = $detailsParCommande[$commande['id_commande']] ?? [];

                                                        if (!empty($details)):
                                                            foreach ($details as $detail):
                                                        ?>
                                                            <li class="order-item">
                                                                <div class="item-details">
                                                                    <img src="<?php echo htmlspecialchars($detail['image'] ?? '../assets/images/default-product.png'); ?>"
                                                                         alt="<?php echo htmlspecialchars($detail['nom_produit'] ?? 'Produit'); ?>"
                                                                         onerror="this.src='../assets/images/default-product.png'" />
                                                                    <div>
                                                                        <div class="item-name"><?php echo htmlspecialchars($detail['nom_produit'] ?? 'Produit inconnu'); ?></div>
                                                                        <div class="item-meta">Quantité: <?php echo htmlspecialchars($detail['quantite']); ?></div>
                                                                    </div>
                                                                </div>
                                                                <span class="item-price"><?php echo number_format($detail['total_produit'], 2); ?> MAD</span>
                                                            </li>
                                                        <?php
                                                            endforeach;
                                                        else:
                                                        ?>
                                                            <li class="order-item">
                                                                <div class="item-details">
                                                                    <div class="item-name">Aucun détail disponible pour cette commande</div>
                                                                </div>
                                                            </li>
                                                        <?php endif; ?>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="5" class="no-orders">
                                            <div class="empty-state">
                                                <h3>Aucune commande trouvée</h3>
                                                <p>Vous n'avez pas encore passé de commande.</p>
                                                <a href="../user/accueil.php" class="btn-primary">Commencer mes achats</a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php include("../includes/footer.php")?>

    <script>
        function toggleOrderDetails(orderId) {
            const details = document.getElementById(`details-${orderId}`);
            details.classList.toggle('active');
        }
    </script>
</body>
</html>