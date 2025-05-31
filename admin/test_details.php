<?php
echo "<h1>Test de la page détails</h1>";
echo "<p>Cette page fonctionne !</p>";

if (isset($_GET['id'])) {
    echo "<p>ID reçu: " . htmlspecialchars($_GET['id']) . "</p>";
} else {
    echo "<p>Aucun ID reçu</p>";
}

echo "<br><a href='commandes.php'>Retour aux commandes</a>";
?>
