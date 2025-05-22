<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/user_support.css">
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
                        <span class="order-status status-pending">En cours</span>
                    </div>
                    <div class="ticket-item">
                        <div class="ticket-info">
                            <h3>Question sur la licence</h3>
                            <p>Créé le 10/03/2024</p>
                        </div>
                        <span class="order-status status-completed">Résolu</span>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </main>
    <?php include("../includes/footer.php")?>
</body>
</html>