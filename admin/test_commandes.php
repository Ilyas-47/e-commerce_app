<?php
require_once('../connection/connection.php');

echo "<h2>Test de récupération des commandes</h2>";

try {
    // Test 1: Vérifier la connexion à la base de données
    echo "<h3>1. Test de connexion à la base de données</h3>";
    if ($pdo) {
        echo "✅ Connexion à la base de données réussie<br>";
    } else {
        echo "❌ Échec de la connexion à la base de données<br>";
        exit();
    }

    // Test 2: Vérifier l'existence de la table commandes
    echo "<h3>2. Test d'existence des tables</h3>";
    $tables = ['commandes', 'user', 'details_commande', 'produits', 'paiement'];
    foreach ($tables as $table) {
        $req = $pdo->query("SHOW TABLES LIKE '$table'");
        if ($req->rowCount() > 0) {
            echo "✅ Table '$table' existe<br>";
        } else {
            echo "❌ Table '$table' n'existe pas<br>";
        }
    }

    // Test 3: Compter les commandes
    echo "<h3>3. Test du nombre de commandes</h3>";
    $countReq = $pdo->query("SELECT COUNT(*) as total FROM commandes");
    $total = $countReq->fetch(PDO::FETCH_ASSOC)['total'];
    echo "Nombre total de commandes: $total<br>";

    // Test 4: Afficher quelques commandes
    echo "<h3>4. Test d'affichage des commandes</h3>";
    if ($total > 0) {
        $req = $pdo->query("SELECT * FROM commandes LIMIT 5");
        $commandes = $req->fetchAll(PDO::FETCH_ASSOC);
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>ID User</th><th>Statut</th><th>Date</th></tr>";
        foreach ($commandes as $cmd) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($cmd['id_commande']) . "</td>";
            echo "<td>" . htmlspecialchars($cmd['id_user']) . "</td>";
            echo "<td>" . htmlspecialchars($cmd['statut']) . "</td>";
            echo "<td>" . htmlspecialchars($cmd['date_commande']) . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "Aucune commande trouvée dans la base de données.<br>";
    }

    // Test 5: Test de la requête complète utilisée dans details_commande.php
    echo "<h3>5. Test de la requête complète</h3>";
    if ($total > 0) {
        $req = $pdo->prepare("
            SELECT 
                c.id_commande,
                c.statut,
                c.date_commande,
                u.nom as nom_client,
                u.gmail as email_client,
                u.telephone as tel_client,
                p.nom_produit,
                dc.quantite,
                dc.prix_unitaire,
                (dc.quantite * dc.prix_unitaire) as total_commande,
                pay.mode_paiement,
                pay.montant as montant_paye,
                pay.statut as statut_paiement,
                pay.date_paiement
            FROM commandes c
            LEFT JOIN user u ON c.id_user = u.id_user
            LEFT JOIN details_commande dc ON c.id_commande = dc.id_commande
            LEFT JOIN produits p ON dc.id_produit = p.id_produit
            LEFT JOIN paiement pay ON c.id_commande = pay.id_commande
            LIMIT 1");
        $req->execute();
        $result = $req->fetch(PDO::FETCH_ASSOC);
        
        if ($result) {
            echo "✅ Requête complète réussie<br>";
            echo "<pre>";
            print_r($result);
            echo "</pre>";
        } else {
            echo "❌ Aucun résultat pour la requête complète<br>";
        }
    }

} catch (PDOException $e) {
    echo "❌ Erreur: " . $e->getMessage() . "<br>";
}

echo "<br><a href='commandes.php'>Retour aux commandes</a>";
?>
