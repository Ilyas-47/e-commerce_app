<?php include '../includes/admin_nav.php'; ?>

<div class="main-content" style="padding: 0;">
    <div class="stats-container">
        <!-- Total Tickets Card -->
        <div class="stat-card total">
            <div class="stat-icon">
                <i class="fas fa-ticket-alt"></i>
            </div>
            <div class="stat-number">150</div>
            <div class="stat-title">Total Tickets</div>
        </div>

        <!-- Resolved Tickets Card -->
        <div class="stat-card resolved">
            <div class="stat-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="stat-number">120</div>
            <div class="stat-title">Tickets Résolus</div>
        </div>

        <!-- Pending Tickets Card -->
        <div class="stat-card pending">
            <div class="stat-icon">
                <i class="fas fa-clock"></i>
            </div>
            <div class="stat-number">30</div>
            <div class="stat-title">Tickets en Attente</div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="card" style="width: 100%; margin: 0;">
        <div class="card-header">
            <div class="card-title">Liste des tickets</div>
        </div>
        <div class="filter-bar" style="width: 100%; padding: 20px;">
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

        <div class="details-card" style="padding: 0; margin: 0;">
            <table class="orders-table" style="width: 100%;">
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
                        <td><span class="status-badge status-resolved">Résolu</span></td>
                        <td class="ticket-actions">
                            <button class="btn-icon" onclick="viewTicket('TK002')">
                                <i class="fas fa-eye view-icon"></i>
                            </button>
                            <button class="btn-icon" onclick="editTicket('TK002')">
                                <i class="fas fa-edit edit-icon"></i>
                            </button>
                        </td>
                    </tr>
                    <!-- More rows as needed -->
                </tbody>
            </table>
        </div>

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
    <div class="modal-content">
        <!-- Ticket details go here -->
    </div>
</div>
