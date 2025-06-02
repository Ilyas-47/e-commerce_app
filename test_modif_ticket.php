<?php
require_once('connection/connection.php');

echo "<h2>Test du système de modification de ticket</h2>";

// Test 1: Vérifier l'existence du fichier
echo "<h3>1. Test d'existence du fichier</h3>";
$file_path = 'system/system_modif_ticket.php';
if (file_exists($file_path)) {
    echo "✅ Le fichier $file_path existe<br>";
} else {
    echo "❌ Le fichier $file_path n'existe pas<br>";
    exit();
}

// Test 2: Récupérer un ticket existant pour le test
echo "<h3>2. Récupération d'un ticket pour test</h3>";
try {
    $req = $pdo->prepare("SELECT id_support FROM support LIMIT 1");
    $req->execute();
    $ticket = $req->fetch(PDO::FETCH_ASSOC);
    
    if ($ticket) {
        $test_ticket_id = $ticket['id_support'];
        echo "✅ Ticket trouvé pour test: ID = $test_ticket_id<br>";
    } else {
        echo "❌ Aucun ticket trouvé dans la base de données<br>";
        echo "Créons un ticket de test...<br>";
        
        // Créer un ticket de test
        $reqInsert = $pdo->prepare("INSERT INTO support (id_user, sujet, probleme, message, statut_ticket, date_creation) VALUES (1, 'Test ticket', 'Test', 'Message de test', 'En cours', NOW())");
        if ($reqInsert->execute()) {
            $test_ticket_id = $pdo->lastInsertId();
            echo "✅ Ticket de test créé: ID = $test_ticket_id<br>";
        } else {
            echo "❌ Impossible de créer un ticket de test<br>";
            exit();
        }
    }
} catch (PDOException $e) {
    echo "❌ Erreur lors de la récupération du ticket: " . $e->getMessage() . "<br>";
    exit();
}

// Test 3: Test de l'URL GET
echo "<h3>3. Test de l'URL GET</h3>";
$get_url = "system/system_modif_ticket.php?id_ticket=$test_ticket_id";
echo "URL de test: <a href='$get_url' target='_blank'>$get_url</a><br>";

// Test 4: Simuler un appel GET
echo "<h3>4. Simulation d'un appel GET</h3>";
$_GET['id_ticket'] = $test_ticket_id;
ob_start();
include 'system/system_modif_ticket.php';
$response = ob_get_clean();
unset($_GET['id_ticket']);

echo "Réponse GET: <pre>" . htmlspecialchars($response) . "</pre>";

// Test 5: Vérifier si c'est du JSON valide
$json_data = json_decode($response, true);
if ($json_data !== null) {
    echo "✅ Réponse JSON valide<br>";
    echo "Données reçues: <pre>" . print_r($json_data, true) . "</pre>";
} else {
    echo "❌ Réponse JSON invalide<br>";
}

?>
