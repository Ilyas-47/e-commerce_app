<!DOCTYPE html>
<html lang="en">
<body>
<?php include_once '../includes/admin_nav.php'; ?>

<div class="card">
    <div class="card-header">
        <div class="card-title">Utilisateurs</div>
    </div>
    <table class="orders-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Téléphone</th>
                <th>Rôle</th>
                <th>Date de création</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>#1</td>
                <td>Ilias</td>
                <td>ilias@test.com</td>
                <td>+00000000</td>
                <td><span class="role-badge">Admin</span></td>
                <td>0000-00-00</td>
                <td class="ticket-actions">
                        <button class="btn-icon" onclick="openModal(3)">
                            <i class="fas fa-edit edit-icon"></i>
                        </button>
                         <button class="btn-delete" aria-label="Supprimer">
                        <svg><use xlink:href="#trash"></use></svg>
                    </button>
                </td>
            </tr>
            <tr>
                <td>#2</td>
                <td>Ilias</td>
                <td>ilias@test.com</td>
                <td>+00000000</td>
                <td><span class="role-badge">Utilisateur</span></td>
                <td>0000-00-00</td>
                <td class="ticket-actions">
                        <button class="btn-icon" onclick="openModal(3)">
                            <i class="fas fa-edit edit-icon"></i>
                        </button>
                         <button class="btn-delete" aria-label="Supprimer">
                        <svg><use xlink:href="#trash"></use></svg>
                    </button>
                </td>
            </tr>
            <tr>
                <td>#3</td>
                <td>Ilias</td>
                <td>ilias@test.com</td>
                <td>+00000000</td>
                <td><span class="role-badge">Admin</span></td>
                <td>0000-00-00</td>
                <td class="ticket-actions">
                        <button class="btn-icon" onclick="openModal(3)">
                            <i class="fas fa-edit edit-icon"></i>
                        </button>
                         <button class="btn-delete" aria-label="Supprimer">
                        <svg><use xlink:href="#trash"></use></svg>
                    </button>
                </td>
            </tr>
            <tr>
                <td>#4</td>
                <td>Ilias</td>
                <td>ilias@test.com</td>
                <td>+00000000</td>
                <td><span class="role-badge">Utilisateur</span></td>
                <td>0000-00-00</td>
                <td class="ticket-actions">
                        <button class="btn-icon" onclick="openModal(3)">
                            <i class="fas fa-edit edit-icon"></i>
                        </button>
                         <button class="btn-delete" aria-label="Supprimer">
                        <svg><use xlink:href="#trash"></use></svg>
                    </button>
                </td>
            </tr>
            <tr>
                <td>#5</td>
                <td>Ilias</td>
                <td>ilias@test.com</td>
                <td>+00000000</td>
                <td><span class="role-badge">Utilisateur</span></td>
                <td>0000-00-00</td>
                <td class="ticket-actions">
                        <button class="btn-icon" onclick="openModal(3)">
                            <i class="fas fa-edit edit-icon"></i>
                        </button>
                         <button class="btn-delete" aria-label="Supprimer">
                        <svg><use xlink:href="#trash"></use></svg>
                    </button>
                </td>
            </tr>
            <tr>
                <td>#6</td>
                <td>Ilias</td>
                <td>ilias@test.com</td>
                <td>+00000000</td>
                <td><span class="role-badge">Admin</span></td>
                <td>0000-00-00</td>
                <td class="ticket-actions">
                        <button class="btn-icon" onclick="openModal(3)">
                            <i class="fas fa-edit edit-icon"></i>
                        </button>
                         <button class="btn-delete" aria-label="Supprimer">
                        <svg><use xlink:href="#trash"></use></svg>
                    </button>
                </td>
            </tr>
            <tr>
                <td>#7</td>
                <td>Ilias</td>
                <td>ilias@test.com</td>
                <td>+00000000</td>
                <td><span class="role-badge">Utilisateur</span></td>
                <td>0000-00-00</td>
                <td class="ticket-actions">
                        <button class="btn-icon" onclick="openModal(3)">
                            <i class="fas fa-edit edit-icon"></i>
                        </button>
                         <button class="btn-delete" aria-label="Supprimer">
                        <svg><use xlink:href="#trash"></use></svg>
                    </button>
                </td>
            </tr>
            <tr>
                <td>#8</td>
                <td>Ilias</td>
                <td>ilias@test.com</td>
                <td>+00000000</td>
                <td><span class="role-badge">Utilisateur</span></td>
                <td>0000-00-00</td>
                <td class="ticket-actions">
                        <button class="btn-icon" onclick="openModal(3)">
                            <i class="fas fa-edit edit-icon"></i>
                        </button>
                         <button class="btn-delete" aria-label="Supprimer">
                        <svg><use xlink:href="#trash"></use></svg>
                    </button>
                </td>
            </tr>
            <tr>
                <td>#9</td>
                <td>Ilias</td>
                <td>ilias@test.com</td>
                <td>+00000000</td>
                <td><span class="role-badge">Admin</span></td>
                <td>0000-00-00</td>
               <td class="ticket-actions">
                        <button class="btn-icon" onclick="openModal(3)">
                            <i class="fas fa-edit edit-icon"></i>
                        </button>
                         <button class="btn-delete" aria-label="Supprimer">
                        <svg><use xlink:href="#trash"></use></svg>
                    </button>
                </td>
            </tr>
            <tr> 
                <td>#10</td>
                <td>Ilias</td>
                <td>ilias@test.com</td>
                <td>+00000000</td>
                <td><span class="role-badge">Utilisateur</span></td>
                <td>0000-00-00</td>
               <td class="ticket-actions">
                        <button class="btn-icon" onclick="openModal(3)">
                            <i class="fas fa-edit edit-icon"></i>
                        </button>
                         <button class="btn-delete" aria-label="Supprimer">
                        <svg><use xlink:href="#trash"></use></svg>
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

<!-- SVG Icons -->
<svg style="display: none;">
    <symbol id="edit" viewBox="0 0 24 24">
        <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/>
    </symbol>
    <symbol id="trash" viewBox="0 0 24 24">
        <path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z"/>
    </symbol>
</svg>

<!-- Modal Modification -->
<div id="editModal" class="modal">
    <div class="modal-content">
        <h2>Modifier l'utilisateur</h2>
        <form id="editForm">
            <div class="form-group">
                <label>Nom</label>
                <input type="text" class="form-control" id="editName">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" id="editEmail">
            </div>
            <div class="form-group">
                <label>Téléphone</label>
                <input type="tel" class="form-control" id="editPhone">
            </div>
            <div class="form-group">
                <label>Rôle</label>
                <select class="form-control" id="editRole">
                    <option value="admin">Admin</option>
                    <option value="user">Utilisateur</option>
                </select>
            </div>
            <button type="submit" class="btn btn-warning">Enregistrer</button>
            <button type="button" class="btn btn-secondary" onclick="closeModal()">Annuler</button>
        </form>
    </div>
</div>

<div id="successMessage" class="success-message"></div>

<style>
    .role-badge {
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 500;
            background-color: #ffc107;
            color: #000;
        }
</style>
<script src="../assets/js/user_modal.js"></script>
</body>
</html>