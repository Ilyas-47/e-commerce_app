<?php
require_once('connection/connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validation et nettoyage des données
    $id_user = filter_var($_POST['id_user'], FILTER_VALIDATE_INT);
    $sujet = htmlspecialchars(trim($_POST['sujet']));
    $probleme = htmlspecialchars(trim($_POST['probleme']));
    $message = htmlspecialchars(trim($_POST['message']));
    $statut = htmlspecialchars(trim($_POST['statut']));

    // Vérification des données obligatoires
    if (!$id_user || empty($sujet) || empty($probleme) || empty($message) || empty($statut)) {
        echo "error_validation";
        exit();
    }

    // Vérification de la longueur du sujet
    if (strlen($sujet) > 255) {
        echo "error_sujet_trop_long";
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

        // Vérifier que le statut est valide (récupérer les valeurs ENUM)
        $reqStatut = $pdo->prepare("SHOW COLUMNS FROM support LIKE 'statut_ticket'");
        $reqStatut->execute();
        $column = $reqStatut->fetch(PDO::FETCH_ASSOC);

        if ($column) {
            preg_match("/^enum\('(.*)'\)$/", $column['Type'], $matches);
            $valid_statuts = explode("','", $matches[1]);

            if (!in_array($statut, $valid_statuts)) {
                echo "error_statut_invalid";
                exit();
            }
        }

        // Insérer le ticket dans la base de données
        $reqTicket = $pdo->prepare("INSERT INTO support (id_user, sujet, probleme, message, statut_ticket, date_creation)
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
        echo "error_sql: " . $e->getMessage();
    }
} else {
    header("location:includes/error404.php");
    exit();
}
?>