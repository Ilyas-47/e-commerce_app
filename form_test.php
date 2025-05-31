<?php
require_once('connection/connection.php');

// Récupérer la liste des utilisateurs
try {
    $reqUsers = $pdo->prepare("SELECT id_user, nom FROM user ORDER BY nom");
    $reqUsers->execute();
    $users = $reqUsers->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $users = [];
    error_log("Erreur récupération utilisateurs : " . $e->getMessage());
}

// Récupérer la liste des produits avec leurs prix
try {
    $reqProduits = $pdo->prepare("SELECT id_produit, nom_produit, prix FROM produits ORDER BY nom_produit");
    $reqProduits->execute();
    $produits = $reqProduits->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $produits = [];
    error_log("Erreur récupération produits : " . $e->getMessage());
}

// Récupérer les valeurs ENUM du champ statut depuis la base de données
try {
    $reqStatut = $pdo->prepare("SHOW COLUMNS FROM commandes LIKE 'statut'");
    $reqStatut->execute();
    $column = $reqStatut->fetch(PDO::FETCH_ASSOC);

    if ($column) {
        preg_match("/^enum\('(.*)'\)$/", $column['Type'], $matches);
        $statuts = explode("','", $matches[1]);
    } else {
        $statuts = ['En attente', 'Complété']; // Valeurs par défaut si la requête échoue
    }
} catch (PDOException $e) {
    $statuts = ['En attente', 'Complété']; // Valeurs par défaut en cas d'erreur
    error_log("Erreur récupération statuts : " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insertion Commande</title>
</head>
<body>
    <h2>Insérer une Commande</h2>
    <form action="insert_commande.php" method="post">
        <label for="id_user">Utilisateur:</label>
        <select id="id_user" name="id_user" required>
            <option value="">Sélectionner un utilisateur</option>
            <?php foreach ($users as $user): ?>
                <option value="<?php echo htmlspecialchars($user['id_user']); ?>">
                    <?php echo htmlspecialchars($user['nom']); ?>
                </option>
            <?php endforeach; ?>
        </select><br>

        <label for="statut">Statut:</label>
        <select id="statut" name="statut" required>
            <option value="">Sélectionner un statut</option>
            <?php foreach ($statuts as $statut): ?>
                <option value="<?php echo htmlspecialchars($statut); ?>">
                    <?php echo htmlspecialchars($statut); ?>
                </option>
            <?php endforeach; ?>
        </select><br>

        <label for="date_commande">Date Commande:</label>
        <input type="datetime-local" id="date_commande" name="date_commande" required><br>

        <label for="id_produit">Produit:</label>
        <select id="id_produit" name="id_produit" required onchange="updatePrix()">
            <option value="">Sélectionner un produit</option>
            <?php foreach ($produits as $produit): ?>
                <option value="<?php echo htmlspecialchars($produit['id_produit']); ?>"
                        data-prix="<?php echo htmlspecialchars($produit['prix']); ?>">
                    <?php echo htmlspecialchars($produit['nom_produit']); ?> - <?php echo number_format($produit['prix'], 2); ?>€
                </option>
            <?php endforeach; ?>
        </select><br>

        <label for="quantite">Quantité:</label>
        <input type="number" id="quantite" name="quantite" required onchange="calculateMontant()"><br>

        <label for="prix_unitaire">Prix Unitaire (automatique):</label>
        <input type="number" step="0.01" id="prix_unitaire" name="prix_unitaire" required readonly style="background-color: #f0f0f0;"><br>

        <label for="mode_paiement">Mode de Paiement:</label>
        <select id="mode_paiement" name="mode_paiement" required>
            <option value="">Sélectionner un mode de paiement</option>
            <option value="Carte bancaire">Carte bancaire</option>
            <option value="PayPal">PayPal</option>
            <option value="Virement bancaire">Virement bancaire</option>
            <option value="Espèces">Espèces</option>
            <option value="Chèque">Chèque</option>
        </select><br>

        <label for="montant">Montant:</label>
        <input type="number" step="0.01" id="montant" name="montant" required><br>

        <label for="statut_paiement">Statut Paiement:</label>
        <select id="statut_paiement" name="statut_paiement" required>
            <option value="">Sélectionner un statut</option>
            <option value="En attente">En attente</option>
            <option value="Complété">Complété</option>
        </select><br>

        <label for="date_paiement">Date Paiement:</label>
        <input type="datetime-local" id="date_paiement" name="date_paiement" required><br>

        <input type="submit" value="Insérer Commande">
    </form>

    <script>
        function updatePrix() {
            const selectProduit = document.getElementById('id_produit');
            const prixUnitaireInput = document.getElementById('prix_unitaire');

            if (selectProduit.value) {
                const selectedOption = selectProduit.options[selectProduit.selectedIndex];
                const prix = selectedOption.getAttribute('data-prix');
                prixUnitaireInput.value = prix;

                // Calculer automatiquement le montant si la quantité est déjà saisie
                calculateMontant();
            } else {
                prixUnitaireInput.value = '';
                document.getElementById('montant').value = '';
            }
        }

        function calculateMontant() {
            const quantite = document.getElementById('quantite').value;
            const prixUnitaire = document.getElementById('prix_unitaire').value;
            const montantInput = document.getElementById('montant');

            if (quantite && prixUnitaire) {
                const montant = parseFloat(quantite) * parseFloat(prixUnitaire);
                montantInput.value = montant.toFixed(2);
            } else {
                montantInput.value = '';
            }
        }

        // Ajouter un événement pour recalculer le montant quand le prix unitaire change
        document.getElementById('prix_unitaire').addEventListener('input', calculateMontant);
    </script>
</body>
</html>
