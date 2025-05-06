<!DOCTYPE html>
<html lang="en">
<head>
<body>
<?php include_once '../includes/admin_nav.php'; ?>

<!-- Ajouter les définitions SVG -->
<svg style="display: none;">
    <symbol id="edit" viewBox="0 0 24 24">
        <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/>
    </symbol>
    <symbol id="trash" viewBox="0 0 24 24">
        <path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z"/>
    </symbol>
</svg>

<div class="card">
    <div class="card-header">
        <div class="card-title">Produits</div>
        <div class="card-options">
            <button class="btn btn-warning" onclick="openAddModal()">Ajouter un produit</button>
        </div>
    </div>
    <table class="orders-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prix</th>
                <th>Stock</th>
                <th>Catégorie</th>
                <th>Code Promo</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>#1</td>
                <td>DG</td>
                <td>00,00 MAD</td>
                <td>0</td>
                <td>categorie 1</td>
                <td>promo</td>
                <td>
                    <button class="btn-edit" onclick="openModal(1)" aria-label="Modifier">
                        <svg>
                            <use xlink:href="#edit"></use>
                        </svg>
                    </button>
                    <button class="btn-delete" aria-label="Supprimer">
                        <svg>
                            <use xlink:href="#trash"></use>
                        </svg>
                    </button>
                </td>
            </tr>
            <tr>
                <td>#2</td>
                <td>DG</td>
                <td>00,00 MAD</td>
                <td>0</td>
                <td>categorie 1</td>
                <td>promo</td>
                <td>
                    <button class="btn-edit" onclick="openModal(2)" aria-label="Modifier">
                        <svg><use xlink:href="#edit"></use></svg>
                    </button>
                    <button class="btn-delete" aria-label="Supprimer">
                        <svg><use xlink:href="#trash"></use></svg>
                    </button>
                </td>
            </tr>
            <tr>
                <td>#3</td>
                <td>DG</td>
                <td>00,00 MAD</td>
                <td>0</td>
                <td>categorie 1</td>
                <td>promo</td>
                <td>
                    <button class="btn-edit" onclick="openModal(3)" aria-label="Modifier">
                        <svg><use xlink:href="#edit"></use></svg>
                    </button>
                    <button class="btn-delete" aria-label="Supprimer">
                        <svg><use xlink:href="#trash"></use></svg>
                    </button>
                </td>
            </tr>
            <tr>
                <td>#4</td>
                <td>DG</td>
                <td>00,00 MAD</td>
                <td>0</td>
                <td>categorie 1</td>
                <td>promo</td>
                <td>
                    <button class="btn-edit" onclick="openModal(4)" aria-label="Modifier">
                        <svg><use xlink:href="#edit"></use></svg>
                    </button>
                    <button class="btn-delete" aria-label="Supprimer">
                        <svg><use xlink:href="#trash"></use></svg>
                    </button>
                </td>
            </tr>
            <tr>
                <td>#5</td>
                <td>DG</td>
                <td>00,00 MAD</td>
                <td>0</td>
                <td>categorie 1</td>
                <td>promo</td>
                <td>
                    <button class="btn-edit" onclick="openModal(5)" aria-label="Modifier">
                        <svg><use xlink:href="#edit"></use></svg>
                    </button>
                    <button class="btn-delete" aria-label="Supprimer">
                        <svg><use xlink:href="#trash"></use></svg>
                    </button>
                </td>
            </tr>
            <tr>
                <td>#6</td>
                <td>DG</td>
                <td>00,00 MAD</td>
                <td>0</td>
                <td>categorie 1</td>
                <td>promo</td>
                <td>
                    <button class="btn-edit" onclick="openModal(6)" aria-label="Modifier">
                        <svg><use xlink:href="#edit"></use></svg>
                    </button>
                    <button class="btn-delete" aria-label="Supprimer">
                        <svg><use xlink:href="#trash"></use></svg>
                    </button>
                </td>
            </tr>
            <tr>
                <td>#7</td>
                <td>DG</td>
                <td>00,00 MAD</td>
                <td>0</td>
                <td>categorie 1</td>
                <td>promo</td>
                <td>
                    <button class="btn-edit" onclick="openModal(7)" aria-label="Modifier">
                        <svg><use xlink:href="#edit"></use></svg>
                    </button>
                    <button class="btn-delete" aria-label="Supprimer">
                        <svg><use xlink:href="#trash"></use></svg>
                    </button>
                </td>
            </tr>
            <tr>
                <td>#8</td>
                <td>DG</td>
                <td>00,00 MAD</td>
                <td>0</td>
                <td>categorie 1</td>
                <td>promo</td>
                <td>
                    <button class="btn-edit" onclick="openModal(8)" aria-label="Modifier">
                        <svg><use xlink:href="#edit"></use></svg>
                    </button>
                    <button class="btn-delete" aria-label="Supprimer">
                        <svg><use xlink:href="#trash"></use></svg>
                    </button>
                </td>
            </tr>
            <tr>
                <td>#9</td>
                <td>DG</td>
                <td>00,00 MAD</td>
                <td>0</td>
                <td>categorie 1</td>
                <td>promo</td>
                <td>
                    <button class="btn-edit" onclick="openModal(9)" aria-label="Modifier">
                        <svg><use xlink:href="#edit"></use></svg>
                    </button>
                    <button class="btn-delete" aria-label="Supprimer">
                        <svg><use xlink:href="#trash"></use></svg>
                    </button>
                </td>
            </tr>
            <tr>
                <td>#10</td>
                <td>DG</td>
                <td>00,00 MAD</td>
                <td>0</td>
                <td>categorie 1</td>
                <td>promo</td>
                <td>
                    <button class="btn-edit" onclick="openModal(10)" aria-label="Modifier">
                        <svg><use xlink:href="#edit"></use></svg>
                    </button>
                    <button class="btn-delete" aria-label="Supprimer">
                        <svg><use xlink:href="#trash"></use></svg>
                    </button>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<!-- Ajout du modal de modification -->
<div id="editModal" class="modal">
    <div class="modal-content">
        <h2>Modifier le produit</h2>
        <form id="editForm">
            <div class="form-group">
                <label>Nom</label>
                <input type="text" class="form-control" id="editNom">
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea class="form-control" id="editDescription" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label>Image</label>
                <div class="image-upload-container">
                    <img src="../assets/images/netflix.png" class="preview-image" id="currentImage">
                    <input type="file" class="form-control" id="editImage" accept="image/*">
                </div>
            </div>
            <div class="form-group">
                <label>Prix</label>
                <input type="number" step="0.01" class="form-control" id="editPrix">
            </div>
            <div class="form-group">
                <label>Stock</label>
                <input type="number" class="form-control" id="editStock">
            </div>
            <div class="form-group">
                <label>Catégorie</label>
                <select class="form-control" id="editCategorie">
                    <option value="">Sélectionner une catégorie</option>
                    <option value="Formation">Formation</option>
                    <option value="Plugin">Plugin</option>
                    <option value="Theme">Theme</option>
                    <option value="Ebook">E-book</option>
                    <option value="Cours">Cours</option>
                </select>
            </div>
            <div class="form-group">
                <label>Code Promo</label>
                <input type="text" class="form-control" id="editPromo">
            </div>
            <button type="submit" class="btn btn-warning">Enregistrer</button>
            <button type="button" class="btn btn-secondary" onclick="closeModal()">Annuler</button>
        </form>
    </div>
</div>

<!-- Après le modal de modification, ajouter le modal d'ajout -->
<div id="addModal" class="modal">
    <div class="modal-content">
        <h2>Ajouter un nouveau produit</h2>
        <form id="addForm">
            <div class="form-group">
                <label>Nom</label>
                <input type="text" class="form-control" id="addNom" required>
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea class="form-control" id="addDescription" rows="3" required></textarea>
            </div>
            <div class="form-group">
                <label>Image</label>
                <div class="image-upload-container">
                    <img src="../assets/images/placeholder.png" class="preview-image" id="newImage">
                    <input type="file" class="form-control" id="addImage" accept="image/*" required>
                </div>
            </div>
            <div class="form-group">
                <label>Prix</label>
                <input type="number" step="0.01" class="form-control" id="addPrix" required>
            </div>
            <div class="form-group">
                <label>Stock</label>
                <input type="number" class="form-control" id="addStock" required>
            </div>
            <div class="form-group">
                <label>Catégorie</label>
                <select class="form-control" id="addCategorie" required>
                    <option value="">Sélectionner une catégorie</option>
                    <option value="Formation">Formation</option>
                    <option value="Plugin">Plugin</option>
                    <option value="Theme">Theme</option>
                    <option value="Ebook">E-book</option>
                    <option value="Cours">Cours</option>
                </select>
            </div>
            <div class="form-group">
                <label>Code Promo</label>
                <input type="text" class="form-control" id="addPromo">
            </div>
            <button type="submit" class="btn btn-warning">Ajouter</button>
            <button type="button" class="btn btn-secondary" onclick="closeAddModal()">Annuler</button>
        </form>
    </div>
</div>

<div id="successMessage" class="success-message">
    Modifications enregistrées avec succès !
</div>

<script src="../assets/js/produit_modal.js"></script>
</body>
</html>