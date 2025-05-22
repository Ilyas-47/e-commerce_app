<!DOCTYPE html>
<html>
  <style>
    /* Styles de base hérités des autres pages */
    body {
      font-family: 'Exo', sans-serif;
      margin: 0;
      padding: 0;
    }

    .container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 20px;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .ss {
      font-size: 28px;
      color: #000000;
      margin-top: 30px;
      margin-bottom: 30px;
      text-align: center;
      font-weight: bold;
      width: 100%;
    }

    .P1 {
      line-height: 1.6;
      margin-bottom: 20px;
      text-align: justify;
    }

    /* Styles spécifiques pour la page d'assistance */
    .support-card {
      background: #f8f9fa;
      padding: 20px;
      border-radius: 8px;
      margin-bottom: 20px;
      width: 100%;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .contact-options {
      display: flex;
      justify-content: space-around;
      flex-wrap: wrap;
      gap: 20px;
      margin: 30px 0;
    }

    .contact-option {
      flex: 1;
      min-width: 250px;
      padding: 20px;
      text-align: center;
      background: #fff;
      border-radius: 8px;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
  </style>

<body>
    <?php include('../includes/nav.php'); ?> 
    <div class="container">
        <p class="ss">Assistance Technique</p>
        <p class="P1">Notre équipe d'assistance technique est là pour vous aider à résoudre tous les problèmes que vous pourriez rencontrer avec nos produits digitaux. Nous nous engageons à vous fournir un support rapide et efficace.</p>

        <p class="ss">Comment pouvons-nous vous aider ?</p>
        <div class="support-card">
            <p class="P1">Pour toute question technique concernant :</p>
            <p class="P1">• L'installation de vos produits<br>
            • L'utilisation des fonctionnalités<br>
            • Les problèmes de téléchargement<br>
            • Les mises à jour des produits<br>
            • Les questions de licence</p>
        </div>

        <p class="ss">Nos Services de Support</p>
        <div class="contact-options">
            <div class="contact-option">
                <h3>Support Email</h3>
                <p>Temps de réponse : 24-48h</p>
                <p>support@d-product.com</p>
            </div>
            <div class="contact-option">
                <h3>Chat en Direct</h3>
                <p>Disponible 9h-18h (GMT+1)</p>
                <p>Temps d'attente moyen : 5min</p>
            </div>
            <div class="contact-option">
                <h3>Base de Connaissances</h3>
                <p>Accès 24/7</p>
                <p>Guides et tutoriels</p>
            </div>
        </div>

        <p class="ss">Questions Fréquentes</p>
        <div class="support-card">
            <p class="P1"><strong>Q: Comment télécharger mon produit ?</strong><br>
            R: Après votre achat, vous recevrez un email contenant le lien de téléchargement. Vous pouvez également accéder à vos téléchargements depuis votre compte client.</p>

            <p class="P1"><strong>Q: Je n'ai pas reçu mon lien de téléchargement</strong><br>
            R: Vérifiez votre dossier spam. Si vous ne trouvez toujours pas l'email, contactez notre support avec votre numéro de commande.</p>

            <p class="P1"><strong>Q: Comment mettre à jour mon produit ?</strong><br>
            R: Les mises à jour sont disponibles dans votre espace client. Vous recevrez une notification par email lors de la sortie d'une nouvelle version.</p>
        </div>
    </div>

    <?php include('../includes/footer.php'); ?>
</body>
</html>
