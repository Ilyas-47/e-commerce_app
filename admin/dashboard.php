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
                        <tr>
                            <td>#1</td>
                            <td>Ilias</td>
                            <td>Test</td>
                            <td>0000-00-00</td>
                            <td>00,00 MAD</td>
                            <td><span class="status-badge status-completed">Complété</span></td>
                        </tr>
                        <tr>
                            <td>#2</td>
                            <td>Ilias</td>
                            <td>Test</td>
                            <td>0000-00-00</td>
                            <td>00,00 MAD</td>
                            <td><span class="status-badge status-pending">En attente</span></td>
                        </tr>
                        <tr>
                            <td>#3</td>
                            <td>Ilias</td>
                            <td>Test</td>
                            <td>0000-00-00</td>
                            <td>00,00 MAD</td>
                            <td><span class="status-badge status-completed">Complété</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>