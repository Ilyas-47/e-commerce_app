<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Support & Assistance</title>
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
            --danger-color: #E74C3C;
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

        .supp-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .supp-grid {
            display: grid;
            grid-template-columns: 260px 1fr;
            gap: 30px;
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        .support-sidebar {
            background-color: var(--primary-color);
            color: white;
            padding: 30px;
        }

        .support-sidebar-menu {
            list-style-type: none;
        }

        .support-sidebar-menu li {
            margin-bottom: 15px;
        }

        .support-sidebar-menu a {
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            display: flex;
            align-items: center;
            transition: color 0.3s ease;
        }

        .support-sidebar-menu a:hover,
        .support-sidebar-menu a.active {
            color: white;
        }

        .support-sidebar-menu a i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }

        .supp-content {
            padding: 40px;
        }

        .supp-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            border-bottom: 2px solid var(--border-color);
            padding-bottom: 20px;
        }

        .supp-header h1 {
            font-size: 24px;
            color: var(--dark);
            display: flex;
            align-items: center;
        }

        .supp-header h1 i {
            margin-right: 15px;
            color: #4361ee;
        }

        .supp-form {
            background-color: var(--background-color);
            border-radius: 10px;
            padding: 30px;
            margin-bottom: 30px;
        }

        .supp-form-group {
            margin-bottom: 20px;
        }

        .supp-form-group label {
            display: block;
            margin-bottom: 10px;
            font-weight: 600;
            color: var(--dark);
        }

        .supp-form-control {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            transition: all 0.3s ease;
            font-size: 16px;
            background-color: white;
        }

        .supp-form-control:focus {
            outline: none;
            border-color: var(--accent-color);
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
        }

        .supp-btn {
            background-color: #4361ee;
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(67, 97, 238, 0.25);
        }

        .supp-btn:hover {
            background-color: #3a53c9;
            box-shadow: 0 6px 8px rgba(67, 97, 238, 0.35);
            transform: translateY(-2px);
        }

        .supp-btn:active {
            transform: translateY(1px);
            box-shadow: 0 2px 4px rgba(67, 97, 238, 0.25);
        }

        .ticket-history {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .ticket-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            border-bottom: 1px solid var(--border-color);
            transition: background-color 0.3s ease;
        }

        .ticket-item:last-child {
            border-bottom: none;
        }

        .ticket-item:hover {
            background-color: var(--background-color);
        }

        .ticket-info h3 {
            font-size: 16px;
            color: var(--dark);
            margin-bottom: 5px;
        }

        .ticket-info p {
            color: var(--dark);
            font-size: 14px;
        }

        .ticket-status {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .status-open {
            background-color: rgba(255, 152, 0, 0.1);
            color: var(--warning);
            border: 1px solid var(--warning);
        }

        .status-closed {
            background-color: rgba(67, 160, 71, 0.1);
            color: var(--success);
            border: 1px solid var(--success);
        }

        @media (max-width: 992px) {
            .supp-grid {
                grid-template-columns: 1fr;
            }

            .support-sidebar {
                display: none; /* Optional: You might want to implement a mobile menu */
            }

            .supp-content {
                padding: 20px;
            }
        }
    </style>
</head>
<body> 
    <?php include("../includes/nav.php") ?>
    <main>
        <div class="supp-container">
            <div class="supp-grid">
                <?php include('user_nav.php'); ?>
                
                <div class="supp-content">
                    <div class="supp-header">
                        <h1><i class="fas fa-life-ring"></i> Support & Assistance</h1>
                    </div>

                    <div class="supp-form">
                        <h2>Ouvrir un nouveau ticket</h2>
                        <form action="#" method="POST">
                            <div class="supp-form-group">
                                <label for="subject">Sujet</label>
                                <input type="text" id="subject" class="supp-form-control" required placeholder="Résumez votre problème">
                            </div>
                            <div class="supp-form-group">
                                <label for="category">Catégorie</label>
                                <select id="category" class="supp-form-control" required>
                                    <option value="">Sélectionnez une catégorie</option>
                                    <option value="technical">Problème technique</option>
                                    <option value="billing">Facturation</option>
                                    <option value="account">Compte</option>
                                    <option value="other">Autre</option>
                                </select>
                            </div>
                            <div class="supp-form-group">
                                <label for="message">Message</label>
                                <textarea id="message" class="supp-form-control" rows="5" required placeholder="Décrivez votre problème en détail"></textarea>
                            </div>
                            <button type="submit" class="supp-btn">Envoyer le ticket</button>
                        </form>
                    </div>
                    <div class="ticket-history">
                    <div class="ticket-item">
                        <div class="ticket-info">
                            <h3>Problème de téléchargement</h3>
                            <p>Créé le 15/03/2024</p>
                        </div>
                        <span class="ticket-status status-open">En cours</span>
                    </div>
                    <div class="ticket-item">
                        <div class="ticket-info">
                            <h3>Question sur la licence</h3>
                            <p>Créé le 10/03/2024</p>
                        </div>
                        <span class="ticket-status status-closed">Résolu</span>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </main>
    <?php include("../includes/footer.php")?>
</body>
</html>