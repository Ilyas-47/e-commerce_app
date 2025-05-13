<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Commandes</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        :root {
            --primary-color: #2C3E50;
            --secondary-color: #34495E;
            --accent-color: #4361ee;
            --background-color: #F4F6F7;
            --text-color: #2C3E50;
            --border-color: #E0E6E9;
            --success-color: #2ECC71;
            --warning-color: #F39C12;
            --danger-color: #E74C3C;
            --card-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            line-height: 1.6;
            color: var(--text-color);
            background-color: var(--background-color);
        }

        .cmd-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .cmd-grid {
            display: grid;
            grid-template-columns: 250px 1fr;
            gap: 30px;
            background-color: white;
            border-radius: 12px;
            box-shadow: var(--card-shadow);
            overflow: hidden;
        }

        .cmd-content {
            padding: 40px;
        }

        .cmd-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            border-bottom: 2px solid var(--border-color);
            padding-bottom: 20px;
        }

        .cmd-header h1 {
            font-size: 24px;
            color: var(--dark);
            display: flex;
            align-items: center;
        }

        .cmd-header h1 i {
            margin-right: 15px;
            color: #4361ee;
        }

        .section-description {
            color: var(--dark);
            margin-bottom: 25px;
        }

        .cmd-table-container {
            overflow-x: auto;
            margin-top: 20px;
        }

        .cmd-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 10px;
        }

        .cmd-table th {
            text-align: left;
            padding: 15px;
            background-color: #4361ee;
            color: white;
            font-weight: 500;
            position: relative;
        }

        .cmd-table th:first-child {
            border-top-left-radius: 8px;
            border-bottom-left-radius: 8px;
        }

        .cmd-table th:last-child {
            border-top-right-radius: 8px;
            border-bottom-right-radius: 8px;
        }

        .cmd-table tbody tr {
            transition: all 0.3s ease;
        }

        .cmd-table tbody tr:hover td {
            background-color: #f5f7fa;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        }

        .cmd-table td {
            padding: 18px 15px;
            background-color: white;
            transition: all 0.3s ease;
            border-top: 1px solid var(--border-color);
            border-bottom: 1px solid var(--border-color);
        }

        .cmd-table td:first-child {
            border-left: 1px solid var(--border-color);
            border-top-left-radius: 8px;
            border-bottom-left-radius: 8px;
        }

        .cmd-table td:last-child {
            border-right: 1px solid var(--border-color);
            border-top-right-radius: 8px;
            border-bottom-right-radius: 8px;
        }

        .order-number {
            font-weight: 600;
            color: #4361ee;
        }

        .order-date {
            color: var(--dark);
            font-size: 14px;
        }

        .order-total {
            font-weight: 700;
            color: var(--dark);
            font-size: 16px;
        }

        .order-status {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 30px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-completed {
            background-color: rgba(46, 204, 113, 0.1);
            color: var(--success-color);
            border: 1px solid rgba(46, 204, 113, 0.2);
        }

        .status-pending {
            background-color: rgba(243, 156, 18, 0.1);
            color: var(--warning-color);
            border: 1px solid rgba(243, 156, 18, 0.2);
        }

        .view-details-btn {
            background-color: #4361ee;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 500;
            font-size: 13px;
            transition: all 0.3s ease;
            box-shadow: 0 2px 5px rgba(67, 97, 238, 0.2);
        }

        .view-details-btn:hover {
            background-color: #3a53c9;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(67, 97, 238, 0.3);
        }

        .view-details-btn:active {
            transform: translateY(1px);
            box-shadow: 0 1px 3px rgba(67, 97, 238, 0.2);
        }

        .order-details {
            display: none;
            background-color: #f8fafc;
            margin: 0;
            padding: 0;
            border-radius: 8px;
            overflow: hidden;
        }

        .order-details.active {
            display: table-row;
            animation: fadeIn 0.3s ease-in-out;
        }

        .order-details-content {
            padding: 25px;
            background-color: #f8fafc;
        }

        .order-details-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid var(--border-color);
        }

        .order-details-header h3 {
            color: var(--dark);
            font-size: 18px;
            display: flex;
            align-items: center;
        }

        .order-items {
            list-style: none;
            padding: 0;
        }

        .order-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0;
            border-bottom: 1px solid var(--border-color);
        }

        .order-item:last-child {
            border-bottom: none;
        }

        .item-details {
            display: flex;
            align-items: center;
        }

        .item-details img {
            width: 50px;
            height: 50px;
            border-radius: 8px;
            object-fit: cover;
            margin-right: 15px;
            background-color: #e0e6e9;
        }

        .item-name {
            font-weight: 500;
            color: var(--dark);
        }

        .item-price {
            font-weight: 600;
            color: var(--dark);
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 992px) {
            .cmd-grid {
                grid-template-columns: 1fr;
            }

            .cmd-content {
                padding: 20px;
            }
        }
    </style>
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
                                                            <div class="item-name">Smartphone XYZ - 128GB</div>
                                                            <div class="item-meta">Couleur: Noir | Quantité: 1</div>
                                                        </div>
                                                    </div>
                                                    <span class="item-price">99,99 MAD</span>
                                                </li>
                                                <li class="order-item">
                                                    <div class="item-details">
                                                        <img src="../assets/images/office.png" alt="Coque" />
                                                        <div>
                                                            <div class="item-name">Coque de protection</div>
                                                            <div class="item-meta">Modèle: XYZ | Quantité: 1</div>
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
                                                            <div class="item-name">Ordinateur Portable ABC</div>
                                                            <div class="item-meta">Processeur: i5 | RAM: 8GB | Quantité: 1</div>
                                                        </div>
                                                    </div>
                                                    <span class="item-price">199,99 MAD</span>
                                                </li>
                                                <li class="order-item">
                                                    <div class="item-details">
                                                        <img src="../assets/images/office.png" alt="Souris" />
                                                        <div>
                                                            <div class="item-name">Souris sans fil</div>
                                                            <div class="item-meta">Couleur: Noir | Quantité: 1</div>
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