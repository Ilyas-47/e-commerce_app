<!DOCTYPE html>
<html lang="fr">
<head>
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
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="user-info">
            <div class="avatar">
                <img src="../assets/images/office.png" alt="Profile" style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">
            </div>
            <div class="user-name">Ilias</div>
            <div class="user-email">Ilias@example.com</div>
        </div>
        <ul class="menu">
            <!-- <li><a href="user_profil.php"><i class="fas fa-tachometer-alt"></i> Tableau de bord</a></li> -->
            <li><a href="user_info.php"><i class="fas fa-user"></i> Informations personnelles</a></li>
            <li><a href="user_commande.php"><i class="fas fa-shopping-bag"></i> Mes commandes</a></li>
            <li><a href="user_pay.php"><i class="fas fa-credit-card"></i> Moyens de paiement</a></li>
            <li><a href="user_favoris.php"><i class="fas fa-heart"></i> Liste de souhaits</a></li>
            <li><a href="user_support.php"><i class="fas fa-headset"></i> Support</a></li>
            <li><a href="#"><i class="fas fa-sign-out-alt"></i> Déconnexion</a></li>
        </ul>
    </div>
</body>
</html>