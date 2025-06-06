<?php
// Démarrer la session seulement si elle n'est pas déjà active
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    echo "error_not_authenticated";
    exit();
}

require_once('../connection/connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validation et nettoyage des données
    $id_user = filter_var($_POST['id_user'], FILTER_VALIDATE_INT);
    $sujet = htmlspecialchars(trim($_POST['sujet']));
    $probleme = htmlspecialchars(trim($_POST['probleme']));
    $message = htmlspecialchars(trim($_POST['message']));
    $statut = 'En cours'; // Statut automatiquement défini à "En cours"

    // Vérification que l'utilisateur connecté correspond à celui du formulaire
    if ($id_user !== $_SESSION['user_id']) {
        echo "error_unauthorized";
        exit();
    }

    // Vérification des données obligatoires
    if (!$id_user || empty($sujet) || empty($probleme) || empty($message)) {
        echo "error_validation";
        exit();
    }

    // Vérification de la longueur du sujet
    if (strlen($sujet) > 255) {
        echo "error_sujet_trop_long";
        exit();
    }

    // Vérification de la longueur du message
    if (strlen($message) > 1000) {
        echo "error_message_trop_long";
        exit();
    }

    try {
        // Vérifier que l'utilisateur existe
        $checkUser = $pdo->prepare("SELECT id_user FROM user WHERE id_user = :id_user");
        $checkUser->bindValue(':id_user', $id_user, PDO::PARAM_INT);
        $checkUser->execute();

        if ($checkUser->rowCount() == 0) {
            echo "error_user_not_found";
            exit();
        }

        // Le statut est automatiquement défini à "En cours" - pas de validation nécessaire

        // Insérer le ticket dans la base de données
        $reqTicket = $pdo->prepare("INSERT INTO support (id_user, sujet, probleme, message, statut_ticket, date_ticket)
                                   VALUES (:id_user, :sujet, :probleme, :message, :statut, NOW())");
        $reqTicket->bindValue(':id_user', $id_user, PDO::PARAM_INT);
        $reqTicket->bindValue(':sujet', $sujet);
        $reqTicket->bindValue(':probleme', $probleme);
        $reqTicket->bindValue(':message', $message);
        $reqTicket->bindValue(':statut', $statut);

        if ($reqTicket->execute()) {
            echo "success";
        } else {
            echo "error_insertion";
        }

    } catch (PDOException $e) {
        error_log("Erreur SQL lors de l'insertion du ticket : " . $e->getMessage());
        echo "error_sql";
    }
} else {
    echo "error_method";
}
?>