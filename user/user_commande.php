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
                                <tr>
                                    <td class="order-number">#2024-001</td>
                                    <td class="order-date">15 Mars 2024</td>
                                    <td class="order-total">129,99 MAD</td>
                                    <td><span class="order-status status-completed">Complétée</span></td>
                                    <td><button class="view-details-btn" onclick="toggleOrderDetails('2024-001')">Voir détails</button></td>
                                </tr>
                                <tr class="order-details" id="details-2024-001">
                                    <td colspan="5">
                                        <div class="order-details-content">
                                            <div class="order-details-header">
                                                <h3>Détails de la commande #2024-001</h3>
                                            </div>
                                            <ul class="order-items">
                                                <li class="order-item">
                                                    <div class="item-details">
                                                        <img src="../assets/images/office.png" alt="Smartphone" />
                                                        <div>
                                                            <div class="item-name">Microsoft Office 2024 Home PC</div>
                                                            <div class="item-meta">Quantité: 1</div>
                                                        </div>
                                                    </div>
                                                    <span class="item-price">99,99 MAD</span>
                                                </li>
                                                <li class="order-item">
                                                    <div class="item-details">
                                                        <img src="../assets/images/office.png" alt="Coque" />
                                                        <div>
                                                            <div class="item-name">Microsoft Office 2024 Home PC</div>
                                                            <div class="item-meta">Quantité: 1</div>
                                                        </div>
                                                    </div>
                                                    <span class="item-price">29,99 MAD</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="order-number">#2024-002</td>
                                    <td class="order-date">10 Mars 2024</td>
                                    <td class="order-total">249,99 MAD</td>
                                    <td><span class="order-status status-pending">En attente</span></td>
                                    <td><button class="view-details-btn" onclick="toggleOrderDetails('2024-002')">Voir détails</button></td>
                                </tr>
                                <tr class="order-details" id="details-2024-002">
                                    <td colspan="5">
                                        <div class="order-details-content">
                                            <div class="order-details-header">
                                                <h3>Détails de la commande #2024-002</h3>
                                            </div>
                                            <ul class="order-items">
                                                <li class="order-item">
                                                    <div class="item-details">
                                                        <img src="../assets/images/office.png" alt="Ordinateur" />
                                                        <div>
                                                            <div class="item-name">Microsoft Office 2024 Home PC</div>
                                                            <div class="item-meta">Quantité: 1</div>
                                                        </div>
                                                    </div>
                                                    <span class="item-price">199,99 MAD</span>
                                                </li>
                                                <li class="order-item">
                                                    <div class="item-details">
                                                        <img src="../assets/images/office.png" alt="Souris" />
                                                        <div>
                                                            <div class="item-name">Microsoft Office 2024 Home PC</div>
                                                            <div class="item-meta">Quantité: 1</div>
                                                        </div>
                                                    </div>
                                                    <span class="item-price">49,99 MAD</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
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