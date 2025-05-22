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
    <p class="ss">Licence d'utilisation</p>
      <p class="P1">Cette licence définit les conditions d'utilisation des produits digitaux achetés sur d-product.com. En effectuant un achat sur notre plateforme, vous acceptez les termes de cette licence.</p>
      
      <p class="ss">1. Droits accordés</p>
      <p class="P1">Après achat, vous recevez une licence non exclusive et non transférable pour utiliser le produit digital. Cette licence vous permet d'utiliser le produit pour un usage personnel ou professionnel, conformément aux conditions spécifiques de chaque produit.</p>

      <p class="ss">2. Restrictions</p>
      <p class="P1">L'acquisition d'une licence est soumise à plusieurs restrictions importantes. Il est strictement interdit de revendre ou redistribuer les produits acquis sur notre plateforme, que ce soit dans leur forme originale ou modifiée. Vous ne pouvez pas revendiquer la propriété intellectuelle des produits, car celle-ci reste la propriété exclusive des créateurs. De plus, l'utilisation des produits est interdite dans le cadre de projets illégaux ou contraires à l'éthique. Tout non-respect de ces restrictions peut entraîner la révocation immédiate de votre licence et d'éventuelles poursuites juridiques.</p>

      <p class="ss">3. Propriété intellectuelle</p>
      <p class="P1">Les créateurs conservent tous les droits de propriété intellectuelle sur leurs produits. L'achat d'une licence ne constitue pas un transfert de propriété.</p>

      <p class="ss">4. Support et mises à jour</p>
      <p class="P1">Les conditions de support et de mises à jour sont spécifiques à chaque produit. Veuillez consulter la description détaillée du produit pour plus d'informations.</p>
  </div>
  
     <?php include('../includes/footer.php'); ?>

</body>
</html>