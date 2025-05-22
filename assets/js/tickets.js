function applyFilters() {
    const status = document.getElementById('status-filter').value;
    const date = document.getElementById('date-filter').value;
    // Implement filter logic here
}

function viewTicket(ticketId) {
    const modal = document.getElementById('viewTicketModal');
    modal.style.display = 'block';
    // Add logic to populate modal with ticket details
}

function editTicket(ticketId) {
    // Implement edit logic
}

function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    modal.style.display = 'none';
}
