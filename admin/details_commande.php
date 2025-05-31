<?php
require_once('../connection/connection.php');

// Debug: Afficher les paramètres reçus
echo "<!-- Debug: GET parameters: ";
print_r($_GET);
echo " -->";

// Récupérer l'ID de la commande depuis l'URL
$id_commande = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Debug: Afficher l'ID traité
echo "<!-- Debug: ID commande traité: $id_commande -->";

if ($id_commande <= 0) {
    echo "Erreur: ID de commande invalide (ID: $id_commande)";
    echo "<br><a href='commandes.php'>Retour aux commandes</a>";
    exit();
}

try {
    // Récupérer les détails de la commande
    $req = $pdo->prepare("
        SELECT
            c.id_commande,
            c.statut,
            c.date_commande,
            u.nom,
            u.gmail,
            u.telephone,
            p.nom_produit,
            dc.quantite,
            dc.prix_unitaire,
            pay.mode_paiement,
            pay.montant,
            pay.statut,
            pay.date_paiement
        FROM commandes c
        LEFT JOIN user u ON c.id_user = u.id_user
        LEFT JOIN details_commande dc ON c.id_commande = dc.id_commande
        LEFT JOIN produits p ON dc.id_produit = p.id_produit
        LEFT JOIN paiements pay ON c.id_commande = pay.id_commande
        WHERE c.id_commande = :id_commande");

    $req->bindValue(':id_commande', $id_commande, PDO::PARAM_INT);
    $req->execute();
    $commande = $req->fetch(PDO::FETCH_ASSOC);

    if (!$commande) {
        echo "Erreur: Commande non trouvée (ID: $id_commande)";
        echo "<br><a href='commandes.php'>Retour aux commandes</a>";
        exit();
    }

} catch (PDOException $e) {
    echo "Erreur de base de données: " . $e->getMessage();
    echo "<br><a href='commandes.php'>Retour aux commandes</a>";
    error_log("Erreur récupération détails commande : " . $e->getMessage());
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<body>
<?php include_once '../includes/admin_nav.php'; ?>
<style>
    .back-button {
        background-color: #6c757d;
        color: white;
        padding: 8px 16px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
        font-size: 14px;
        transition: background-color 0.3s;
        float: right;
        margin: 10px 0;
    }

    .back-button:hover {
        background-color: #5a6268;
    }
</style>
<div class="details-card">
    <h2>Détails de la Commande #<?php echo htmlspecialchars($commande['id_commande']); ?></h2>
    <form>
        <div class="form-group">
            <label>ID Commande</label>
            <input type="text" class="form-control" value="#<?php echo htmlspecialchars($commande['id_commande']); ?>" readonly>
        </div>

        <div class="form-group">
            <label>Nom du Produit</label>
            <input type="text" class="form-control" value="<?php echo htmlspecialchars($commande['nom_produit'] ?? 'Produit inconnu'); ?>" readonly>
        </div>

        <div class="form-group">
            <label>Quantité</label>
            <input type="text" class="form-control" value="<?php echo htmlspecialchars($commande['quantite'] ?? '0'); ?>" readonly>
        </div>

        <div class="form-group">
            <label>Prix Unitaire</label>
            <input type="text" class="form-control" value="<?php echo htmlspecialchars($commande['prix_unitaire'] ?? 0, 2); ?> MAD" readonly>
        </div>

        <div class="form-group">
            <label>Montant Total Payé</label>
            <input type="text" class="form-control" value="<?php echo number_format($commande['montant'] ?? 0, 2); ?> MAD" readonly>
        </div>

        <div class="form-group">
            <label>Mode de Paiement</label>
            <input type="text" class="form-control" value="<?php echo htmlspecialchars($commande['mode_paiement'] ?? 'Non renseigné'); ?>" readonly>
        </div>

        <div class="form-group">
            <label>Date de Commande</label>
            <input type="text" class="form-control" value="<?php echo date('d/m/Y', strtotime($commande['date_commande'])); ?>" readonly>
        </div>
        
        <div class="form-group">
            <label>Statut</label>
            <?php
            $statusClass = '';
            switch(strtolower($commande['statut'])) {
                case 'complété':
                    $statusClass = 'status-completed';
                    break;
                case 'en attente':
                    $statusClass = 'status-pending';
                    break;
                default:
                    $statusClass = 'status-pending';
            }
            ?>
            <span class="status-badge <?php echo $statusClass; ?>">
                <?php echo htmlspecialchars($commande['statut']); ?>
            </span>
            <a href="commandes.php" class="back-button">← Retour aux commandes</a>
        </div>
    </form>
</div>

</body>
</html>