<?php
require_once('../connection/connection.php');

// Gestion des requêtes GET pour récupérer les données du ticket
if (isset($_GET['id_ticket'])) {
    header('Content-Type: application/json');
    $id_ticket = $_GET['id_ticket'];

    try {
        $req = $pdo->prepare("SELECT s.*, u.nom, u.gmail
                              FROM support s
                              LEFT JOIN user u ON s.id_user = u.id_user
                              WHERE s.id_support = :id_ticket");
        $req->bindParam(':id_ticket', $id_ticket, PDO::PARAM_INT);
        $req->execute();

        $ticket = $req->fetch(PDO::FETCH_ASSOC);

        if ($ticket) {
            echo json_encode($ticket);
        } else {
            echo json_encode(["error" => "Ticket introuvable"]);
        }
    } catch (Exception $e) {
        echo json_encode(["error" => "Erreur SQL : " . $e->getMessage()]);
    }
    exit; // Important pour arrêter l'exécution après la réponse JSON
}

// Gestion de la modification complète du ticket
if (isset($_POST['id_ticket'], $_POST['sujet'], $_POST['probleme'], $_POST['message'], $_POST['statut'])) {
    $id_ticket = $_POST['id_ticket'];
    $sujet = htmlspecialchars(trim($_POST['sujet']));
    $probleme = htmlspecialchars(trim($_POST['probleme']));
    $message = htmlspecialchars(trim($_POST['message']));
    $statut = htmlspecialchars(trim($_POST['statut']));

    // Validation des données obligatoires
    if (empty($sujet) || empty($probleme) || empty($message) || empty($statut)) {
        echo "error_validation";
        exit();
    }

    // Vérification de la longueur du sujet
    if (strlen($sujet) > 255) {
        echo "error_sujet_trop_long";
        exit();
    }

    // Vérification que le statut est valide
    $statutsValides = ['En cours', 'Résolu'];
    if (!in_array($statut, $statutsValides)) {
        echo "error_statut_invalide";
        exit();
    }

    try {
        // Mise à jour complète du ticket
        $req = $pdo->prepare("UPDATE support SET
            sujet = :sujet,
            probleme = :probleme,
            message = :message,
            statut_ticket = :statut
            WHERE id_support = :id_ticket");

        $req->bindParam(':id_ticket', $id_ticket, PDO::PARAM_INT);
        $req->bindParam(':sujet', $sujet);
        $req->bindParam(':probleme', $probleme);
        $req->bindParam(':message', $message);
        $req->bindParam(':statut', $statut);

        if ($req->execute()) {
            echo "success";
        } else {
            echo "error";
        }
    } catch (Exception $e) {
        error_log("Erreur SQL lors de la modification du ticket : " . $e->getMessage());
        echo "error";
    }
}
// Gestion de la modification du statut uniquement
elseif (isset($_POST['id_ticket'], $_POST['statut_ticket'])) {
    $id_ticket = $_POST['id_ticket'];
    $statut = htmlspecialchars(trim($_POST['statut_ticket']));

    // Validation des données obligatoires
    if (empty($statut)) {
        echo "error_validation";
        exit();
    }

    // Vérification que le statut est valide
    $statutsValides = ['En cours', 'Résolu'];
    if (!in_array($statut, $statutsValides)) {
        echo "error_statut_invalide";
        exit();
    }

    try {
        // Mise à jour du statut uniquement
        $req = $pdo->prepare("UPDATE support SET
            statut_ticket = :statut
            WHERE id_support = :id_ticket");

        $req->bindParam(':id_ticket', $id_ticket, PDO::PARAM_INT);
        $req->bindParam(':statut', $statut);

        if ($req->execute()) {
            echo "success";
        } else {
            echo "error";
        }
    } catch (Exception $e) {
        error_log("Erreur SQL lors de la modification du statut du ticket : " . $e->getMessage());
        echo "error";
    }
} else {
    header("location:../includes/error404.php");
    exit();
}
?>