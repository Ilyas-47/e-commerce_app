<?php
require_once('connection/connection.php');

// Test simple pour vérifier les données des tickets
try {
    echo "<h2>Test de récupération des tickets</h2>";
    
    // Récupérer tous les tickets
    $req = $pdo->prepare("
        SELECT s.id_support, s.sujet, s.probleme, s.message, s.statut_ticket, s.date_ticket, 
               u.nom, u.gmail 
        FROM support s 
        LEFT JOIN user u ON s.id_user = u.id_user 
        ORDER BY s.date_ticket DESC
    ");
    $req->execute();
    $tickets = $req->fetchAll(PDO::FETCH_ASSOC);
    
    echo "<p>Nombre de tickets trouvés: " . count($tickets) . "</p>";
    
    if (count($tickets) > 0) {
        echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
        echo "<tr>";
        echo "<th>ID</th>";
        echo "<th>Sujet</th>";
        echo "<th>Problème</th>";
        echo "<th>Client</th>";
        echo "<th>Statut</th>";
        echo "<th>Date</th>";
        echo "<th>Test Modification</th>";
        echo "</tr>";
        
        foreach ($tickets as $ticket) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($ticket['id_support']) . "</td>";
            echo "<td>" . htmlspecialchars($ticket['sujet']) . "</td>";
            echo "<td>" . htmlspecialchars($ticket['probleme']) . "</td>";
            echo "<td>" . htmlspecialchars($ticket['nom'] ?? 'Inconnu') . "</td>";
            echo "<td>" . htmlspecialchars($ticket['statut_ticket']) . "</td>";
            echo "<td>" . htmlspecialchars($ticket['date_ticket']) . "</td>";
            echo "<td><a href='system/system_modif_ticket.php?id_ticket=" . $ticket['id_support'] . "' target='_blank'>Test JSON</a></td>";
            echo "</tr>";
        }
        
        echo "</table>";
        
        // Test spécifique pour le premier ticket
        if (isset($tickets[0])) {
            $first_ticket = $tickets[0];
            echo "<h3>Test détaillé pour le ticket #" . $first_ticket['id_support'] . "</h3>";
            echo "<pre>";
            print_r($first_ticket);
            echo "</pre>";
            
            echo "<h4>Test AJAX (cliquez pour tester)</h4>";
            echo "<button onclick=\"testAjax(" . $first_ticket['id_support'] . ")\">Tester AJAX pour ticket #" . $first_ticket['id_support'] . "</button>";
            echo "<div id='ajax-result'></div>";
        }
    } else {
        echo "<p style='color: red;'>Aucun ticket trouvé dans la base de données.</p>";
        echo "<p>Vérifiez que :</p>";
        echo "<ul>";
        echo "<li>La table 'support' existe</li>";
        echo "<li>Il y a des données dans la table</li>";
        echo "<li>La connexion à la base de données fonctionne</li>";
        echo "</ul>";
    }
    
} catch (PDOException $e) {
    echo "<p style='color: red;'>Erreur de base de données: " . $e->getMessage() . "</p>";
}
?>

<script>
function testAjax(ticketId) {
    console.log('Test AJAX pour ticket:', ticketId);
    
    fetch(`system/system_modif_ticket.php?id_ticket=${ticketId}`)
        .then(response => {
            console.log('Status:', response.status);
            return response.json();
        })
        .then(data => {
            console.log('Données reçues:', data);
            document.getElementById('ajax-result').innerHTML = '<h5>Résultat AJAX:</h5><pre>' + JSON.stringify(data, null, 2) + '</pre>';
        })
        .catch(error => {
            console.error('Erreur AJAX:', error);
            document.getElementById('ajax-result').innerHTML = '<h5>Erreur AJAX:</h5><pre>' + error.message + '</pre>';
        });
}
</script>
