<?php
require_once('../connection/connection.php');

try {
    // Récupération des 3 dernières commandes avec les informations des clients et produits
    $req = $pdo->prepare("
        SELECT
            c.id_commande,
            c.statut,
            c.date_commande,
            u.nom as nom_client,
            p.nom_produit,
            dc.quantite,
            dc.prix_unitaire,
            (dc.quantite * dc.prix_unitaire) as montant_total
        FROM commandes c
        LEFT JOIN user u ON c.id_user = u.id_user
        LEFT JOIN details_commande dc ON c.id_commande = dc.id_commande
        LEFT JOIN produits p ON dc.id_produit = p.id_produit
        ORDER BY c.date_commande DESC
        LIMIT 3");
    $req->execute();
    $commandes = $req->fetchAll(PDO::FETCH_ASSOC);

     $reqNouvellesCommandes = $pdo->query("SELECT COUNT(*) AS total FROM commandes WHERE date_commande >= DATE_SUB(NOW(), INTERVAL 24 HOUR)");
    $nouvellesCommandes = $reqNouvellesCommandes->fetch(PDO::FETCH_ASSOC)['total'];

    $reqVentesAujourdhuit = $pdo->query("SELECT COALESCE(SUM(montant), 0) AS total FROM paiements WHERE date_paiement >= DATE_SUB(NOW(), INTERVAL 24 HOUR) AND statut = 'Complété' AND mode_paiement != 'TEST_DATA'");
    $ventesAujourdhuit = $reqVentesAujourdhuit->fetch(PDO::FETCH_ASSOC)['total'];

    $reqVentes = $pdo->query("SELECT COALESCE(SUM(montant), 0) AS total FROM paiements");
    $ventes = $reqVentes->fetch(PDO::FETCH_ASSOC)['total'];

} catch (PDOException $e) {
    $commandes = [];
    $nouvellesCommandes = 0;
    $ventesAujourdhuit = 0;
    $ventes = 0;
    error_log("Erreur de chargement des commandes : " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="fr">
<body>
            <?php include_once '../includes/admin_nav.php'; ?>
            <div class="grid-container">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Évolution des ventes</div>
                        <div class="card-options">
                            <span>Trier par:</span>
                            <select onchange="updateChart(this.value)">
                                <option value="week">Cette Semaine</option>
                                <option value="month">Ce Mois</option>
                                <option value="year">Cette Année</option>
                            </select>
                        </div>
                    </div>
                    <div class="chart-container">
                        <svg id="salesChart" width="100%" height="100%" viewBox="0 0 500 250">
                            <!-- Axes -->
                            <line x1="50" y1="200" x2="450" y2="200" stroke="#ccc" stroke-width="1"/>
                            <line x1="50" y1="50" x2="50" y2="200" stroke="#ccc" stroke-width="1"/>

                            <!-- Labels X -->
                            <g id="xLabels">
                                <!-- Les labels X seront générés dynamiquement -->
                            </g>

                            <!-- Labels Y -->
                            <g id="yLabels">
                                <text x="40" y="200" text-anchor="end" font-size="12">0</text>
                                <text x="40" y="150" text-anchor="end" font-size="12">2000 MAD</text>
                                <text x="40" y="100" text-anchor="end" font-size="12">4000 MAD</text>
                                <text x="40" y="50" text-anchor="end" font-size="12">6000 MAD</text>
                            </g>

                            <!-- Grid lines -->
                            <line x1="50" y1="150" x2="450" y2="150" stroke="#eee" stroke-width="1"/>
                            <line x1="50" y1="100" x2="450" y2="100" stroke="#eee" stroke-width="1"/>
                            <line x1="50" y1="50" x2="450" y2="50" stroke="#eee" stroke-width="1"/>

                            <!-- Graph Line -->
                            <path id="chartLine" d="M100 200 L200 150 L300 180 L400 100"
                                  fill="none" stroke="#FFD700" stroke-width="2"/>

                            <!-- Points -->
                            <g id="chartPoints">
                                <circle cx="100" cy="200" r="4" fill="#FFD700"/>
                                <circle cx="200" cy="150" r="4" fill="#FFD700"/>
                                <circle cx="300" cy="180" r="4" fill="#FFD700"/>
                                <circle cx="400" cy="100" r="4" fill="#FFD700"/>
                            </g>
                        </svg>
                        <div id="loadingChart" style="display: none; text-align: center; padding: 50px;">
                            Chargement des données...
                        </div>
                    </div>
                </div>

                <div class="card earnings-card">
                    <div class="card-header">
                        <div class="card-title">Aperçu des revenus</div>
                        <div class="card-options">
                            <a href="statistiques.php" class="read-more" style="color: white;">Voir détails</a>
                        </div>
                    </div>
                    <div class="total-earnings">
                            <?php echo number_format($ventes, 2); ?> MAD
                    </div>
                    <div class="earnings-detail">
                        ▶ Total des ventes de produits digitaux
                    </div>

                    <div class="category-earnings">
                        <div class="category-earnings-title">
                            <span>Ventes (24h)</span>
                            <i class="fas fa-ellipsis-v"></i>
                        </div>
                        <div class="category-amount">
                                <?php echo number_format($ventesAujourdhuit, 2); ?> MAD
                        </div>
                        <div class="category-detail">
                            ▶ Dernières 24 heures
                        </div>
                    </div>

                    <div class="category-earnings">
                        <div class="category-earnings-title">
                            <span>Commandes</span>
                            <i class="fas fa-ellipsis-v"></i>
                        </div>
                        <div class="category-amount">
                      <?php echo number_format($nouvellesCommandes, 0); ?>
                        </div>
                        <div class="category-detail">
                            ▶ Nouvelles commandes (24h)
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <div class="card-title">Commandes Récentes</div>
                    <div class="card-options">
                        <a href="commandes.php" class="read-more">Voir toutes les commandes</a>
                    </div>
                </div>
                <table class="orders-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Client</th>
                            <th>Produit</th>
                            <th>Date</th>
                            <th>Montant Payé</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($commandes)): $i=1?>
                            <?php foreach ($commandes as $commande): ?>
                                <tr>
                                    <td>#<?php echo $i; ?></td>
                                    <td><?php echo htmlspecialchars($commande['nom_client'] ?? 'Client inconnu'); ?></td>
                                    <td><?php echo htmlspecialchars($commande['nom_produit'] ?? 'Produit inconnu'); ?></td>
                                    <td><?php echo $commande['date_commande'] ? date('d/m/Y', strtotime($commande['date_commande'])) : 'Date inconnue'; ?></td>
                                    <td><?php echo number_format($commande['montant_total'] ?? 0, 2); ?> MAD</td>
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
                                </tr>
                                
                            <?php  $i++; endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" style="text-align: center; padding: 20px; color: #666;">
                                    Aucune commande récente trouvée
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<script src="../assets/js/dashboard.js"></script>

</body>
</html>