
<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include("../includes/nav.php")?>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/user_pay.css">
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
                           <div class="fav-item-actions">
                                        <button class="fav-item-cart" aria-label="Ajouter au panier">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="fav-item-remove" aria-label="Retirer des favoris">
                                            <i class="fas fa-trash"></i>
                                        </button>
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
                            <div class="fav-item-actions">
                                        <button class="fav-item-cart" aria-label="Ajouter au panier">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="fav-item-remove" aria-label="Retirer des favoris">
                                            <i class="fas fa-trash"></i>
                                        </button>
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
                            <button type="submit" class="supp-btn">Ajouter la carte</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    
    <?php include("../includes/footer.php")?>
    
</body>
</html>
