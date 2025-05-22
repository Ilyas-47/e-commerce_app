<!DOCTYPE html>
<html>
  <style>
a:link {
  color:rgb(0, 0, 0);
  background-color: transparent;
  text-decoration: none;
}
a:visited {
  color:rgb(0, 0, 0);
  background-color: transparent;
  text-decoration: none;
}
a:hover {
  color:rgb(0, 0, 0);
  background-color: transparent;
  text-decoration: underline;
}
a:active {
  color:rgb(0, 0, 0);
  background-color: transparent;
  text-decoration: underline;
}

body {
  font-family: 'Exo', sans-serif;
  margin: 0;
  padding: 0;
}

nav {
  background-color: #f8f9fa;
  padding: 15px 0;
  text-align: center;
}

nav ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  display: flex;
  justify-content: center;
}

nav li {
  margin: 0 15px;
}

.container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 20px;
  display: flex;
  flex-direction: column;
  align-items: center;
}

.image-container {
  display: flex;
  justify-content: center;
  align-items: center;
  width: 100%;
  margin: 20px 0;
  padding: 0 15px;
}

.image-container img {
  display: block;
  width: 60%;
  max-width: 800px;
  height: auto;
  margin: 0 auto;
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

footer {
  background-color: #f8f9fa;
  padding: 15px 0;
  text-align: center;
  margin-top: 40px;
}

.footer {
  color: #666;
  font-size: 14px;
}
</style>
<body>
    <?php include('../includes/nav.php'); ?> 
  <div class="container">
    <p class="ss">Protection des Données</p>
      <p class="P1">Chez D-Product, la protection de vos données personnelles est une priorité. Cette politique de confidentialité explique comment nous collectons, utilisons et protégeons vos informations personnelles conformément à la loi marocaine 09-08 et aux standards internationaux de protection des données.</p>

      <p class="ss">1. Données collectées</p>
      <p class="P1">Nous collectons uniquement les données nécessaires à votre expérience d'achat : nom, prénom, adresse email, informations de paiement sécurisées. Ces informations sont essentielles pour traiter vos commandes et assurer le suivi de vos achats de produits digitaux.</p>

      <p class="ss">2. Utilisation des données</p>
      <p class="P1">Vos données sont utilisées pour : gérer votre compte client, traiter vos commandes, vous donner accès aux produits digitaux achetés, et vous informer des mises à jour importantes concernant nos services. Avec votre consentement, nous pouvons également vous envoyer des newsletters sur nos nouveaux produits.</p>

      <p class="ss">3. Sécurité et conservation</p>
      <p class="P1">Nous utilisons des protocoles de sécurité avancés pour protéger vos données contre tout accès non autorisé. Vos informations sont conservées uniquement pendant la durée nécessaire à nos services ou conformément aux obligations légales.</p>

      <p class="ss">4. Vos droits</p>
      <p class="P1">Vous disposez d'un droit d'accès, de rectification et de suppression de vos données. Pour exercer ces droits ou pour toute question concernant la protection de vos données, contactez notre délégué à la protection des données à privacy@d-product.com.</p>
  </div>
  
     <?php include('../includes/footer.php'); ?>

</body>
</html>