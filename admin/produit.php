<?php
require_once('../connection/connection.php');

// Nombre de produits par page
$ProduitsParPage = 10;
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$start = ($page - 1) * $ProduitsParPage;

try {
    $req1 = $pdo->prepare("SELECT * FROM categories");
    $req1->execute();
    $categories = $req1->fetchAll(PDO::FETCH_ASSOC);
    // Récupération des produits avec leurs catégories et codes promo
    $req2 = $pdo->prepare("
        SELECT p.*, c.nom_categorie, cp.code_promo 
        FROM produits p
        LEFT JOIN categories c ON p.id_categorie = c.id_categorie
        LEFT JOIN code_promo cp ON p.id_promo = cp.id_promo
        LIMIT :limit OFFSET :offset");
    $req2->bindValue(':limit', $ProduitsParPage, PDO::PARAM_INT);
    $req2->bindValue(':offset', $start, PDO::PARAM_INT);
    $req2->execute();

    // Nombre total de produits pour la pagination
    $countReq = $pdo->query("SELECT COUNT(*) AS total FROM produits");
    $totalProduits = $countReq->fetch(PDO::FETCH_ASSOC)['total'];
    $totalPages = ceil($totalProduits / $ProduitsParPage);

    $i = ($page - 1) * $ProduitsParPage + 1; // Correction du compteur
} catch (PDOException $e) {
    echo "<tr><td colspan='7' style='color:red;'>Erreur de chargement des produits.</td></tr>";
    error_log("Erreur SQL : " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<body>
    <?php include_once '../includes/admin_nav.php'; ?>

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
                <?php
                while ($row = $req2->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>#".htmlspecialchars($i)."</td>";
                    echo "<td>".htmlspecialchars($row['nom_produit'])."</td>";
                    echo "<td>".htmlspecialchars($row['prix'])." MAD</td>";
                    echo "<td>".htmlspecialchars($row['quantite_stock'])."</td>";
                    echo "<td>".htmlspecialchars($row['nom_categorie'])."</td>";
                    echo "<td>".htmlspecialchars($row['code_promo'] ?? 'Aucun')."</td>";
                    echo "<td class='ticket-actions'>
                              <button class='btn-icon' onclick='openModal(".htmlspecialchars($row['id_produit']).")'>
                                  <i class='fas fa-edit edit-icon'></i>
                              </button>
                              <button class='btn-delete' onclick='deleteProduit(".htmlspecialchars($row['id_produit']).")' aria-label='Supprimer'>
                                  <svg viewBox='0 0 24 24'>
                                      <path d='M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z'/>
                                  </svg>
                              </button>
                          </td>";
                    echo "</tr>";
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

    <div id="editModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span> <h2>Modifier le produit</h2>
            <form id="editForm" action="../system/system_update_produit.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id_produit" id="editProductId"> <div class="form-group">
                    <label>Nom</label>
                    <input type="text" class="form-control" id="editNom" name="nom" required>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea class="form-control" id="editDescription" rows="3" name="description"></textarea>
                </div>
                <div class="form-group">
                    <label>Image Actuelle</label>
                    <div class="image-upload-container">
                        <img src="" class="preview-image" id="currentImage" alt="Image actuelle du produit" style="max-width: 150px; display: block; margin-bottom: 10px;">
                        <label for="editImage" class="btn btn-info btn-sm">Changer l'image</label>
                        <input type="file" class="form-control" id="editImage" name="image" style="display: none;">
                    </div>
                </div>
                <div class="form-group">
                    <label>Prix</label>
                    <input type="number" step="0.01" class="form-control" id="editPrix" name="prix" required>
                </div>
                <div class="form-group">
                    <label>Stock</label>
                    <input type="number" class="form-control" id="editStock" name="stock" required>
                </div>
                <div class="form-group">
                    <label>Catégorie</label>
                    <select class="form-control" id="editCategorie" name="categorie" required>
                        <option value="">Sélectionner une catégorie</option>
                        <?php foreach ($categories as $categorie) : ?>
                            <option value="<?php echo htmlspecialchars($categorie['id_categorie']); ?>">
                                <?php echo htmlspecialchars($categorie['nom_categorie']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Code Promo</label>
                    <input type="text" class="form-control" id="editPromo" name="code_promo">
                </div>
                <div class="form-group">
                    <label>Pourcentage (Promo)</label>
                    <input type="number" class="form-control" id="editPourcentage" name="pourcentage">
                </div>
                <button type="submit" class="btn btn-warning">Enregistrer</button>
                <button type="button" class="btn btn-secondary" onclick="closeModal()">Annuler</button>
            </form>
        </div>
    </div>

    <div id="addModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeAddModal()">&times;</span> <h2>Ajouter un nouveau produit</h2>
            <form id="addForm" action="../system/system_insert_produit.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Nom</label>
                    <input type="text" class="form-control" id="addNom" name="nom" required>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea class="form-control" id="addDescription" rows="3" name="description" required></textarea>
                </div>
                <div class="form-group">
                    <label>Image</label>
                    <div class="image-upload-container">
                        <img src="" class="preview-image" id="newImagePreview" alt="Prévisualisation de l'image" style="max-width: 150px; display: none; margin-bottom: 10px;">
                        <label for="addImage" class="btn btn-info btn-sm">Choisir une image</label>
                        <input type="file" class="form-control" id="addImage" name="image" required style="display: none;">
                    </div>
                </div>
                <div class="form-group">
                    <label>Prix</label>
                    <input type="number" step="0.01" class="form-control" id="addPrix" name="prix" required>
                </div>
                <div class="form-group">
                    <label>Stock</label>
                    <input type="number" class="form-control" id="addStock" name="stock" required>
                </div>
                <div class="form-group">
                    <label>Catégorie</label>
                    <select class="form-control" id="addCategorie" name="categorie" required>
                        <option value="">Sélectionner une catégorie</option>
                        <?php foreach ($categories as $categorie) { ?>
                            <option value="<?php echo $categorie['id_categorie']; ?>"><?php echo $categorie['nom_categorie']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Code Promo</label>
                    <input type="text" class="form-control" id="addPromo" name="code_promo">
                </div>
                <div class="form-group">
                    <label>Pourcentage (Promo)</label>
                    <input type="number" class="form-control" id="addPourcentage" name="pourcentage">
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

    <script src="../assets/js/produit_modal.js"></script>

</body>
</html>