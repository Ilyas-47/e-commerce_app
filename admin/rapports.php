<?php
require_once('../connection/connection.php');
?>
<!DOCTYPE html>
<html lang="en">
<body>
<?php include_once '../includes/admin_nav.php'; ?>

<div class="card">
    <div class="card-header">
        <div class="card-title">Rapports</div>
        <div class="card-options">
            <button class="btn btn-warning" onclick="generateReport()">Générer un rapport</button>
        </div>
    </div>
    <table class="orders-table">
        <thead>
            <tr>
                <th>Nom du fichier</th>
                <th>Date de génération</th>
                <th>Période</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="downloads-list">
            <tr>
                <td colspan="4" class="text-center">
                    <i class="fas fa-spinner fa-spin"></i> Chargement des rapports...
                </td>
            </tr>
        </tbody>
    </table>
</div>

<!-- Modal Génération Rapport -->
<div id="reportModal" class="modal">
    <div class="modal-content">
        <h2>Générer un nouveau rapport</h2>
        <form id="reportForm" action="../system/system_generate_excel.php" method="GET">
            <div class="form-group">
                <label>Type de rapport</label>
                <select name="rapport" class="form-control" required>
                    <option value="">Sélectionner un type</option>
                    <option value="ventes">Rapport des ventes</option>
                    <option value="clients">Rapport des clients</option>
                    <option value="produits">Rapport des produits</option>
                </select>
            </div>
            <div class="form-group">
                <label>Période</label>
                <select name="periode" class="form-control" required>
                    <option value="Ce_mois">Ce mois</option>
                    <option value="Mois_dernier">Mois dernier</option>
                    <option value="cette_annee">Cette année</option>
                </select>
            </div>
            <button type="submit" class="btn btn-warning">Générer</button>
            <button type="button" class="btn btn-secondary" onclick="closeModal()">Annuler</button>
        </form>
    </div>
</div>

<div id="successMessage" class="success-message"></div>

<script src="../assets/js/rapport_modal.js"></script>

</body>
</html>