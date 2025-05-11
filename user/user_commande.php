<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DigiStore - Historique des commandes</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        :root {
            --primary: #4361ee;
            --secondary: #3f37c9;
            --accent: #4cc9f0;
            --dark: #212529;
            --light: #f8f9fa;
            --success: #4caf50;
            --danger: #f44336;
            --gray: #6c757d;
            --light-gray: #e9ecef;
        }

        body {
            background-color: #f5f7fb;
            color: var(--dark);
            line-height: 1.6;
            padding-top: 40px; /* Ajout de padding en haut pour compenser la suppression de la navbar */
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .profile-section {
            display: grid;
            grid-template-columns: 250px 1fr;
            gap: 30px;
        }
        
        .sidebar {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            padding: 20px;
            height: fit-content;
        }
        
        .user-info {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding-bottom: 20px;
            border-bottom: 1px solid var(--light-gray);
            margin-bottom: 20px;
        }
        
        .avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background-color: var(--accent);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 36px;
            font-weight: bold;
            margin-bottom: 15px;
        }
        
        .user-name {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 5px;
        }
        
        .user-email {
            color: var(--gray);
            font-size: 14px;
        }
        
        .menu {
            list-style: none;
        }
        
        .menu li {
            margin-bottom: 10px;
        }
        
        .menu a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px;
            border-radius: 4px;
            text-decoration: none;
            color: var(--dark);
            transition: background-color 0.3s;
        }
        
        .menu a:hover {
            background-color: var(--light-gray);
        }
        
        .menu a.active {
            background-color: var(--primary);
            color: white;
        }

        .content {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            padding: 30px;
        }

        .orders-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            border-radius: 8px;
            overflow: hidden;
        }

        .orders-table th,
        .orders-table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid var(--light-gray);
        }

        .orders-table th {
            background-color: var(--light);
            font-weight: 600;
        }

        .orders-table tr:hover {
            background-color: var(--light);
        }

        .order-number {
            color: var(--primary);
            font-weight: 500;
        }

        .order-total {
            font-weight: 600;
        }

        .order-status {
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 12px;
        }

        .status-completed {
            background-color: #e8f5e9;
            color: #2e7d32;
        }

        .status-pending {
            background-color: #fff3e0;
            color: #e65100;
        }

        .order-date {
            color: var(--gray);
            font-size: 14px;
        }

        .order-details {
            background-color: var(--light);
            padding: 20px;
            margin: 10px;
            border-radius: 8px;
            display: none;
        }

        .order-details.active {
            display: block;
            animation: fadeIn 0.3s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .order-items {
            list-style: none;
            padding: 0;
        }

        .order-item {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid var(--light-gray);
        }

        .view-details-btn {
            background-color: var(--primary);
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .view-details-btn:hover {
            background-color: var(--secondary);
        }

        .status-processing {
            background-color: #e3f2fd;
            color: #1565c0;
        }

        .status-cancelled {
            background-color: #ffebee;
            color: #c62828;
        }

        @media (max-width: 768px) {
            .profile-section {
                grid-template-columns: 1fr;
            }
            
            .sidebar {
                margin-bottom: 20px;
            }

            .orders-table {
                font-size: 14px;
            }
        }

        /* Suppression des styles liés à la navbar */
        .nav-links, .user-actions, .cart, .cart-count {
            display: none;
        }
    </style>
</head>
<body>
    <main>
        <div class="container">
            <div class="profile-section">
                <!-- Sidebar avec profil utilisateur -->
                <div class="sidebar">
                    <div class="user-info">
                        <div class="avatar">
                            <img src="../assets/images/office.png" alt="Profile" style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">
                        </div>
                        <div class="user-name">Jean Dupont</div>
                        <div class="user-email">jean.dupont@example.com</div>
                    </div>
                    <ul class="menu">
                        <li><a href="user_profil.php"><i class="fas fa-tachometer-alt"></i> Tableau de bord</a></li>
                        <li><a href="user_info.php"><i class="fas fa-user"></i> Informations personnelles</a></li>
                        <li><a href="user_commande.php"><i class="fas fa-shopping-bag"></i> Mes commandes</a></li>
                        <li><a href="user_pay.php"><i class="fas fa-credit-card"></i> Moyens de paiement</a></li>
                        <li><a href="user_favoris.php"><i class="fas fa-heart"></i> Liste de souhaits</a></li>
                        <li><a href="user_support.php" class="active"><i class="fas fa-headset"></i> Support</a></li>
                        <li><a href="#"><i class="fas fa-sign-out-alt"></i> Déconnexion</a></li>
                    </ul>
                </div>

                <div class="content">
                    <h1 class="section-title"><i class="fas fa-shopping-bag"></i> Mes commandes</h1>
                    <p class="section-description">Retrouvez l'historique de vos achats et le détail de vos commandes.</p>

                    <table class="orders-table">
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
                                <td class="order-total">129.99 €</td>
                                <td><span class="order-status status-completed">Complétée</span></td>
                                <td><button class="view-details-btn" onclick="toggleOrderDetails('2024-001')">Voir détails</button></td>
                            </tr>
                            <tr>
                                <td colspan="5">
                                    <div id="details-2024-001" class="order-details">
                                        <h3>Détails de la commande #2024-001</h3>
                                        <ul class="order-items">
                                            <li class="order-item">
                                                <span>Smartphone XYZ - 128GB</span>
                                                <span>99.99 €</span>
                                            </li>
                                            <li class="order-item">
                                                <span>Coque de protection</span>
                                                <span>29.99 €</span>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="order-number">#2024-002</td>
                                <td class="order-date">10 Mars 2024</td>
                                <td class="order-total">249.99 €</td>
                                <td><span class="order-status status-pending">En attente</span></td>
                                <td><button class="view-details-btn" onclick="toggleOrderDetails('2024-002')">Voir détails</button></td>
                            </tr>
                            <tr>
                                <td colspan="5">
                                    <div id="details-2024-002" class="order-details">
                                        <h3>Détails de la commande #2024-002</h3>
                                        <ul class="order-items">
                                            <li class="order-item">
                                                <span>Ordinateur Portable ABC</span>
                                                <span>199.99 €</span>
                                            </li>
                                            <li class="order-item">
                                                <span>Souris sans fil</span>
                                                <span>49.99 €</span>
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
    </main>

    <script>
        function toggleOrderDetails(orderId) {
            const details = document.getElementById(`details-${orderId}`);
            details.classList.toggle('active');
        }
    </script>
</body>
</html>
