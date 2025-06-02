<?php
require_once('../connection/connection.php');
include_once '../includes/admin_nav.php';

// Nombre de tickets par page
$ticketsParPage = 10;
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$start = ($page - 1) * $ticketsParPage;

// Récupération des filtres
$statusFilter = isset($_GET['status']) ? $_GET['status'] : '';
$dateFilter = isset($_GET['date']) ? $_GET['date'] : '';

try {
    // Construction de la requête avec filtres
    $whereConditions = [];
    $params = [];

    if (!empty($statusFilter)) {
        $whereConditions[] = "s.statut_ticket = :status";
        $params[':status'] = $statusFilter;
    }

    if (!empty($dateFilter)) {
        $whereConditions[] = "DATE(s.date_ticket) = :date";
        $params[':date'] = $dateFilter;
    }

    $whereClause = !empty($whereConditions) ? 'WHERE ' . implode(' AND ', $whereConditions) : '';

    // Récupération des tickets avec pagination et filtres
    $sql = "
        SELECT s.id_support, s.sujet, s.probleme, s.message, s.statut_ticket, s.date_ticket, u.nom, u.gmail
        FROM support s
        LEFT JOIN user u ON s.id_user = u.id_user
        $whereClause
        ORDER BY s.date_ticket DESC
        LIMIT :limit OFFSET :offset
    ";

    $reqTickets = $pdo->prepare($sql);

    // Bind des paramètres de filtre
    foreach ($params as $key => $value) {
        $reqTickets->bindValue($key, $value);
    }

    $reqTickets->bindValue(':limit', $ticketsParPage, PDO::PARAM_INT);
    $reqTickets->bindValue(':offset', $start, PDO::PARAM_INT);
    $reqTickets->execute();
    $tickets = $reqTickets->fetchAll(PDO::FETCH_ASSOC);

    // Nombre total de tickets pour la pagination (avec filtres)
    $countSql = "SELECT COUNT(*) AS total FROM support s $whereClause";
    $countReq = $pdo->prepare($countSql);

    // Bind des paramètres de filtre pour le count
    foreach ($params as $key => $value) {
        $countReq->bindValue($key, $value);
    }

    $countReq->execute();
    $totalTickets = $countReq->fetch(PDO::FETCH_ASSOC)['total'];
    $totalPages = ceil($totalTickets / $ticketsParPage);

    // Statistiques des tickets
    $reqStats = $pdo->query("
        SELECT
            COUNT(*) as total,
            SUM(CASE WHEN statut_ticket = 'En cours' THEN 1 ELSE 0 END) as en_cours,
            SUM(CASE WHEN statut_ticket = 'Résolu' THEN 1 ELSE 0 END) as resolus
        FROM support
    ");
    $stats = $reqStats->fetch(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    $tickets = [];
    $stats = ['total' => 0, 'en_attente' => 0, 'completes' => 0];
    $totalPages = 0;
    error_log("Erreur récupération tickets : " . $e->getMessage());
}
?>

<div class="main-content no-top-space">
    <!-- Statistics Cards -->
    <div class="stats-container">
        <div class="stat-card total">
            <div class="stat-icon">
                <i class="fas fa-ticket-alt"></i>
            </div>
            <div class="stat-number"><?php echo $stats['total']; ?></div>
            <div class="stat-title">Total des tickets</div>
        </div>
        <div class="stat-card pending">
            <div class="stat-icon">
                <i class="fas fa-hourglass-half"></i>
            </div>
            <div class="stat-number"><?php echo $stats['en_cours']; ?></div>
            <div class="stat-title">Tickets en cours</div>
        </div>
        <div class="stat-card resolved">
            <div class="stat-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="stat-number"><?php echo $stats['resolus']; ?></div>
            <div class="stat-title">Tickets résolus</div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                Liste des tickets
                <?php if (!empty($statusFilter) || !empty($dateFilter)): ?>
                    <span class="filter-indicator">
                        <i class="fas fa-filter"></i> Filtré
                        <?php if (!empty($statusFilter)): ?>
                            <span class="filter-tag">Statut: <?php echo htmlspecialchars($statusFilter); ?></span>
                        <?php endif; ?>
                        <?php if (!empty($dateFilter)): ?>
                            <span class="filter-tag">Date: <?php echo htmlspecialchars($dateFilter); ?></span>
                        <?php endif; ?>
                    </span>
                <?php endif; ?>
            </div>
        </div>
        <div class="filter-bar">
            <div class="filter-group">
                <label for="status-filter">Statut:</label>
                <select id="status-filter" class="form-control">
                    <option value="">Tous les statuts</option>
                    <option value="En cours" <?php echo ($statusFilter === 'En cours') ? 'selected' : ''; ?>>En cours</option>
                    <option value="Résolu" <?php echo ($statusFilter === 'Résolu') ? 'selected' : ''; ?>>Résolu</option>
                </select>
            </div>
            <div class="filter-group">
                <label for="date-filter">Date:</label>
                <input type="date" id="date-filter" class="form-control" value="<?php echo htmlspecialchars($dateFilter); ?>">
            </div>
            <button class="btn-warning" onclick="applyFilters()">
                <i class="fas fa-filter"></i> Filtrer
            </button>
            <?php if (!empty($statusFilter) || !empty($dateFilter)): ?>
            <button class="btn-secondary" onclick="clearFilters()">
                <i class="fas fa-times"></i> Effacer
            </button>
            <?php endif; ?>
        </div>

        <table class="orders-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Sujet</th>
                    <th>Client</th>
                    <th>Date</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($tickets)): ?>
                    <tr>
                        <td colspan="7" style="text-align: center; padding: 20px; color: #666;">
                            Aucun ticket trouvé
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($tickets as $ticket): ?>
                        <tr>
                            <td>#<?php echo htmlspecialchars($ticket['id_support']); ?></td>
                            <td><?php echo htmlspecialchars($ticket['sujet']); ?></td>
                            <td><?php echo htmlspecialchars($ticket['nom'] ?? 'Utilisateur inconnu'); ?></td>
                            <td><?php echo date('d/m/Y', strtotime($ticket['date_ticket'])); ?></td>
                            <td>
                                <?php
                                $status_class = '';
                                switch($ticket['statut_ticket']) {
                                    case 'En cours':
                                        $status_class = 'status-pending';
                                        break;
                                    case 'Résolu':
                                        $status_class = 'status-resolved';
                                        break;
                                    default:
                                        $status_class = 'status-pending';
                                }
                                ?>
                                <span class="status-badge <?php echo $status_class; ?>">
                                    <?php echo htmlspecialchars($ticket['statut_ticket']); ?>
                                </span>
                            </td>
                            <td class="ticket-actions">
                                <button class="btn-icon" onclick="viewTicket(<?php echo $ticket['id_support']; ?>)" title="Voir">
                                    <i class="fas fa-eye view-icon"></i>
                                </button>
                                <button class="btn-icon" onclick="editTicket(<?php echo $ticket['id_support']; ?>)" title="Modifier">
                                    <i class="fas fa-edit edit-icon"></i>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>

        <?php if ($totalPages > 1): ?>
        <div class="pagination">
            <?php
            // Construire les paramètres de filtres pour la pagination
            $filterParams = [];
            if (!empty($statusFilter)) $filterParams[] = 'status=' . urlencode($statusFilter);
            if (!empty($dateFilter)) $filterParams[] = 'date=' . urlencode($dateFilter);
            $filterQuery = !empty($filterParams) ? '&' . implode('&', $filterParams) : '';
            ?>

            <?php if ($page > 1): ?>
                <a href="?page=<?php echo $page - 1; ?><?php echo $filterQuery; ?>">&laquo;</a>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <a href="?page=<?php echo $i; ?><?php echo $filterQuery; ?>" <?php echo ($i == $page) ? 'class="active"' : ''; ?>>
                    <?php echo $i; ?>
                </a>
            <?php endfor; ?>

            <?php if ($page < $totalPages): ?>
                <a href="?page=<?php echo $page + 1; ?><?php echo $filterQuery; ?>">&raquo;</a>
            <?php endif; ?>
        </div>
        <?php endif; ?>
    </div>
</div>

<!-- View Ticket Modal -->
<div id="viewTicketModal" class="modal">
    <div class="modal-content view-ticket">
        <div class="modal-header">
            <h3 class="modal-title">Détails du ticket</h3>
            <div class="modal-actions">
                <button class="modal-close" onclick="closeModal('viewTicketModal')">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        <div class="ticket-content">
            <div class="ticket-main-info">
                <div class="ticket-header">
                    <h4 id="ticket-subject">Problème avec la livraison</h4>
                    <span id="ticket-status" class="status-badge status-pending">En attente</span>
                </div>
                <div class="ticket-id">#TK001</div>
            </div>
            
            <div class="ticket-description">
                <p id="ticket-description-text">
                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Perferendis possimus rerum, maxime animi deleniti, deserunt esse ratione cumque reiciendis architecto quisquam inventore, magnam incidunt vero enim eligendi dolore obcaecati eius unde fugit? Explicabo, deserunt pariatur aspernatur nam ab ad voluptatum dolore, officia ut fugit repudiandae error consequatur perspiciatis quas blanditiis asperiores, quidem mollitia ducimus voluptatem! Eos laboriosam voluptatem deserunt illum blanditiis commodi provident voluptatibus beatae, soluta cum quod inventore totam quae! Blanditiis earum eius vero esse quaerat libero laborum unde porro vel eveniet. Nesciunt ullam animi placeat harum porro totam aut illo minima similique qui, tempora voluptatum saepe, sit ducimus?
                </p>
            </div>
            
            <div class="ticket-meta">
                <div class="meta-group">
                    <div class="meta-item">
                        <i class="fas fa-user"></i>
                        <span id="ticket-client">Jean Martin</span>
                    </div>
                    <div class="meta-item">
                        <i class="fas fa-envelope"></i>
                        <span id="ticket-email">jean.martin@example.com</span>
                    </div>
                </div>
                <div class="meta-group">
                    <div class="meta-item">
                        <i class="fas fa-calendar-alt"></i>
                        <span id="ticket-date">20/05/2025</span>
                    </div>
                    <div class="meta-item">
                        <i class="fas fa-clock"></i>
                        <span id="ticket-update">20/05/2025</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Ajout du modal de modification -->
<div id="editModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Modifier du ticket</h2>
        </div>
        <form id="editForm" action="../system/system_modif_ticket.php" method="POST">
            <input type="hidden" name="id_ticket" id="editTicketId">
            <div class="form-group">
                <label>Sujet</label>
                <input type="text" class="form-control" id="editSujet" readonly>
            </div>
            <div class="form-group">
                <label>Client</label>
                <input type="text" class="form-control" id="editClient" readonly>
            </div>
            <div class="form-group">
                <label>Type de problème</label>
                <input type="text" class="form-control" id="editProbleme" readonly>
            </div>
            <div class="form-group">
                <label>Message</label>
                <textarea class="form-control" id="editMessage" rows="5" readonly></textarea>
            </div>
            <div class="form-group">
                <label>Statut</label>
                <select class="form-control" id="editStatut" required>
                    <option value="">Sélectionner un statut</option>
                    <option value="En cours">En cours</option>
                    <option value="Résolu">Résolu</option>
                </select>
            </div>
            <div class="form-group">
                <label>Date de création</label>
                <input type="text" class="form-control" id="editDate" readonly>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-warning">
                    Modifier
                </button>
                <button type="button" class="btn btn-secondary" onclick="closeModal('editModal')">
                  Annuler
                </button>
            </div>
        </form>
    </div>
</div>

</body>
<script src="../assets/js/tickets.js"></script>
</html>