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

} catch (PDOException $e) {
    $commandes = [];
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
                        <div class="card-title">Ventes des produits</div>
                        <div class="card-options">
                            <span>Trier par:</span>
                            <select>
                                <option>Ce Mois</option>
                                <option>Cette Semaine</option>
                                <option>Cette Année</option>
                            </select>
                        </div>
                    </div>
                    <div class="chart-container">
                        <svg width="100%" height="100%" viewBox="0 0 500 250">
                            <!-- Axes -->
                            <line x1="50" y1="200" x2="450" y2="200" stroke="#ccc" stroke-width="1"/>
                            <line x1="50" y1="50" x2="50" y2="200" stroke="#ccc" stroke-width="1"/>

                            <!-- X-axis labels -->
                            <text x="100" y="220" text-anchor="middle" font-size="12">Sem 1</text>
                            <text x="200" y="220" text-anchor="middle" font-size="12">Sem 2</text>
                            <text x="300" y="220" text-anchor="middle" font-size="12">Sem 3</text>
                            <text x="400" y="220" text-anchor="middle" font-size="12">Sem 4</text>

                            <!-- Y-axis labels -->
                            <text x="40" y="200" text-anchor="end" font-size="12">0</text>
                            <text x="40" y="150" text-anchor="end" font-size="12">20</text>
                            <text x="40" y="100" text-anchor="end" font-size="12">40</text>
                            <text x="40" y="50" text-anchor="end" font-size="12">60</text>

                            <!-- Grid lines -->
                            <line x1="50" y1="150" x2="450" y2="150" stroke="#eee" stroke-width="1"/>
                            <line x1="50" y1="100" x2="450" y2="100" stroke="#eee" stroke-width="1"/>
                            <line x1="50" y1="50" x2="450" y2="50" stroke="#eee" stroke-width="1"/>

                            <!-- Logiciels Line -->
                            <polyline
                                points="100,160 200,120 300,140 400,170"
                                fill="none"
                                stroke="#000"
                                stroke-width="2"/>
                            <circle cx="100" cy="160" r="4" fill="#000"/>
                            <circle cx="200" cy="120" r="4" fill="#000"/>
                            <circle cx="300" cy="140" r="4" fill="#000"/>
                            <circle cx="400" cy="170" r="4" fill="#000"/>

                            <!-- E-books Line -->
                            <polyline
                                points="100,180 200,150 300,80 400,60"
                                fill="none"
                                stroke="#FFD700"
                                stroke-width="2"/>
                            <circle cx="100" cy="180" r="4" fill="#FFD700"/>
                            <circle cx="200" cy="150" r="4" fill="#FFD700"/>
                            <circle cx="300" cy="80" r="4" fill="#FFD700"/>
                            <circle cx="400" cy="60" r="4" fill="#FFD700"/>
                        </svg>
                    </div>
                    <div class="client-legend">
                        <div class="legend-item">
                            <div class="legend-color" style="background-color: #000;"></div>
                            <span>Logiciels et Applications</span>
                        </div>
                        <div class="legend-item">
                            <div class="legend-color" style="background-color: #FFD700;"></div>
                            <span>E-books et Formations</span>
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
                        89 548,49 €
                    </div>
                    <div class="earnings-detail">
                        ▶ Total des ventes de produits digitaux
                    </div>

                    <div class="category-earnings">
                        <div class="category-earnings-title">
                            <span>Revenus Logiciels</span>
                            <i class="fas fa-ellipsis-v"></i>
                        </div>
                        <div class="category-amount">
                            47 943,50 €
                        </div>
                        <div class="category-detail">
                            ▶ Applications et Solutions
                        </div>
                    </div>

                    <div class="category-earnings">
                        <div class="category-earnings-title">
                            <span>Revenus E-books</span>
                            <i class="fas fa-ellipsis-v"></i>
                        </div>
                        <div class="category-amount">
                            41 604,99 €
                        </div>
                        <div class="category-detail">
                            ▶ Formations et Documentation
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
</body>
</html>