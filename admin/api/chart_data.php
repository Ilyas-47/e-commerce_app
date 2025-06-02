<?php
header('Content-Type: application/json');
require_once('../../connection/connection.php');

try {
    $period = $_GET['period'] ?? 'week';
    
    $data = [];
    $labels = [];
    
    switch($period) {
        case 'week':
            $query = "
                SELECT 
                    DATE(p.date_paiement) as date,
                    COALESCE(SUM(p.montant), 0) as total
                FROM paiements p 
                WHERE p.date_paiement >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)
                    AND p.statut = 'Complété'
                GROUP BY DATE(p.date_paiement)
                ORDER BY date ASC
            ";
            
            $jours_fr = ['Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam'];
            for($i = 6; $i >= 0; $i--) {
                $date = date('Y-m-d', strtotime("-$i days"));
                $jour_num = date('w', strtotime($date)); 
                $labels[] = $jours_fr[$jour_num];
                $data[$date] = 0;
            }
            break;
            
        case 'month':
            $query = "
                SELECT
                    DATE(p.date_paiement) as date,
                    COALESCE(SUM(p.montant), 0) as total
                FROM paiements p
                WHERE p.date_paiement >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH)
                    AND p.statut = 'Complété'
                GROUP BY DATE(p.date_paiement)
                ORDER BY date ASC
            ";

            for($i = 3; $i >= 0; $i--) {
                $startWeek = date('Y-m-d', strtotime("-$i weeks"));
                $semNumber = 4 - $i; 
                $labels[] = "Sem " . $semNumber;
                $data[$startWeek] = 0;
            }
            break;
            
        case 'year':
            $query = "
                SELECT 
                    MONTH(p.date_paiement) as month,
                    YEAR(p.date_paiement) as year,
                    COALESCE(SUM(p.montant), 0) as total
                FROM paiements p 
                WHERE p.date_paiement >= DATE_SUB(CURDATE(), INTERVAL 12 MONTH)
                    AND p.statut = 'Complété'
                GROUP BY YEAR(p.date_paiement), MONTH(p.date_paiement)
                ORDER BY year ASC, month ASC
            ";
            
            for($i = 11; $i >= 0; $i--) {
                $date = date('Y-m-d', strtotime("-$i months"));
                $month = date('n', strtotime($date));
                $year = date('Y', strtotime($date));
                $labels[] = date('M', strtotime($date)); 
                $data["$year-$month"] = 0;
            }
            break;
    }
    
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach($results as $row) {
        switch($period) {
            case 'week':
                if(isset($data[$row['date']])) {
                    $data[$row['date']] = floatval($row['total']);
                }
                break;
            case 'month':
                $date = $row['date'];
                $weekStart = date('Y-m-d', strtotime('monday this week', strtotime($date)));
                if(isset($data[$weekStart])) {
                    $data[$weekStart] += floatval($row['total']);
                }
                break;
            case 'year':
                $key = $row['year'] . '-' . $row['month'];
                if(isset($data[$key])) {
                    $data[$key] = floatval($row['total']);
                }
                break;
        }
    }
    
    // Convertir en tableau indexé pour JavaScript
    $values = array_values($data);
    
    // Calculer le maximum pour l'échelle
    $maxValue = max($values);
    if($maxValue == 0) $maxValue = 1000; 

    // Échelle fixe pour chaque période
    switch($period) {
        case 'week':
            $maxScale = 4000; 
            break;
        case 'month':
            $maxScale = 20000; 
            break;
        case 'year':
            $maxScale = 40000; 
            break;
        default:
            $maxScale = 4000;
    }
    
    echo json_encode([
        'success' => true,
        'data' => $values,
        'labels' => $labels,
        'maxValue' => $maxScale,
        'period' => $period
    ]);
    
} catch(Exception $e) {
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]);
}
?>
