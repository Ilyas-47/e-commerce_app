<?php
require_once('connection/connection.php');

echo "<h2>Test de l'API Chart Data</h2>";

try {
    // Test 1: Vérifier les tables
    echo "<h3>1. Vérification des tables</h3>";
    $tables = ['paiements', 'paiement'];
    foreach ($tables as $table) {
        $req = $pdo->query("SHOW TABLES LIKE '$table'");
        if ($req->rowCount() > 0) {
            echo "✅ Table '$table' existe<br>";
            
            // Vérifier les colonnes
            $columns = $pdo->query("DESCRIBE $table");
            echo "Colonnes de $table:<br>";
            while ($col = $columns->fetch()) {
                echo "- " . $col['Field'] . " (" . $col['Type'] . ")<br>";
            }
            echo "<br>";
        } else {
            echo "❌ Table '$table' n'existe pas<br>";
        }
    }
    
    // Test 2: Vérifier s'il y a des données
    echo "<h3>2. Vérification des données</h3>";
    $tables_to_check = ['paiements', 'paiement'];
    foreach ($tables_to_check as $table) {
        try {
            $req = $pdo->query("SELECT COUNT(*) as total FROM $table");
            $total = $req->fetch()['total'];
            echo "Table $table: $total enregistrements<br>";
            
            if ($total > 0) {
                $req = $pdo->query("SELECT * FROM $table LIMIT 3");
                echo "Exemples de données:<br>";
                while ($row = $req->fetch()) {
                    echo "<pre>" . print_r($row, true) . "</pre>";
                }
            }
        } catch (Exception $e) {
            echo "Erreur avec la table $table: " . $e->getMessage() . "<br>";
        }
    }
    
} catch (Exception $e) {
    echo "Erreur: " . $e->getMessage();
}
?>
