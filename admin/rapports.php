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
                <th>ID</th>
                <th>Type de rapport</th>
                <th>Date de génération</th>
                <th>Période</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>#1</td>
                <td>Rapport des ventes</td>
                <td>0000-00-00</td>
                <td>Janvier 0000</td>
                <td>
                    <button class="btn-icon" onclick="downloadReport(1)">
                        <i class="fas fa-download"></i>
                    </button>
                    <button class="btn-delete" onclick="deleteReport(1)">
                        <i class="fas fa-trash"></i>
                    </button>
                </td>
            </tr>
            <tr>
                <td>#2</td>
                <td>Rapport des clients</td>
                <td>0000-00-00</td>
                <td>Février 0000</td>
                <td>
                    <button class="btn-icon" onclick="downloadReport(2)">
                        <i class="fas fa-download"></i>
                    </button>
                    <button class="btn-delete" onclick="deleteReport(2)">
                        <i class="fas fa-trash"></i>
                    </button>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<!-- Modal Génération Rapport -->
<div id="reportModal" class="modal">
    <div class="modal-content">
        <h2>Générer un nouveau rapport</h2>
        <form id="reportForm">
            <div class="form-group">
                <label>Type de rapport</label>
                <select class="form-control" required>
                    <option value="">Sélectionner un type</option>
                    <option value="sales">Rapport des ventes</option>
                    <option value="customers">Rapport des clients</option>
                    <option value="products">Rapport des produits</option>
                </select>
            </div>
            <div class="form-group">
                <label>Période</label>
                <select class="form-control" required>
                    <option value="this_month">Ce mois</option>
                    <option value="last_month">Mois dernier</option>
                    <option value="this_year">Cette année</option>
                </select>
            </div>
            <button type="submit" class="btn btn-warning">Générer</button>
            <button type="button" class="btn btn-secondary" onclick="closeModal()">Annuler</button>
        </form>
    </div>
</div>

<div id="successMessage" class="success-message"></div>

<script>
function generateReport() {
    document.getElementById('reportModal').style.display = 'block';
}

function closeModal() {
    document.getElementById('reportModal').style.display = 'none';
}

function downloadReport(id) {
    showSuccessMessage('Téléchargement du rapport...');
}

function deleteReport(id) {
    if(confirm('Êtes-vous sûr de vouloir supprimer ce rapport ?')) {
        showSuccessMessage('Rapport supprimé avec succès !');
    }
}

function showSuccessMessage(message) {
    const messageElement = document.getElementById('successMessage');
    messageElement.textContent = message;
    messageElement.style.display = 'block';
    setTimeout(() => {
        messageElement.style.display = 'none';
    }, 3000);
}

document.getElementById('reportForm').onsubmit = function(e) {
    e.preventDefault();
    closeModal();
    showSuccessMessage('Rapport généré avec succès !');
};
</script>

</body>
</html>