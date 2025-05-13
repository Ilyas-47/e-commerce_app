

<!DOCTYPE html> <html lang="fr"> <head> <?php include("../includes/nav.php")?> <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> <style> * { margin: 0; padding: 0; box-sizing: b

pasted

modifier les button de modifier et supprimer minimiser le size et modifier le couleur de button de supp en rouge

Je vais modifier les boutons d'édition et de suppression pour réduire leur taille et changer la couleur du bouton de suppression en rouge. Voici les modifications nécessaires :


Code HTML modifié
Code 
J'ai modifié le code HTML pour répondre à vos demandes concernant les boutons de modification et de suppression des cartes bancaires. Voici les changements effectués :

Taille des boutons réduite :
J'ai changé le padding de 12px à 6px
J'ai réduit la taille de police de 24px à 14px
Couleur du bouton de suppression :
J'ai ajouté une classe btn-delete pour le bouton de suppression
J'ai défini sa couleur de fond en rouge en utilisant la variable --danger (qui correspond à 
#f44336)
J'ai également ajouté une classe btn-edit pour le bouton de modification pour plus de clarté
Autres améliorations :
J'ai ajouté un effet hover légèrement différent pour le bouton de suppression
J'ai maintenu la cohérence du style dans les deux sections de style du document
Les boutons sont désormais plus petits et le bouton de suppression est clairement identifiable grâce à sa couleur rouge, ce qui suit les conventions d'interface utilisateur habituelles pour les actions de suppression.




Can you explain this section to me in more detail?




<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include("../includes/nav.php")?>

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

        .content {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            padding: 30px;
        }

        /* Titre agrandi */
        .section-title {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .section-title i {
            margin-right: 10px;
            color: var(--primary);
        }

        .section-description {
            color: var(--gray);
            margin-bottom: 30px;
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
            color: var(--gray);
            margin-bottom: 15px;
        }

        .card-actions {
            display: flex;
            gap: 10px;
        }

        /* Boutons modifiés - taille réduite */
        .card-actions button {
            background-color: #4361ee;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 6px;
            cursor: pointer;
            transition: background-color 0.3s;
            font-size: 14px;
        }

        /* Bouton de suppression en rouge */
        .card-actions button.btn-delete {
            background-color: var(--danger);
        }

        .card-actions button:hover {
            background-color: #3a53c9;
        }

        .card-actions button.btn-delete:hover {
            background-color: #d32f2f;
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
    <style>
        :root {
            --pay-primary: #2D3250;
            --pay-secondary: #424769;
            --pay-accent: #676F9D;
            --pay-light: #F9F9F9;
            --pay-danger: #E53935;
            --pay-success: #43A047;
        }

        .pay-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .pay-profile-section {
            display: grid;
            grid-template-columns: 250px 1fr;
            gap: 30px;
        }

        .pay-content {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
            padding: 30px;
        }

        .pay-methods {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .pay-card {
            background-color: var(--pay-light);
            border-radius: 12px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
            padding: 25px;
            transition: transform 0.3s ease;
        }

        .pay-card:hover {
            transform: translateY(-2px);
        }

        .pay-card-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 20px;
        }

        .pay-card-icon {
            font-size: 28px;
            color: var(--pay-primary);
        }

        /* Modification des boutons */
        .card-actions button {
            font-size: 14px;
            padding: 6px 10px;
            border-radius: 4px;
        }

        .card-actions button.btn-edit {
            background-color: var(--primary);
        }

        .card-actions button.btn-delete {
            background-color: var(--danger);
        }

        .pay-form {
            background-color: var(--pay-light);
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
        }

        .pay-form-title {
            color: var(--dark);
            margin-bottom: 25px;
            font-size: 1.5rem;
            font-weight: 600;
        }

        .pay-form-group {
            margin-bottom: 20px;
        }

        .pay-form-label {
            display: block;
            margin-bottom: 8px;
            color: var(--pay-secondary);
            font-weight: 500;
        }

        .pay-form-input {
            width: 100%;
            padding: 12px;
            border: 1px solid #E0E0E0;
            border-radius: 8px;
            transition: all 0.3s ease;
            background-color: white;
        }

        .pay-form-input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.1);
        }

        .pay-form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .pay-btn {
            background-color: var(--primary);
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .pay-btn:hover {
            background-color: var(--secondary);
            transform: translateY(-1px);
        }

        @media (max-width: 768px) {
            .pay-profile-section {
                grid-template-columns: 1fr;
            }
            
            .pay-methods {
                grid-template-columns: 1fr;
            }

            .pay-form-row {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <main>
        <div class="pay-container">
            <div class="pay-profile-section">
                <?php include('user_nav.php'); ?>
                
                <div class="pay-content">
                    <!-- Titre agrandi -->
                    <h1 class="section-title"><i class="fas fa-credit-card"></i> Moyens de paiement</h1>
                    <p class="section-description">Gérez vos cartes bancaires et moyens de paiement</p>

                    <div class="pay-methods">
                        <!-- Carte existante -->
                        <div class="pay-card">
                            <div class="pay-card-header">
                                <i class="fab fa-cc-visa pay-card-icon"></i>
                                <span class="card-number">**** **** **** 4242</span>
                            </div>
                            <div class="card-info">
                                <p>Expire le: 12/25</p>
                            </div>
                            <div class="card-actions">
                                <button class="btn-edit" title="Modifier"><i class="fas fa-edit"></i></button>
                                <button class="btn-delete" title="Supprimer"><i class="fas fa-trash-alt"></i></button>
                            </div>
                        </div>

                        <!-- Carte existante -->
                        <div class="pay-card">
                            <div class="pay-card-header">
                                <i class="fab fa-cc-mastercard pay-card-icon"></i>
                                <span class="card-number">**** **** **** 5555</span>
                            </div>
                            <div class="card-info">
                                <p>Expire le: 08/24</p>
                            </div>
                            <div class="card-actions">
                                <button class="btn-edit" title="Modifier"><i class="fas fa-edit"></i></button>
                                <button class="btn-delete" title="Supprimer"><i class="fas fa-trash-alt"></i></button>
                            </div>
                        </div>
                    </div>

                    <div class="pay-form">
                        <h2 class="pay-form-title">Ajouter une nouvelle carte</h2>
                        <form action="#" method="POST">
                            <div class="pay-form-group">
                                <label for="cardNumber" class="pay-form-label">Numéro de carte</label>
                                <input type="text" id="cardNumber" class="pay-form-input" placeholder="1234 5678 9012 3456" required>
                            </div>
                            <div class="pay-form-row">
                                <div class="pay-form-group">
                                    <label for="expiry" class="pay-form-label">Date d'expiration</label>
                                    <input type="text" id="expiry" class="pay-form-input" placeholder="MM/AA" required>
                                </div>
                                <div class="pay-form-group">
                                    <label for="cvv" class="pay-form-label">CVV</label>
                                    <input type="text" id="cvv" class="pay-form-input" placeholder="123" required>
                                </div>
                            </div>
                            <div class="pay-form-group">
                                <label for="cardName" class="pay-form-label">Nom sur la carte</label>
                                <input type="text" id="cardName" class="pay-form-input" placeholder="JEAN DUPONT" required>
                            </div>
                            <button type="submit" class="pay-btn">Ajouter la carte</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    
    <?php include("../includes/footer.php")?>
    
</body>
</html>
