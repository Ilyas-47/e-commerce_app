<?php
require_once('../connection/connection.php');

// Définition du nombre de catégories par page
$categoriesParPage = 10;

// Récupérer le numéro de la page actuelle
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$start = ($page - 1) * $categoriesParPage;

try {
    // Récupérer seulement les 10 catégories de la page actuelle
    $req = $pdo->prepare("SELECT id_categorie, nom_categorie FROM categories ORDER BY id_categorie ASC LIMIT :start, :limit");
    $req->bindParam(':start', $start, PDO::PARAM_INT);
    $req->bindParam(':limit', $categoriesParPage, PDO::PARAM_INT);
    $req->execute();

    $i = $start + 1; // Initialiser le compteur à la première catégorie de la page
    // Récupérer le nombre total de catégories pour afficher la pagination
    $countReq = $pdo->query("SELECT COUNT(*) AS total FROM categories");
    $totalCategories = $countReq->fetch(PDO::FETCH_ASSOC)['total'];
    $totalPages = ceil($totalCategories / $categoriesParPage);
} catch (PDOException $e) {
    echo "<tr><td colspan='3' style='color:red;'>Erreur de chargement des catégories.</td></tr>";
    error_log("Erreur de récupération des catégories: " . $e->getMessage());
}
?>
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
<?php
    while ($row = $req->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>#".htmlspecialchars($i)."</td>"; // Affichage dynamique du numéro
        echo "<td>".htmlspecialchars($row['nom_categorie'])."</td>";
        echo "<td>
                <button class='btn-delete' onclick='deleteCategory(".htmlspecialchars($row['id_categorie']).")' aria-label='Supprimer'>
                    <svg viewBox='0 0 24 24'>
                        <path d='M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z'/>
                    </svg>
                </button>
             </td>";
        echo "</tr>";
        $i++; // Incrémenter le compteur
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

<!-- Modal Ajout Catégorie -->
<div id="addModal" class="modal">
    <div class="modal-content">
        <h2>Ajouter une catégorie</h2>
        <form id="addForm"  action="../system/system_insert_catego.php" method="POST">
            <div class="form-group">
                <label>Nom de la catégorie</label>
                <input type="text" class="form-control" id="categoryName" name="categorie" required>
            </div>
            <button type="submit" class="btn btn-warning">Ajouter</button>
            <button type="button" class="btn btn-secondary" onclick="closeAddModal()">Annuler</button>
        </form>
    </div>
</div>

 <div id="successMessage" class="success-message">
        <span id="successText"></span>
    </div>

<div id="erreurMessage" class="erreur-message">
        <span id="erreurText"></span>
    </div>
<script src="../assets/js/categories_modal.js"></script>
</body>
</html>