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
    <p class="ss">Mentions Légales</p>
      <p class="P1">Le site d-product.com est édité par la société Digital Marketplace SARL, au capital de 500 000 MAD, immatriculée au Registre du Commerce et des Sociétés de Rabat sous le numéro RC245789, dont le siège social est situé 45 Avenue Hassan II, Agdal, 10000 Rabat, Maroc.</p>
      
      <p class="P1">Directeur de la publication : Yassine El Amrani<br>
      Hébergeur du site : Amazon Web Services (AWS)<br>
      Adresse : Amazon Web Services EMEA SARL, 38 Avenue John F. Kennedy, L-1855, Luxembourg<br>
      Contact : contact@d-product.com</p>

      <p class="ss">Protection des données personnelles</p>
      <p class="P1">Conformément à la loi marocaine n° 09-08 relative à la protection des personnes physiques à l'égard des traitements des données à caractère personnel et des standards internationaux de protection des données, vous disposez d'un droit d'accès, de rectification et de suppression des données vous concernant. Pour exercer ce droit, veuillez nous contacter via privacy@d-product.com</p>

      <p class="ss">Propriété intellectuelle</p>
      <p class="P1">L'ensemble des éléments constituant ce site (textes, images, produits, etc.) sont protégés par les lois relatives à la propriété intellectuelle. Toute reproduction, représentation, modification ou exploitation de tout ou partie de ces éléments est strictement interdite sans autorisation préalable.</p>

      <p class="ss">Conditions générales de vente</p>
      <p class="P1">Nos conditions générales de vente régissent l'ensemble des ventes réalisées sur notre marketplace. Elles définissent les droits et obligations des parties dans le cadre de la vente de produits numériques. Pour toute transaction sur notre site, le client reconnaît avoir pris connaissance de nos CGV et les avoir acceptées.</p>
  </div>
  
     <?php include('../includes/footer.php'); ?>

</body>
</html>