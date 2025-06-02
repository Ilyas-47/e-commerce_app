<?php
require_once('connection/connection.php');

echo "<h2>Mise à jour des données de test pour échelle 1k-4k</h2>";

try {
    // Vérifier quelle table existe
    $table_name = 'paiements';
    try {
        $pdo->query("SELECT 1 FROM paiements LIMIT 1");
    } catch (Exception $e) {
        $table_name = 'paiement';
    }
    
    echo "Utilisation de la table: $table_name<br><br>";
    
    // Supprimer les anciennes données de test
    $pdo->query("DELETE FROM $table_name WHERE mode_paiement = 'TEST_DATA'");
    echo "✅ Anciennes données de test supprimées<br>";
    
    // Créer de nouvelles données de test avec des valeurs plus petites (max ~3500)
    $test_data = [
        ['date' => date('Y-m-d', strtotime('-6 days')), 'montant' => 800.00],
        ['date' => date('Y-m-d', strtotime('-5 days')), 'montant' => 1200.00],
        ['date' => date('Y-m-d', strtotime('-4 days')), 'montant' => 950.00],
        ['date' => date('Y-m-d', strtotime('-3 days')), 'montant' => 2100.00],
        ['date' => date('Y-m-d', strtotime('-2 days')), 'montant' => 1600.00],
        ['date' => date('Y-m-d', strtotime('-1 days')), 'montant' => 3400.00],
        ['date' => date('Y-m-d'), 'montant' => 2200.00],
    ];
    
    // Insérer les nouvelles données de test
    foreach ($test_data as $data) {
        $stmt = $pdo->prepare("INSERT INTO $table_name (id_commande, mode_paiement, montant, statut, date_paiement) 
                              VALUES (1, 'TEST_DATA', :montant, 'Complété', :date_paiement)");
        $stmt->execute([
            'montant' => $data['montant'],
            'date_paiement' => $data['date'] . ' 12:00:00'
        ]);
        echo "✅ Données ajoutées pour " . $data['date'] . " - " . number_format($data['montant'], 2) . " MAD<br>";
    }
    
    echo "<br><h3>Nouvelles données créées avec succès!</h3>";
    echo "Maximum: 3400 MAD → Échelle attendue: 0, 1k, 2k, 3k, 4k<br>";
    echo "<a href='admin/statistiques.php'>Voir le graphique</a><br>";
    echo "<a href='admin/api/chart_data.php?period=week'>Tester l'API</a>";
    
} catch (Exception $e) {
    echo "Erreur: " . $e->getMessage();
}
?>
