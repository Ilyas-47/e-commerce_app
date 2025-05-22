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
    <p class="ss">Nos Licences</p>
      <p class="P1">D-Product propose différents types de licences pour répondre aux besoins spécifiques de chaque utilisateur. Chaque licence définit clairement les droits d'utilisation des produits digitaux acquis sur notre plateforme.</p>

      <p class="ss">Licence Standard</p>
      <p class="P1">La licence standard permet une utilisation personnelle ou professionnelle unique du produit digital. Elle vous autorise à utiliser le produit dans un seul projet, qu'il soit personnel ou commercial. Cette licence comprend un support technique de base pour vous accompagner dans l'utilisation du produit, ainsi que l'accès aux mises à jour mineures pour garantir la stabilité et la sécurité. La durée d'utilisation est illimitée, vous permettant d'exploiter le produit sans contrainte temporelle.</p>

      <p class="ss">Licence Étendue</p>
      <p class="P1">Notre licence étendue est spécialement conçue pour offrir plus de flexibilité aux entreprises et aux professionnels ayant des besoins plus importants. Elle permet l'utilisation du produit dans plusieurs projets commerciaux simultanément. Vous bénéficiez d'un support technique prioritaire et d'un accès à toutes les mises à jour, y compris les nouvelles fonctionnalités. Cette licence inclut également la possibilité de modifier le code source pour adapter le produit à vos besoins spécifiques, ainsi que le droit d'utiliser le produit dans des solutions destinées à la revente.</p>

      <p class="ss">Licence Entreprise</p>
      <p class="P1">La licence entreprise représente notre solution la plus complète, parfaitement adaptée aux grandes organisations. Elle offre une utilisation illimitée au sein de votre entreprise, accompagnée d'un support technique dédié disponible 24/7. Cette licence comprend également des sessions de formation personnalisée pour vos équipes, la possibilité de demander des modifications sur mesure du produit, et l'autorisation de déployer la solution sur plusieurs sites ou projets de l'entreprise. Cette licence assure une flexibilité maximale et un accompagnement premium pour répondre aux exigences des grands groupes.</p>

  </div>
  
     <?php include('../includes/footer.php'); ?>

</body>
</html>