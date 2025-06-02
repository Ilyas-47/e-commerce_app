<?php
// Activer l'affichage des erreurs pour debug
error_reporting(E_ALL);
ini_set('display_errors', 1);

// En-tête JSON par défaut
header('Content-Type: application/json');

try {
    require_once '../connection/connection.php';

    // Vérifier l'action demandée
    $action = $_GET['action'] ?? '';

    switch ($action) {
        case 'list':
            listDownloads();
            break;
        case 'download':
            downloadFile();
            break;
        case 'delete':
            deleteFile();
            break;
        default:
            echo json_encode(['error' => 'Action non valide']);
    }
} catch (Exception $e) {
    echo json_encode(['error' => 'Erreur serveur: ' . $e->getMessage()]);
}

function listDownloads() {
    try {
        $download_dir = '../assets/rapports/';

        // Créer le dossier s'il n'existe pas
        if (!file_exists($download_dir)) {
            if (!mkdir($download_dir, 0755, true)) {
                echo json_encode(['error' => 'Impossible de créer le dossier rapports']);
                return;
            }
        }

        $files = [];
        $scan = scandir($download_dir);

        if ($scan === false) {
            echo json_encode(['error' => 'Impossible de lire le dossier rapports']);
            return;
        }

        foreach ($scan as $file) {
            if ($file != '.' && $file != '..' && pathinfo($file, PATHINFO_EXTENSION) == 'xls') {
                $filepath = $download_dir . $file;
                if (file_exists($filepath)) {
                    $files[] = [
                        'name' => $file,
                        'size' => formatBytes(filesize($filepath)),
                        'date' => date('d/m/Y H:i', filemtime($filepath)),
                        'type' => getReportType($file)
                    ];
                }
            }
        }

        // Trier par date de modification (plus récent en premier)
        if (!empty($files)) {
            usort($files, function($a, $b) use ($download_dir) {
                return filemtime($download_dir . $b['name']) - filemtime($download_dir . $a['name']);
            });
        }

        echo json_encode($files);
    } catch (Exception $e) {
        echo json_encode(['error' => 'Erreur lors de la lecture des fichiers: ' . $e->getMessage()]);
    }
}

function downloadFile() {
    $filename = $_GET['file'] ?? '';
    
    if (empty($filename)) {
        die('Nom de fichier manquant');
    }
    
    // Sécurité : vérifier que le fichier ne contient pas de caractères dangereux
    if (strpos($filename, '..') !== false || strpos($filename, '/') !== false || strpos($filename, '\\') !== false) {
        die('Nom de fichier non valide');
    }
    
    $filepath = '../assets/rapports/' . $filename;
    
    if (!file_exists($filepath)) {
        die('Fichier non trouvé');
    }
    
    // Télécharger le fichier
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    header('Content-Length: ' . filesize($filepath));
    header('Pragma: no-cache');
    header('Expires: 0');
    
    readfile($filepath);
    exit;
}

function deleteFile() {
    $filename = $_GET['file'] ?? '';
    
    if (empty($filename)) {
        die('Nom de fichier manquant');
    }
    
    // Sécurité : vérifier que le fichier ne contient pas de caractères dangereux
    if (strpos($filename, '..') !== false || strpos($filename, '/') !== false || strpos($filename, '\\') !== false) {
        die('Nom de fichier non valide');
    }
    
    $filepath = '../assets/rapports/' . $filename;
    
    if (!file_exists($filepath)) {
        die('Fichier non trouvé');
    }
    
    if (unlink($filepath)) {
        echo json_encode(['success' => true, 'message' => 'Fichier supprimé avec succès']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Erreur lors de la suppression']);
    }
}

function formatBytes($size, $precision = 2) {
    $units = array('B', 'KB', 'MB', 'GB', 'TB');
    
    for ($i = 0; $size > 1024 && $i < count($units) - 1; $i++) {
        $size /= 1024;
    }
    
    return round($size, $precision) . ' ' . $units[$i];
}

function getReportType($filename) {
    if (strpos($filename, 'ventes') !== false) {
        return 'Ventes';
    } elseif (strpos($filename, 'produits') !== false) {
        return 'Produits';
    } elseif (strpos($filename, 'clients') !== false) {
        return 'Clients';
    } else {
        return 'Autre';
    }
}
?>
