<?php
require_once('connection/connection.php');

echo "<h2>Test du système de filtration des tickets</h2>";

// Test 1: Vérifier les tickets existants
echo "<h3>1. Tickets existants dans la base de données</h3>";
try {
    $req = $pdo->prepare("SELECT id_support, sujet, statut_ticket, date_ticket FROM support ORDER BY date_ticket DESC");
    $req->execute();
    $tickets = $req->fetchAll(PDO::FETCH_ASSOC);
    
    if ($tickets) {
        echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
        echo "<tr><th>ID</th><th>Sujet</th><th>Statut</th><th>Date</th></tr>";
        foreach ($tickets as $ticket) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($ticket['id_support']) . "</td>";
            echo "<td>" . htmlspecialchars($ticket['sujet']) . "</td>";
            echo "<td>" . htmlspecialchars($ticket['statut_ticket']) . "</td>";
            echo "<td>" . htmlspecialchars($ticket['date_ticket']) . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        echo "<p>Total: " . count($tickets) . " tickets</p>";
    } else {
        echo "<p>Aucun ticket trouvé</p>";
    }
} catch (PDOException $e) {
    echo "<p style='color: red;'>Erreur: " . $e->getMessage() . "</p>";
}

// Test 2: Test de filtration par statut
echo "<h3>2. Test de filtration par statut</h3>";
$statuts = ['En cours', 'Résolu'];
foreach ($statuts as $statut) {
    echo "<h4>Tickets avec statut: $statut</h4>";
    try {
        $req = $pdo->prepare("SELECT COUNT(*) as count FROM support WHERE statut_ticket = :statut");
        $req->bindValue(':statut', $statut);
        $req->execute();
        $count = $req->fetch(PDO::FETCH_ASSOC)['count'];
        echo "<p>Nombre de tickets '$statut': $count</p>";
    } catch (PDOException $e) {
        echo "<p style='color: red;'>Erreur: " . $e->getMessage() . "</p>";
    }
}

// Test 3: Test de filtration par date
echo "<h3>3. Test de filtration par date</h3>";
$today = date('Y-m-d');
echo "<h4>Tickets créés aujourd'hui ($today)</h4>";
try {
    $req = $pdo->prepare("SELECT COUNT(*) as count FROM support WHERE DATE(date_ticket) = :date");
    $req->bindValue(':date', $today);
    $req->execute();
    $count = $req->fetch(PDO::FETCH_ASSOC)['count'];
    echo "<p>Nombre de tickets créés aujourd'hui: $count</p>";
} catch (PDOException $e) {
    echo "<p style='color: red;'>Erreur: " . $e->getMessage() . "</p>";
}

// Test 4: Liens de test pour la filtration
echo "<h3>4. Liens de test pour la filtration</h3>";
echo "<p><a href='admin/tickets.php' target='_blank'>Tous les tickets</a></p>";
echo "<p><a href='admin/tickets.php?status=En cours' target='_blank'>Tickets en cours</a></p>";
echo "<p><a href='admin/tickets.php?status=Résolu' target='_blank'>Tickets résolus</a></p>";
echo "<p><a href='admin/tickets.php?date=$today' target='_blank'>Tickets d'aujourd'hui</a></p>";
echo "<p><a href='admin/tickets.php?status=En cours&date=$today' target='_blank'>Tickets en cours d'aujourd'hui</a></p>";

// Test 5: Simulation de requête avec filtres
echo "<h3>5. Simulation de requête avec filtres</h3>";
$statusFilter = 'En cours';
$dateFilter = $today;

echo "<h4>Simulation: Statut = '$statusFilter' ET Date = '$dateFilter'</h4>";

// Construction de la requête avec filtres (comme dans tickets.php)
$whereConditions = [];
$params = [];

if (!empty($statusFilter)) {
    $whereConditions[] = "s.statut_ticket = :status";
    $params[':status'] = $statusFilter;
}

if (!empty($dateFilter)) {
    $whereConditions[] = "DATE(s.date_ticket) = :date";
    $params[':date'] = $dateFilter;
}

$whereClause = !empty($whereConditions) ? 'WHERE ' . implode(' AND ', $whereConditions) : '';

$sql = "
    SELECT s.id_support, s.sujet, s.probleme, s.message, s.statut_ticket, s.date_ticket, u.nom, u.gmail
    FROM support s
    LEFT JOIN user u ON s.id_user = u.id_user
    $whereClause
    ORDER BY s.date_ticket DESC
";

echo "<p><strong>Requête SQL générée:</strong></p>";
echo "<pre>" . htmlspecialchars($sql) . "</pre>";

echo "<p><strong>Paramètres:</strong></p>";
echo "<pre>" . print_r($params, true) . "</pre>";

try {
    $reqTest = $pdo->prepare($sql);
    
    // Bind des paramètres de filtre
    foreach ($params as $key => $value) {
        $reqTest->bindValue($key, $value);
    }
    
    $reqTest->execute();
    $filteredTickets = $reqTest->fetchAll(PDO::FETCH_ASSOC);
    
    echo "<p><strong>Résultats:</strong> " . count($filteredTickets) . " tickets trouvés</p>";
    
    if ($filteredTickets) {
        echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
        echo "<tr><th>ID</th><th>Sujet</th><th>Client</th><th>Statut</th><th>Date</th></tr>";
        foreach ($filteredTickets as $ticket) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($ticket['id_support']) . "</td>";
            echo "<td>" . htmlspecialchars($ticket['sujet']) . "</td>";
            echo "<td>" . htmlspecialchars($ticket['nom'] ?? 'Inconnu') . "</td>";
            echo "<td>" . htmlspecialchars($ticket['statut_ticket']) . "</td>";
            echo "<td>" . htmlspecialchars($ticket['date_ticket']) . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
    
} catch (PDOException $e) {
    echo "<p style='color: red;'>Erreur lors de l'exécution de la requête: " . $e->getMessage() . "</p>";
}

?>

<style>
    body { font-family: Arial, sans-serif; margin: 20px; }
    table { margin: 10px 0; }
    th, td { padding: 8px; text-align: left; }
    th { background-color: #f2f2f2; }
    pre { background-color: #f5f5f5; padding: 10px; overflow-x: auto; }
    a { color: #007bff; text-decoration: none; }
    a:hover { text-decoration: underline; }
</style>
