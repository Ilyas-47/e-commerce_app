<!DOCTYPE html>
<html>
  <style>
    body {
      font-family: 'Exo', sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f5f7fa;
      color: #2c3e50;
    }

    .container {
      width: 100%;
      max-width: 1200px;
      margin: 0 auto;
      padding: 40px 20px;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .main-title {
      font-size: 38px;
      color: #2c3e50;
      margin: 20px 0 60px 0;
      text-align: center;
      font-weight: 700;
      position: relative;
      width: 100%;
    }

    .ss {
      font-size: 32px;
      color: #2c3e50;
      margin: 40px 0;
      text-align: center;
      font-weight: 700;
    }

    .help-grid {
      display: flex;
      justify-content: center;
      gap: 30px;
      margin: 40px auto;
      width: 100%;
      flex-wrap: nowrap;
    }

    .help-card {
      width: 300px;
      flex-shrink: 0;
      text-align: center;
      background: #ffffff;
      padding: 25px;
      border-radius: 12px;
      box-shadow: 0 4px 6px rgba(0,0,0,0.05);
    }

    .help-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 15px rgba(0,0,0,0.1);
    }

    .help-card h3 {
      color: #2c3e50;
      margin-bottom: 15px;
      font-size: 20px;
      font-weight: 600;
      padding-bottom: 10px;
    }

    .help-category {
      width: 100%;
      display: flex;
      flex-direction: column;
      align-items: center;
      margin-bottom: 60px;
    }

    .P1 {
      line-height: 1.8;
      margin-bottom: 20px;
      text-align: justify;
      color: #596574;
      font-size: 15px;
    }
  </style>

<body>
    <?php include('../includes/nav.php'); ?> 
    
    <div class="container">
        <h1 class="main-title">Centre d'Aide</h1>

        <div class="help-category">
            <p class="ss">Guide de Démarrage</p>
            <div class="help-grid">
                <div class="help-card">
                    <h3>Créer un compte</h3>
                    <p class="P1">Découvrez comment créer et configurer votre compte pour commencer à acheter des produits digitaux.</p>
                </div>
                <div class="help-card">
                    <h3>Premier Achat</h3>
                    <p class="P1">Guide étape par étape pour effectuer votre premier achat sur notre plateforme.</p>
                </div>
                <div class="help-card">
                    <h3>Téléchargements</h3>
                    <p class="P1">Comment accéder et télécharger vos produits après l'achat.</p>
                </div>
            </div>
        </div>

        <div class="help-category">
            <p class="ss">Gestion de Compte</p>
            <div class="help-grid">
                <div class="help-card">
                    <h3>Paramètres du Compte</h3>
                    <p class="P1">Gérez vos informations personnelles, préférences et paramètres de sécurité.</p>
                </div>
                <div class="help-card">
                    <h3>Historique des Commandes</h3>
                    <p class="P1">Retrouvez et gérez vos achats précédents et téléchargements.</p>
                </div>
                <div class="help-card">
                    <h3>Licences et Droits</h3>
                    <p class="P1">Comprendre vos droits d'utilisation et gérer vos licences.</p>
                </div>
            </div>
        </div>

        <div class="help-category">
            <p class="ss">Support et Assistance</p>
            <div class="help-grid">
                <div class="help-card">
                    <h3>FAQ</h3>
                    <p class="P1">Réponses aux questions les plus fréquemment posées par nos utilisateurs.</p>
                </div>
                <div class="help-card">
                    <h3>Contact Support</h3>
                    <p class="P1">Comment contacter notre équipe de support pour une assistance personnalisée.</p>
                </div>
                <div class="help-card">
                    <h3>Ressources</h3>
                    <p class="P1">Guides, tutoriels et documentation pour vous aider à utiliser nos produits.</p>
                </div>
            </div>
        </div>
    </div>

    <?php include('../includes/footer.php'); ?>
</body>
</html>
