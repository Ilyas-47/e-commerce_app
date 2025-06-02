<?php
require_once '../connection/connection.php';

// Vérifier que les paramètres sont présents
if (!isset($_GET['rapport']) || !isset($_GET['periode'])) {
    die('Paramètres manquants');
}

// Vérifier la connexion à la base de données
if (!$pdo) {
    die('Erreur de connexion à la base de données');
}

// Récupérer les choix
$rapport = $_GET['rapport'];
$periode = $_GET['periode'];

// Calculer les dates selon la période
$now = new DateTime();
switch ($periode) {
    case 'Ce_mois':
        $start = $now->format('Y-m-01');
        $end = $now->format('Y-m-t');
        $periode_label = 'Ce mois (' . $now->format('m/Y') . ')';
        break;
    case 'Mois_dernier':
        $start = $now->modify('first day of last month')->format('Y-m-01');
        $end = $now->format('Y-m-t');
        $periode_label = 'Mois dernier (' . $now->format('m/Y') . ')';
        break;
    case 'cette_annee':
        $start = date('Y-01-01');
        $end = date('Y-12-31');
        $periode_label = 'Cette année (' . date('Y') . ')';
        break;
    default:
        die('Période invalide');
}

// Définir le nom du rapport
$rapport_names = [
    'ventes' => 'Rapport des Ventes',
    'produits' => 'Rapport des Produits',
    'clients' => 'Rapport des Clients'
];

$rapport_title = $rapport_names[$rapport] ?? 'Rapport';

// Classe simple pour générer Excel
class SimpleExcelGenerator {
    private $data = [];
    private $headers = [];
    private $title = '';
    private $subtitle = '';
    private $totals = [];

    public function __construct($title = '', $subtitle = '') {
        $this->title = $title;
        $this->subtitle = $subtitle;
    }

    public function setHeaders($headers) {
        $this->headers = $headers;
    }

    public function addRow($row) {
        $this->data[] = $row;
    }

    public function addTotalRow($totals) {
        $this->totals = $totals;
    }
    
    public function generate($filename, $save_to_file = false) {
        if ($save_to_file) {
            // Sauvegarder dans un fichier
            $this->saveToFile($filename);
        } else {
            // Téléchargement direct
            $this->downloadFile($filename);
        }
    }

    private function downloadFile($filename) {
        // En-têtes pour Excel - utiliser le format XML Excel compatible
        header('Content-Type: application/vnd.ms-excel; charset=utf-8');
        header('Content-Disposition: attachment; filename="' . $filename . '.xls"');
        header('Pragma: no-cache');
        header('Expires: 0');

        $this->generateContent();
    }

    private function saveToFile($filename) {
        // Utiliser le dossier assets/rapports existant
        $upload_dir = '../assets/rapports/';
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }

        // Générer le contenu dans un fichier
        $filepath = $upload_dir . $filename . '.xls';
        ob_start();
        $this->generateContent();
        $content = ob_get_clean();

        file_put_contents($filepath, $content);

        // Retourner le chemin pour téléchargement immédiat
        header('Content-Type: application/vnd.ms-excel; charset=utf-8');
        header('Content-Disposition: attachment; filename="' . $filename . '.xls"');
        header('Pragma: no-cache');
        header('Expires: 0');
        echo $content;
    }

    private function generateContent() {

        // Format Excel HTML simple mais compatible
        echo '<html xmlns:o="urn:schemas-microsoft-com:office:office"' . "\n";
        echo ' xmlns:x="urn:schemas-microsoft-com:office:excel"' . "\n";
        echo ' xmlns="http://www.w3.org/TR/REC-html40">' . "\n";
        echo '<head>' . "\n";
        echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8">' . "\n";
        echo '<meta name="ProgId" content="Excel.Sheet">' . "\n";
        echo '<style>' . "\n";
        echo 'table { border-collapse: collapse; width: 100%; font-family: Arial, sans-serif; }' . "\n";
        echo '.header { background-color: #4472C4; color: white; font-weight: bold; padding: 8px; border: 1px solid #000; text-align: center; }' . "\n";
        echo '.data { padding: 6px; border: 1px solid #000; }' . "\n";
        echo '.number { text-align: right; padding: 6px; border: 1px solid #000; }' . "\n";
        echo '.total { background-color: #E7E6E6; font-weight: bold; padding: 6px; border: 1px solid #000; }' . "\n";
        echo '.title { font-size: 16px; font-weight: bold; text-align: center; margin-bottom: 10px; }' . "\n";
        echo '</style>' . "\n";
        echo '</head>' . "\n";
        echo '<body>' . "\n";

        // Titre
        if ($this->title || $this->subtitle) {
            echo '<div class="title">' . htmlspecialchars($this->title . ($this->subtitle ? ' - ' . $this->subtitle : '')) . '</div>' . "\n";
        }

        echo '<table>' . "\n";

        // En-têtes
        if (!empty($this->headers)) {
            echo '<tr>' . "\n";
            foreach ($this->headers as $header) {
                echo '<th class="header">' . htmlspecialchars($header) . '</th>' . "\n";
            }
            echo '</tr>' . "\n";
        }
        
        // Données
        foreach ($this->data as $row) {
            echo '<tr>' . "\n";
            foreach ($row as $key => $cell) {
                $class = 'data';

                // Déterminer la classe selon les données
                if (is_numeric($cell) && (strpos($key, 'montant') !== false || strpos($key, 'prix') !== false || strpos($key, 'total') !== false || strpos($key, 'chiffre') !== false)) {
                    $class = 'number';
                    $cell = number_format($cell, 2, ',', ' ') . ' MAD';
                } elseif (is_numeric($cell) && (strpos($key, 'quantite') !== false || strpos($key, 'nombre') !== false || strpos($key, 'stock') !== false)) {
                    $class = 'number';
                    $cell = number_format($cell, 0, ',', ' ');
                }

                echo '<td class="' . $class . '">' . htmlspecialchars($cell) . '</td>' . "\n";
            }
            echo '</tr>' . "\n";
        }

        // Ligne de totaux si disponible
        if (!empty($this->totals)) {
            echo '<tr>' . "\n";
            foreach ($this->totals as $key => $total) {
                $class = 'total';

                if (is_numeric($total) && (strpos($key, 'montant') !== false || strpos($key, 'prix') !== false || strpos($key, 'total') !== false || strpos($key, 'chiffre') !== false)) {
                    $total = number_format($total, 2, ',', ' ') . ' MAD';
                } elseif (is_numeric($total) && (strpos($key, 'quantite') !== false || strpos($key, 'nombre') !== false || strpos($key, 'stock') !== false)) {
                    $total = number_format($total, 0, ',', ' ');
                }

                echo '<td class="' . $class . '">' . htmlspecialchars($total) . '</td>' . "\n";
            }
            echo '</tr>' . "\n";
        }

        echo '</table>' . "\n";

        // Ligne d'informations
        echo '<p style="text-align: center; font-size: 10px; color: #666; margin-top: 20px;">' . "\n";
        echo 'Rapport généré le ' . date('d/m/Y à H:i') . ' | Nombre d\'enregistrements: ' . count($this->data);
        echo '</p>' . "\n";

        echo '</body>' . "\n";
        echo '</html>' . "\n";
    }
}

try {
    // Créer l'instance du générateur Excel
    $excel = new SimpleExcelGenerator($rapport_title, $periode_label);
    
    // Générer le rapport selon le type
    if ($rapport === 'sales' || $rapport === 'ventes') {
        $excel->setHeaders(['ID Commande', 'Nom de produit', 'Client', 'Quantité', 'Montant Total', 'Date', 'Statut']);

        $stmt = $pdo->prepare("
            SELECT
                c.id_commande,
                p.nom_produit,
                u.nom as nom_client,
                dc.quantite,
                (dc.quantite * dc.prix_unitaire) as montant_total,
                DATE(c.date_commande) as date_commande,
                c.statut
            FROM commandes c
            LEFT JOIN user u ON c.id_user = u.id_user
            LEFT JOIN details_commande dc ON c.id_commande = dc.id_commande
            LEFT JOIN produits p ON dc.id_produit = p.id_produit
            WHERE c.date_commande BETWEEN ? AND ?
            ORDER BY c.date_commande DESC, c.id_commande ASC
        ");
        $stmt->execute([$start . ' 00:00:00', $end . ' 23:59:59']);

        $total_ventes = 0;
        $total_quantite = 0;
        $nombre_lignes = 0;

        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
            $excel->addRow($row);
            $total_ventes += $row['montant_total'];
            $total_quantite += $row['quantite'];
            $nombre_lignes++;
        }

        // Ajouter ligne de totaux
        $excel->addTotalRow([
            'id_commande' => 'TOTAL',
            'nom_produit' => $nombre_lignes . ' produits',
            'nom_client' => '',
            'quantite' => $total_quantite,
            'montant_total' => $total_ventes,
            'date_commande' => '',
            'statut' => ''
        ]);

        $filename = 'rapport_ventes_' . $periode . '_' . date('Y-m-d');

    } elseif ($rapport === 'products' || $rapport === 'produits') {
        $excel->setHeaders(['Nom Produit', 'Prix', 'Stock', 'Categorie', 'Chiffre d\'Affaires']);

        $stmt = $pdo->prepare("
            SELECT
                p.nom_produit,
                p.prix,
                p.quantite_stock,
                c.nom_categorie as categorie,
                COALESCE(SUM(dc.quantite * dc.prix_unitaire), 0) as chiffre_affaires
            FROM produits p
            LEFT JOIN categories c ON p.id_categorie = c.id_categorie
            LEFT JOIN details_commande dc ON p.id_produit = dc.id_produit
            LEFT JOIN commandes cmd ON dc.id_commande = cmd.id_commande
                AND cmd.date_commande BETWEEN ? AND ?
            GROUP BY p.id_produit, p.nom_produit, p.prix, p.quantite_stock, c.nom_categorie
            ORDER BY chiffre_affaires DESC
        ");
        $stmt->execute([$start . ' 00:00:00', $end . ' 23:59:59']);

        $total_stock = 0;
        $total_chiffre_affaires = 0;
        $nombre_produits = 0;

        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
            $excel->addRow($row);
            $total_stock += $row['quantite_stock'];
            $total_chiffre_affaires += $row['chiffre_affaires'];
            $nombre_produits++;
        }

        // Ajouter ligne de totaux
        $excel->addTotalRow([
            'nom_produit' => 'TOTAL (' . $nombre_produits . ' produits)',
            'prix' => '',
            'quantite_stock' => $total_stock,
            'categorie' => '',
            'chiffre_affaires' => $total_chiffre_affaires
        ]);

        $filename = 'rapport_produits_' . $periode . '_' . date('Y-m-d');
        
    } elseif ($rapport === 'customers' || $rapport === 'clients') {
        $excel->setHeaders(['Nom', 'Email', 'Téléphone', 'Nombre Commandes', 'Total Achats']);

        $stmt = $pdo->prepare("
            SELECT
                u.nom,
                u.gmail,
                u.telephone,
                COUNT(DISTINCT c.id_commande) as nombre_commandes,
                SUM(dc.quantite * dc.prix_unitaire) as total_achats
            FROM user u
            JOIN commandes c ON u.id_user = c.id_user
            JOIN details_commande dc ON c.id_commande = dc.id_commande
            WHERE c.date_commande BETWEEN ? AND ?
            GROUP BY u.id_user, u.nom, u.gmail, u.telephone
            ORDER BY total_achats DESC
        ");
        $stmt->execute([$start . ' 00:00:00', $end . ' 23:59:59']);

        $total_commandes = 0;
        $total_achats = 0;
        $nombre_clients = 0;

        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
            $excel->addRow($row);
            $total_commandes += $row['nombre_commandes'];
            $total_achats += $row['total_achats'];
            $nombre_clients++;
        }

        // Ajouter ligne de totaux
        $excel->addTotalRow([
            'nom' => 'TOTAL (' . $nombre_clients . ' clients)',
            'gmail' => '',
            'telephone' => '',
            'nombre_commandes' => $total_commandes,
            'total_achats' => $total_achats
        ]);

        $filename = 'rapport_clients_' . $periode . '_' . date('Y-m-d');

    } else {
        die("Type de rapport invalide: " . htmlspecialchars($rapport));
    }

    // Générer le fichier Excel et le sauvegarder
    $excel->generate($filename, true);
    
} catch (PDOException $e) {
    die('Erreur lors de la génération du rapport: ' . $e->getMessage());
} catch (Exception $e) {
    die('Erreur inattendue: ' . $e->getMessage());
}

exit;
