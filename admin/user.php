<?php
require_once('../connection/connection.php');

// Nombre de produits par page
$userParPage = 10;
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$start = ($page - 1) * $userParPage;

$req1 = $pdo->prepare("SELECT * FROM user");
$req1->execute();
$users = $req1->fetchAll();

// Nombre total de produits pour la pagination
    $countReq = $pdo->query("SELECT COUNT(*) AS total FROM user");
    $totalUser = $countReq->fetch(PDO::FETCH_ASSOC)['total'];
    $totalPages = ceil($totalUser / $userParPage);

    $i = ($page - 1) * $userParPage + 1; // Correction du compteur
?>
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
                <th>Date d'inscription</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            foreach($users as $user){
                if($user['role'] === 'chef administratif') {
                    continue;
                }

                echo '<tr>';
                echo '<td>'.$i.'</td>';
                echo '<td>'.$user['nom'].'</td>';
                echo '<td>'.$user['gmail'].'</td>';
                echo '<td>'.$user['telephone'].'</td>';
                $roleDisplay = ($user['role'] === 'user') ? 'Utilisateur' : $user['role'];
                echo '<td><span class="role-badge">'.$roleDisplay.'</span></td>';
                echo '<td>'.date('Y-m-d', strtotime($user['date_creation'])).'</td>';
                echo '<td class="ticket-actions">';
                echo '<button class="btn-icon" onclick="openModal('.$user['id_user'].')" title="Modifier">';
                echo '<i class="fas fa-edit edit-icon"></i>';
                echo '</button>';
                echo '<button class="btn-delete" onclick="deleteUser('.$user['id_user'].')" title="Supprimer" aria-label="Supprimer">';
                echo '<svg><use xlink:href="#trash"></use></svg>';
                echo '</button>';
                echo '</td>';
                echo '</tr>';
                $i++;
            }
            ?>
        </tbody>
    </table>
    <div class="pagination">
            <?php if ($page > 1): ?>
                <a href="?page=<?= $page - 1 ?>">&laquo;</a>
            <?php endif; ?>
            <?php for ($p = 1; $p <= $totalPages; $p++): ?>
                <a href="?page=<?= $p ?>" class="<?= ($p == $page) ? 'active' : '' ?>"><?= $p ?></a>
            <?php endfor; ?>
            <?php if ($page < $totalPages): ?>
                <a href="?page=<?= $page + 1 ?>"> &raquo;</a>
            <?php endif; ?>
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
            <input type="hidden" id="editUserId" name="id_user">
            <div class="form-group">
                <label>Nom</label>
                <input type="text" class="form-control" id="editName" name="nom" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" id="editEmail" name="gmail" required>
            </div>
            <div class="form-group">
                <label>Téléphone</label>
                <input type="tel" class="form-control" id="editPhone" name="telephone" required>
            </div>
            <div class="form-group">
                <label>Rôle</label>
                <select class="form-control" id="editRole" name="role" required>
                    <option value="">Sélectionner un rôle</option>
                    <option value="admin">Admin</option>
                    <option value="user">Utilisateur</option>
                </select>
            </div>
            <button type="submit" class="btn btn-warning">Enregistrer</button>
            <button type="button" class="btn btn-secondary" onclick="closeModal()">Annuler</button>
        </form>
    </div>
</div>

<div id="successMessage" class="success-message">
    <span id="successText"></span>
</div>
<div id="erreurMessage" class="erreur-message">
    <span id="erreurText"></span>
</div>

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
<script src="../assets/js/user_modal.js?v=<?php echo time(); ?>"></script>
</body>
</html>