<?php
require_once('connection/connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validation et nettoyage des données
    $id_user = filter_var($_POST['id_user'], FILTER_VALIDATE_INT);
    $statut = htmlspecialchars(trim($_POST['statut']));
    $date_commande = htmlspecialchars(trim($_POST['date_commande']));

    // Vérification des données obligatoires
    if (!$id_user || empty($statut) || empty($date_commande)) {
        echo "error_validation";
        exit();
    }

    try {
        // Démarrer une transaction
        $pdo->beginTransaction();

        // Insérer la commande
        $reqCommande = $pdo->prepare("INSERT INTO commandes (id_user, statut, date_commande) VALUES (:id_user, :statut, :date_commande)");
        $reqCommande->bindValue(':id_user', $id_user, PDO::PARAM_INT);
        $reqCommande->bindValue(':statut', $statut);
        $reqCommande->bindValue(':date_commande', $date_commande);

        if ($reqCommande->execute()) {
            $id_commande = $pdo->lastInsertId();
        } else {
            $pdo->rollBack();
            echo "error_commande";
            exit();
        }

        // Insérer les détails de la commande
        $id_produit = filter_var($_POST['id_produit'], FILTER_VALIDATE_INT);
        $quantite = filter_var($_POST['quantite'], FILTER_VALIDATE_INT);
        $prix_unitaire = filter_var($_POST['prix_unitaire'], FILTER_VALIDATE_FLOAT);

        // Validation des données des détails
        if (!$id_produit || !$quantite || $prix_unitaire === false || $quantite <= 0 || $prix_unitaire <= 0) {
            $pdo->rollBack();
            echo "error_validation_details";
            exit();
        }

        $reqDetail = $pdo->prepare("INSERT INTO details_commande (id_commande, id_produit, quantite, prix_unitaire)
                                    VALUES (:id_commande, :id_produit, :quantite, :prix_unitaire)");
        $reqDetail->bindValue(':id_commande', $id_commande, PDO::PARAM_INT);
        $reqDetail->bindValue(':id_produit', $id_produit, PDO::PARAM_INT);
        $reqDetail->bindValue(':quantite', $quantite, PDO::PARAM_INT);
        $reqDetail->bindValue(':prix_unitaire', $prix_unitaire);

        if ($reqDetail->execute()) {
            // Insérer les informations de paiement
            $mode_paiement = htmlspecialchars(trim($_POST['mode_paiement']));
            $montant = filter_var($_POST['montant'], FILTER_VALIDATE_FLOAT);
            $statut_paiement = htmlspecialchars(trim($_POST['statut_paiement']));
            $date_paiement = htmlspecialchars(trim($_POST['date_paiement']));

            // Validation des données de paiement
            if (empty($mode_paiement) || $montant === false || empty($statut_paiement) || empty($date_paiement) || $montant <= 0) {
                $pdo->rollBack();
                echo "error_validation_paiement";
                exit();
            }

            $reqPaiement = $pdo->prepare("INSERT INTO paiements (id_commande, mode_paiement, montant, statut, date_paiement)
                                         VALUES (:id_commande, :mode_paiement, :montant, :statut, :date_paiement)");
            $reqPaiement->bindValue(':id_commande', $id_commande, PDO::PARAM_INT);
            $reqPaiement->bindValue(':mode_paiement', $mode_paiement);
            $reqPaiement->bindValue(':montant', $montant);
            $reqPaiement->bindValue(':statut', $statut_paiement);
            $reqPaiement->bindValue(':date_paiement', $date_paiement);

            if ($reqPaiement->execute()) {
                // Valider la transaction
                $pdo->commit();
                echo "success";
            } else {
                $pdo->rollBack();
                echo "error_paiement";
            }
        } else {
            $pdo->rollBack();
            echo "error_detail";
        }
    } catch (PDOException $e) {
        // Annuler la transaction en cas d'erreur
        if ($pdo->inTransaction()) {
            $pdo->rollBack();
        }
        error_log("Erreur SQL : " . $e->getMessage());
        echo "error_sql: " . $e->getMessage();
    }
} else {
    header("location:includes/error404.php");
    exit();
}
?>