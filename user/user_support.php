<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DigiStore - Support & Assistance</title>
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

        /* Styles de base identiques aux autres pages */
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

        .content {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            padding: 30px;
        }

        @media (max-width: 768px) {
            .profile-section {
                grid-template-columns: 1fr;
            }
            
            .sidebar {
                margin-bottom: 20px;
            }
        }

        /* Styles spécifiques au support */
        .support-sections {
            display: grid;
            gap: 20px;
            margin-bottom: 30px;
        }

        .ticket-form {
            background: white;
            border-radius: 8px;
            padding: 25px;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid var(--light-gray);
            border-radius: 4px;
            font-size: 16px;
        }

        .ticket-history {
            background: white;
            border-radius: 8px;
            overflow: hidden;
        }

        .ticket-item {
            padding: 20px;
            border-bottom: 1px solid var(--light-gray);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .ticket-status {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }

        .status-open {
            background: var(--accent);
            color: white;
        }

        .status-closed {
            background: var(--gray);
            color: white;
        }

        .btn-submit {
            background: var(--primary);
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 500;
        }

        .btn-submit:hover {
            background: var(--secondary);
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
                    <h1 class="section-title"><i class="fas fa-headset"></i> Support & Assistance</h1>
                    
                    <div class="support-sections">
                        <!-- Formulaire de ticket -->
                        <div class="ticket-form">
                            <h2>Ouvrir un nouveau ticket</h2>
                            <form action="#" method="POST">
                                <div class="form-group">
                                    <label for="subject">Sujet</label>
                                    <input type="text" id="subject" required>
                                </div>
                                <div class="form-group">
                                    <label for="category">Catégorie</label>
                                    <select id="category" required>
                                        <option value="">Sélectionnez une catégorie</option>
                                        <option value="technical">Problème technique</option>
                                        <option value="billing">Facturation</option>
                                        <option value="account">Compte</option>
                                        <option value="other">Autre</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="message">Message</label>
                                    <textarea id="message" rows="5" required></textarea>
                                </div>
                                <button type="submit" class="btn-submit">Envoyer</button>
                            </form>
                        </div>

                        <!-- Historique des tickets -->
                        <div class="ticket-history">
                            <h2>Historique des tickets</h2>
                            <div class="ticket-item">
                                <div>
                                    <h3>Problème de téléchargement</h3>
                                    <p class="ticket-date">Créé le 15/03/2024</p>
                                </div>
                                <span class="ticket-status status-open">En cours</span>
                            </div>
                            <div class="ticket-item">
                                <div>
                                    <h3>Question sur la licence</h3>
                                    <p class="ticket-date">Créé le 10/03/2024</p>
                                </div>
                                <span class="ticket-status status-closed">Résolu</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
