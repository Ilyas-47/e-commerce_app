<?php
// Démarrer la session seulement si elle n'est pas déjà active
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once('../connection/connection.php');

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: ../user/login.php");
    exit();
}

// Récupérer le rôle de l'utilisateur connecté
$current_user_role = $_SESSION['user_role'];
$is_chef_administratif = ($current_user_role === 'chef administratif');

$userParPage = 10;
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$start = ($page - 1) * $userParPage;

$req1 = $pdo->prepare("SELECT * FROM user WHERE role IN ('admin', 'chef administratif') ORDER BY id_user ASC LIMIT :start, :limit");
$req1->bindParam(':start', $start, PDO::PARAM_INT);
$req1->bindParam(':limit', $userParPage, PDO::PARAM_INT);
$req1->execute();
$users = $req1->fetchAll();

$countReq = $pdo->query("SELECT COUNT(*) AS total FROM user WHERE role IN ('admin', 'chef administratif')");
$totalUser = $countReq->fetch(PDO::FETCH_ASSOC)['total'];
$totalPages = ceil($totalUser / $userParPage);

    $i = ($page - 1) * $userParPage + 1;
?>
<?php include_once '../includes/admin_nav.php'; ?>

<div class="card">
    <div class="card-header">
        <div class="card-title">Équipe</div>
        <div class="card-options">
            <?php if ($is_chef_administratif): ?>
                <button class="btn btn-warning" onclick="openAddModal()">Ajouter un membre</button>
            <?php else: ?>
                <div class="access-denied-message">
                    <i class="fas fa-lock"></i>
                    <span>Seul le chef administratif peut gérer l'équipe</span>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <table class="orders-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Rôle</th>
                <th>Date d'ajout</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $displayIndex = ($page - 1) * $userParPage + 1;
            foreach($users as $user){
                echo '<tr>';
                echo '<td>'.$displayIndex.'</td>';
                echo '<td>'.htmlspecialchars($user['nom']).'</td>';
                echo '<td>'.htmlspecialchars($user['gmail']).'</td>';
                echo '<td><span class="role-badge">'.htmlspecialchars($user['role']).'</span></td>';
                echo '<td>'.date('d/m/Y', strtotime($user['date_creation'])).'</td>';
                echo '<td class="ticket-actions">';
                if ($is_chef_administratif) {
                    echo '<button class="btn-icon" onclick="openModal('.$user['id_user'].')" title="Modifier">';
                    echo '<i class="fas fa-edit edit-icon"></i>';
                    echo '</button>';
                    echo '<button class="btn-delete" onclick="deleteUser('.$user['id_user'].')" title="Supprimer" aria-label="Supprimer">';
                    echo '<svg><use xlink:href="#trash"></use></svg>';
                    echo '</button>';
                } else {
                    echo '<span class="access-denied-text">Accès restreint</span>';
                }
                echo '</td>';
                echo '</tr>';
                $displayIndex++;
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

<!-- Modal Ajout -->
<div id="addModal" class="modal">
    <div class="modal-content">
        <h2>Ajouter un membre</h2>
        <form id="addForm">
            <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" id="addEmail" required>
            </div>
            <div class="form-group">
                <label>Rôle</label>
                <select class="form-control" id="addRole" name="role" required>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <button type="submit" class="btn btn-warning">Ajouter</button>
            <button type="button" class="btn btn-secondary" onclick="closeAddModal()">Annuler</button>
        </form>
    </div>
</div>

<!-- Modal Modification -->
<div id="editModal" class="modal">
    <div class="modal-content">
        <h2>Modifier un membre</h2>
        <form id="editForm">
            <input type="hidden" id="editUserId" name="id_user">
            <div class="form-group">
                <label>Nom</label>
                <input type="text" class="form-control" id="editName" readonly>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" id="editEmail" readonly>
            </div>
            <div class="form-group">
                <label>Téléphone</label>
                <input type="tel" class="form-control" id="editPhone" readonly>
            </div>
            <div class="form-group">
                <label>Rôle</label>
                <select class="form-control" id="editRole" name="role" required>
                    <option value="admin">Admin</option>
                    <option value="user">Utilisateur</option>
                </select>
            </div>
            <button type="submit" class="btn btn-warning">Modifier</button>
            <button type="button" class="btn btn-secondary" onclick="closeEditModal()">Annuler</button>
        </form>
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

<style>
    .role-badge {
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 500;
            background-color: #ffc107;
            color: #000;
        }

    .access-denied-message {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #6c757d;
        font-size: 14px;
        font-style: italic;
    }

    .access-denied-message i {
        color: #dc3545;
    }

    .access-denied-text {
        color: #6c757d;
        font-size: 12px;
        font-style: italic;
    }
</style>

<div id="successMessage" class="success-message">
    <span id="successText"></span>
</div>
<div id="erreurMessage" class="erreur-message">
    <span id="erreurText"></span>
</div>

<script>
    // Passer le rôle de l'utilisateur au JavaScript
    const currentUserRole = '<?php echo $current_user_role; ?>';
    const isChefAdministratif = <?php echo $is_chef_administratif ? 'true' : 'false'; ?>;
</script>
<script src="../assets/js/equipe_modal.js?v=<?php echo time(); ?>"></script>