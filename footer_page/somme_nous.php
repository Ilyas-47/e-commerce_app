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
    <!-- <div class="image-container">
      <img src="../assets/images/d-product.png" alt="Product Image">
    </div> -->
    <p class="ss">Qui sommes-nous ?</p>
      <p class="P1">Bienvenue sur notre marketplace de produits digitaux ! Née de la passion pour l'innovation numérique, notre plateforme a été créée pour offrir un espace où créateurs et acheteurs peuvent échanger des ressources digitales de qualité. Notre mission est de simplifier l'accès aux produits numériques tout en garantissant une expérience d'achat sécurisée et intuitive.</p> 
      
      <p class="P1">Notre équipe est composée de professionnels passionnés par le digital et l'e-commerce. Nous nous efforçons de sélectionner soigneusement chaque produit proposé sur notre plateforme pour garantir la meilleure qualité possible. Que vous soyez à la recherche de templates, d'outils digitaux, de ressources graphiques ou de contenu numérique, notre marketplace est conçue pour répondre à vos besoins avec une large gamme de produits régulièrement mise à jour.</p>
  </div>
  
     <?php include('../includes/footer.php'); ?>

</body>
</html>