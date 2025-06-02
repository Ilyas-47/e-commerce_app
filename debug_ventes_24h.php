<?php
require_once('connection/connection.php');

echo "<h2>Debug des ventes 24h</h2>";

try {
    // Vérifier quelle table existe
    $table_name = 'paiements';
    try {
        $pdo->query("SELECT 1 FROM paiements LIMIT 1");
    } catch (Exception $e) {
        $table_name = 'paiement';
    }
    
    echo "<h3>Table utilisée: $table_name</h3>";
    
    // 1. Voir tous les paiements
    echo "<h3>1. Tous les paiements dans la table:</h3>";
    $req = $pdo->query("SELECT * FROM $table_name ORDER BY date_paiement DESC");
    $all_payments = $req->fetchAll();
    echo "Total des paiements: " . count($all_payments) . "<br><br>";
    
    foreach ($all_payments as $payment) {
        echo "ID: " . $payment['id_commande'] . 
             " | Montant: " . $payment['montant'] . 
             " | Statut: " . $payment['statut'] . 
             " | Mode: " . $payment['mode_paiement'] . 
             " | Date: " . $payment['date_paiement'] . "<br>";
    }
    
    // 2. Requête actuelle (avec toutes les conditions)
    echo "<h3>2. Requête actuelle (avec filtres):</h3>";
    $req = $pdo->query("SELECT COALESCE(SUM(montant), 0) AS total FROM $table_name WHERE date_paiement >= DATE_SUB(NOW(), INTERVAL 24 HOUR) AND statut = 'Complété' AND mode_paiement != 'TEST_DATA'");
    $total_filtered = $req->fetch()['total'];
    echo "Total avec filtres: " . number_format($total_filtered, 2) . " MAD<br>";
    
    // 3. Requête sans filtre de statut
    echo "<h3>3. Requête sans filtre de statut:</h3>";
    $req = $pdo->query("SELECT COALESCE(SUM(montant), 0) AS total FROM $table_name WHERE date_paiement >= DATE_SUB(NOW(), INTERVAL 24 HOUR) AND mode_paiement != 'TEST_DATA'");
    $total_no_status = $req->fetch()['total'];
    echo "Total sans filtre statut: " . number_format($total_no_status, 2) . " MAD<br>";
    
    // 4. Requête sans aucun filtre (24h seulement)
    echo "<h3>4. Requête 24h seulement:</h3>";
    $req = $pdo->query("SELECT COALESCE(SUM(montant), 0) AS total FROM $table_name WHERE date_paiement >= DATE_SUB(NOW(), INTERVAL 24 HOUR)");
    $total_24h_only = $req->fetch()['total'];
    echo "Total 24h seulement: " . number_format($total_24h_only, 2) . " MAD<br>";
    
    // 5. Total de tous les paiements
    echo "<h3>5. Total de TOUS les paiements:</h3>";
    $req = $pdo->query("SELECT COALESCE(SUM(montant), 0) AS total FROM $table_name");
    $total_all = $req->fetch()['total'];
    echo "Total de tous les paiements: " . number_format($total_all, 2) . " MAD<br>";
    
    // 6. Vérifier la date actuelle
    echo "<h3>6. Informations de date:</h3>";
    $req = $pdo->query("SELECT NOW() as current_time, DATE_SUB(NOW(), INTERVAL 24 HOUR) as time_24h_ago");
    $time_info = $req->fetch();
    echo "Heure actuelle: " . $time_info['current_time'] . "<br>";
    echo "Il y a 24h: " . $time_info['time_24h_ago'] . "<br>";
    
} catch (Exception $e) {
    echo "Erreur: " . $e->getMessage();
}
?>
