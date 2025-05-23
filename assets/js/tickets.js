function applyFilters() {
    const status = document.getElementById('status-filter').value;
    const date = document.getElementById('date-filter').value;
    console.log('Filtering by:', status, date);
    // TODO: Implement AJAX call to filter tickets
}

function viewTicket(ticketId) {
    const modal = document.getElementById('viewTicketModal');
    if (modal) {
        modal.style.display = 'block';
        // TODO: Load ticket details via AJAX
        console.log('Loading ticket:', ticketId);
    }
}

function editTicket(ticketId) {
    const modal = document.getElementById('editModal');
    if (modal) {
        modal.style.display = 'block';
        // Simuler le chargement des données du ticket
        document.getElementById('editSujet').value = 'Problème avec la livraison';
        document.getElementById('editClient').value = 'Jean Martin';
        document.getElementById('editMessage').value = 'Description du problème...';
        document.getElementById('editStatut').value = 'pending';
        document.getElementById('editDate').value = '20/05/2025';
        // TODO: Load real ticket data via AJAX
    }
}

function closeModal(modalId) {
    const modal = document.getElementById(modalId || 'editModal');
    if (modal) {
        modal.style.display = 'none';
    }
}

// Gestionnaire global des clics pour fermer les modaux
document.addEventListener('click', function(event) {
    const modals = document.querySelectorAll('.modal');
    modals.forEach(modal => {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });
});

// Amélioration de la gestion du formulaire d'édition
document.getElementById('editForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const ticketData = {
        id: this.dataset.ticketId,
        statut: document.getElementById('editStatut').value
    };
    
    console.log('Updating ticket status:', ticketData);
    // TODO: Send status update via AJAX
    
    closeModal('editModal');
    showMessage('Statut du ticket mis à jour avec succès !');
});

// Fonction utilitaire pour afficher les messages
function showMessage(text, duration = 3000) {
    const messageEl = document.getElementById('successMessage') || createMessageElement();
    messageEl.textContent = text;
    messageEl.style.display = 'block';
    
    setTimeout(() => {
        messageEl.style.display = 'none';
    }, duration);
}

// Créer l'élément de message s'il n'existe pas
function createMessageElement() {
    const messageEl = document.createElement('div');
    messageEl.id = 'successMessage';
    messageEl.className = 'success-message';
    document.body.appendChild(messageEl);
    return messageEl;
}

// Gestion de la prévisualisation des images
document.getElementById('editImage')?.addEventListener('change', function(e) {
    const previewImage = document.getElementById('currentImage');
    if (this.files && this.files[0] && previewImage) {
        const reader = new FileReader();
        reader.onload = function(e) {
            previewImage.src = e.target.result;
        };
        reader.readAsDataURL(this.files[0]);
    }
});