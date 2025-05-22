<?php include_once '../includes/admin_nav.php'; ?>

<div class="main-content no-top-space">
    <!-- Statistics Cards -->
    <div class="stats-container">
        <div class="stat-card total">
            <div class="stat-icon">
                <i class="fas fa-ticket-alt"></i>
            </div>
            <div class="stat-number">87</div>
            <div class="stat-title">Total des tickets</div>
        </div>
        <div class="stat-card pending">
            <div class="stat-icon">
                <i class="fas fa-hourglass-half"></i>
            </div>
            <div class="stat-number">23</div>
            <div class="stat-title">Tickets en attente</div>
        </div>
        <div class="stat-card resolved">
            <div class="stat-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="stat-number">52</div>
            <div class="stat-title">Tickets résolus</div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="card">
        <div class="card-header">
            <div class="card-title">Liste des tickets</div>
        </div>
        <div class="filter-bar">
            <div class="filter-group">
                <label for="status-filter">Statut:</label>
                <select id="status-filter" class="form-control">
                    <option value="">Tous les statuts</option>
                    <option value="pending">En attente</option>
                    <option value="resolved">Résolu</option>
                </select>
            </div>
            <div class="filter-group">
                <label for="date-filter">Date:</label>
                <input type="date" id="date-filter" class="form-control">
            </div>
            <button class="btn-warning" onclick="applyFilters()">
                <i class="fas fa-filter"></i> Filtrer
            </button>
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
                <tr>
                    <td>#TK001</td>
                    <td>Problème avec la livraison</td>
                    <td>Jean Martin</td>
                    <td>20/05/2025</td>
                    <td><span class="status-badge status-pending">En attente</span></td>
                    <td class="ticket-actions">
                        <button class="btn-icon" onclick="viewTicket('TK001')">
                            <i class="fas fa-eye view-icon"></i>
                        </button>
                        <button class="btn-icon" onclick="editTicket('TK001')">
                            <i class="fas fa-edit edit-icon"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td>#TK002</td>
                    <td>Question sur le remboursement</td>
                    <td>Sophie Dubois</td>
                    <td>19/05/2025</td>
                    <td><span class="status-badge status-pending">En attente</span></td>
                    <td class="ticket-actions">
                        <button class="btn-icon" onclick="viewTicket('TK002')">
                            <i class="fas fa-eye view-icon"></i>
                        </button>
                        <button class="btn-icon" onclick="editTicket('TK002')">
                            <i class="fas fa-edit edit-icon"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td>#TK003</td>
                    <td>Produit défectueux</td>
                    <td>Pierre Lemoine</td>
                    <td>18/05/2025</td>
                    <td><span class="status-badge status-pending">En attente</span></td>
                    <td class="ticket-actions">
                        <button class="btn-icon" onclick="viewTicket('TK003')">
                            <i class="fas fa-eye view-icon"></i>
                        </button>
                        <button class="btn-icon" onclick="editTicket('TK003')">
                            <i class="fas fa-edit edit-icon"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td>#TK004</td>
                    <td>Problème de paiement</td>
                    <td>Marie Garnier</td>
                    <td>17/05/2025</td>
                    <td><span class="status-badge status-resolved">Résolu</span></td>
                    <td class="ticket-actions">
                        <button class="btn-icon" onclick="viewTicket('TK004')">
                            <i class="fas fa-eye view-icon"></i>
                        </button>
                        <button class="btn-icon" onclick="editTicket('TK004')">
                            <i class="fas fa-edit edit-icon"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td>#TK005</td>
                    <td>Demande d'information produit</td>
                    <td>Lucie Petit</td>
                    <td>16/05/2025</td>
                    <td><span class="status-badge status-resolved">Résolu</span></td>
                    <td class="ticket-actions">
                        <button class="btn-icon" onclick="viewTicket('TK005')">
                            <i class="fas fa-eye view-icon"></i>
                        </button>
                        <button class="btn-icon" onclick="editTicket('TK005')">
                            <i class="fas fa-edit edit-icon"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td>#TK006</td>
                    <td>Bug sur le site web</td>
                    <td>Thomas Bernard</td>
                    <td>15/05/2025</td>
                    <td><span class="status-badge status-resolved">Résolu</span></td>
                    <td class="ticket-actions">
                        <button class="btn-icon" onclick="viewTicket('TK006')">
                            <i class="fas fa-eye view-icon"></i>
                        </button>
                        <button class="btn-icon" onclick="editTicket('TK006')">
                            <i class="fas fa-edit edit-icon"></i>
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
</div>

<!-- View Ticket Modal -->
<div id="viewTicketModal" class="modal">
    <div class="modal-content view-ticket">
        <div class="modal-header">
            <h3 class="modal-title">Détails du ticket</h3>
            <div class="modal-actions">
                <button class="btn-icon" onclick="switchToEdit()">
                    <i class="fas fa-edit edit-icon"></i>
                </button>
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

<!-- Edit Ticket Modal -->
<div id="editTicketModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">Modifier le ticket</h3>
            <button class="modal-close" onclick="closeModal('editTicketModal')">&times;</button>
        </div>
        <div class="modal-body">
            <form id="editTicketForm" onsubmit="updateTicket(event)">
                <div class="form-group">
                    <label for="edit-status">Statut:</label>
                    <select id="edit-status" class="form-control" required>
                        <option value="pending">En attente</option>
                        <option value="resolved">Résolu</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="edit-subject">Sujet:</label>
                    <input type="text" id="edit-subject" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="edit-description">Description:</label>
                    <textarea id="edit-description" class="form-control" rows="4" required></textarea>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="edit-client">Client:</label>
                        <input type="text" id="edit-client" class="form-control" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="edit-email">Email:</label>
                        <input type="email" id="edit-email" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-secondary" onclick="closeModal('editTicketModal')">Annuler</button>
                    <button type="submit" class="btn-primary">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
<script src="../assets/js/tickets.js"></script>
</html>