<!DOCTYPE html>
<html lang="en">
<body>
<?php include_once '../includes/admin_nav.php'; ?> 

<div class="details-card">
    <h2>Détails de la Commande</h2>
    <form>
        <div class="form-group">
            <label>ID Commande</label>
            <input type="text" class="form-control" value="#45782" readonly>
        </div>
        
        <div class="form-group">
            <label>Nom du Produit</label>
            <input type="text" class="form-control" value="Formation Web Pro" readonly>
        </div>
        
        <div class="form-group">
            <label>Quantité</label>
            <input type="number" class="form-control" value="1" readonly>
        </div>
        
        <div class="form-group">
            <label>Prix Unitaire</label>
            <input type="text" class="form-control" value="299.99 €" readonly>
        </div>
        
        <div class="form-group">
            <label>Montant Total Payé</label>
            <input type="text" class="form-control" value="299.99 €" readonly>
        </div>
        
        <div class="form-group">
            <label>Mode de Paiement</label>
            <input type="text" class="form-control" value="Carte Bancaire" readonly>
        </div>
        
        <div class="form-group">
            <label>Date de Commande</label>
            <input type="text" class="form-control" value="2024-01-15" readonly>
        </div>
        
        <div class="form-group">
            <label>Status</label>
            <span class="status-badge status-completed">Complété</span>
        </div>
    </form>
</div>

</body>
</html>