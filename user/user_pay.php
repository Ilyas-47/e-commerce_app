<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DigiStore - Moyens de paiement</title>
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
            padding-top: 40px;
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

        @media (max-width: 768px) {
            .profile-section {
                grid-template-columns: 1fr;
            }
            
            .sidebar {
                margin-bottom: 20px;
            }
        }

        .content {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            padding: 30px;
        }

        /* Styles spécifiques aux moyens de paiement */
        .payment-methods {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .payment-card {
            background-color: var(--light);
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .card-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 15px;
        }

        .card-icon {
            font-size: 24px;
            color: var(--primary);
        }

        .card-number {
            font-size: 18px;
            font-weight: 600;
        }

        .card-info {
            font-size: 14px;
            color: var (--gray);
            margin-bottom: 15px;
        }

        .card-actions {
            display: flex;
            gap: 10px;
        }

        .card-actions button {
            background-color: var(--primary);
            color: white;
            border: none;
            border-radius: 4px;
            padding: 10px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .card-actions button:hover {
            background-color: var(--secondary);
        }

        .add-card-form {
            background-color: var(--light);
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            padding: 20px;
        }

        .add-card-form h2 {
            margin-bottom: 20px;
            font-size: 24px;
            font-weight: 600;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 600;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid var(--light-gray);
            border-radius: 4px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .btn-submit {
            background-color: var(--primary);
            color: white;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-submit:hover {
            background-color: var(--secondary);
        }

        @media (max-width: 768px) {
            .profile-section {
                grid-template-columns: 1fr;
            }
            
            .payment-methods {
                grid-template-columns: 1fr;
            }

            .form-row {
                grid-template-columns: 1fr;
            }
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
                    <h1 class="section-title"><i class="fas fa-credit-card"></i> Moyens de paiement</h1>
                    <p class="section-description">Gérez vos cartes bancaires et moyens de paiement</p>

                    <div class="payment-methods">
                        <!-- Carte existante -->
                        <div class="payment-card">
                            <div class="card-header">
                                <i class="fab fa-cc-visa card-icon"></i>
                                <span class="card-number">**** **** **** 4242</span>
                            </div>
                            <div class="card-info">
                                <p>Expire le: 12/25</p>
                            </div>
                            <div class="card-actions">
                                <button title="Modifier"><i class="fas fa-edit"></i></button>
                                <button title="Supprimer"><i class="fas fa-trash-alt"></i></button>
                            </div>
                        </div>

                        <!-- Carte existante -->
                        <div class="payment-card">
                            <div class="card-header">
                                <i class="fab fa-cc-mastercard card-icon"></i>
                                <span class="card-number">**** **** **** 5555</span>
                            </div>
                            <div class="card-info">
                                <p>Expire le: 08/24</p>
                            </div>
                            <div class="card-actions">
                                <button title="Modifier"><i class="fas fa-edit"></i></button>
                                <button title="Supprimer"><i class="fas fa-trash-alt"></i></button>
                            </div>
                        </div>
                    </div>

                    <div class="add-card-form">
                        <h2>Ajouter une nouvelle carte</h2>
                        <form action="#" method="POST">
                            <div class="form-group">
                                <label for="cardNumber">Numéro de carte</label>
                                <input type="text" id="cardNumber" placeholder="1234 5678 9012 3456" required>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="expiry">Date d'expiration</label>
                                    <input type="text" id="expiry" placeholder="MM/AA" required>
                                </div>
                                <div class="form-group">
                                    <label for="cvv">CVV</label>
                                    <input type="text" id="cvv" placeholder="123" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="cardName">Nom sur la carte</label>
                                <input type="text" id="cardName" placeholder="JEAN DUPONT" required>
                            </div>
                            <button type="submit" class="btn-submit">Ajouter la carte</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
