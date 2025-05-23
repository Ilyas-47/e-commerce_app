<!DOCTYPE html>
<html lang="en">
<body>
<?php include_once '../includes/admin_nav.php'; ?>

<div class="card">
    <div class="card-header">
        <div class="card-title">Équipe</div>
        <div class="card-options">
            <button class="btn btn-warning" onclick="openAddModal()">Ajouter un membre</button>
        </div>
    </div>
    <table class="orders-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Fonction</th>
                <th>Date d'ajout</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>#1</td>
                <td>Ilias</td>
                <td>ilias@test.com</td>
                <td>Développeur</td>
                <td>0000-00-00</td>
                <td>
                    <button class="btn-icon" onclick="openEditModal(1)">
                            <i class="fas fa-edit edit-icon"></i>
                        </button>
                    <button class="btn-delete" onclick="confirmDelete(1)" aria-label="Supprimer">
                        <svg viewBox="0 0 24 24">
                            <path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z"/>
                        </svg>
                    </button>
                </td>
            </tr>
        </tbody>
    </table>
      <div class="pagination">
            <a href="#">&laquo;</a>
            <a href="#" class="active">1</a>
            <a href="#">2</a>
            <a href="#">3</a>
            <a href="#">&raquo;</a>
        </div>
</div>

<!-- Modal Ajout/Modification -->
<div id="memberModal" class="modal">
    <div class="modal-content">
        <h2 id="modalTitle">Ajouter un membre</h2>
        <form id="memberForm">
            <div class="form-group">
                <label>Nom</label>
                <input type="text" class="form-control" id="memberName" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" id="memberEmail" required>
            </div>
            <div class="form-group">
                <label>Fonction</label>
                <input type="text" class="form-control" id="memberRole" required>
            </div>
            <button type="submit" class="btn btn-warning">Enregistrer</button>
            <button type="button" class="btn btn-secondary" onclick="closeModal()">Annuler</button>
        </form>
    </div>
</div>

<div id="successMessage" class="success-message"></div>

<script>
function openAddModal() {
    document.getElementById('modalTitle').textContent = 'Ajouter un membre';
    document.getElementById('memberModal').style.display = 'block';
}

function openEditModal(id) {
    document.getElementById('modalTitle').textContent = 'Modifier le membre';
    document.getElementById('memberModal').style.display = 'block';
}

function closeModal() {
    document.getElementById('memberModal').style.display = 'none';
}

function confirmDelete(id) {
    if(confirm('Êtes-vous sûr de vouloir supprimer ce membre ?')) {
        showSuccessMessage('Membre supprimé avec succès !');
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

document.getElementById('memberForm').onsubmit = function(e) {
    e.preventDefault();
    closeModal();
    showSuccessMessage('Opération effectuée avec succès !');
};
</script>

</body>
</html>