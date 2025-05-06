<!DOCTYPE html>
<html lang="en">
<body>
<?php include_once '../includes/admin_nav.php'; ?>

<div class="card">
    <div class="card-header">
        <div class="card-title">Catégories</div>
        <div class="card-options">
            <button class="btn btn-warning" onclick="openAddModal()">Ajouter une catégorie</button>
        </div>
    </div>
    <table class="orders-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>#1</td>
                <td>categorie 1</td>
                <td>
                    <button class="btn-delete" onclick="deleteCategory(1)" aria-label="Supprimer">
                        <svg viewBox="0 0 24 24">
                            <path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z"/>
                        </svg>
                    </button>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<!-- Modal Ajout Catégorie -->
<div id="addModal" class="modal">
    <div class="modal-content">
        <h2>Ajouter une catégorie</h2>
        <form id="addForm">
            <div class="form-group">
                <label>Nom de la catégorie</label>
                <input type="text" class="form-control" id="categoryName" required>
            </div>
            <button type="submit" class="btn btn-warning">Ajouter</button>
            <button type="button" class="btn btn-secondary" onclick="closeAddModal()">Annuler</button>
        </form>
    </div>
</div>

<div id="successMessage" class="success-message"></div>


<script src="../assets/js/categories_modal.js"></script>
</body>
</html>