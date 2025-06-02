function applyFilters() {
    const status = document.getElementById('status-filter').value;
    const date = document.getElementById('date-filter').value;

    console.log('Filtering by:', status, date);

    // Construire l'URL avec les paramètres de filtre
    const params = new URLSearchParams();

    if (status) {
        params.append('status', status);
    }

    if (date) {
        params.append('date', date);
    }

    // Rediriger vers la page avec les filtres
    const url = window.location.pathname + (params.toString() ? '?' + params.toString() : '');
    window.location.href = url;
}

function clearFilters() {
    // Rediriger vers la page sans paramètres
    window.location.href = window.location.pathname;
}

// Fonction pour appliquer les filtres automatiquement quand on change les valeurs
function setupAutoFilter() {
    const statusFilter = document.getElementById('status-filter');
    const dateFilter = document.getElementById('date-filter');

    if (statusFilter) {
        statusFilter.addEventListener('change', function() {
            // Optionnel: appliquer automatiquement les filtres
            // applyFilters();
        });
    }

    if (dateFilter) {
        dateFilter.addEventListener('change', function() {
            // Optionnel: appliquer automatiquement les filtres
            // applyFilters();
        });
    }
}

// Initialiser les filtres automatiques au chargement de la page
document.addEventListener('DOMContentLoaded', function() {
    setupAutoFilter();
});

function viewTicket(ticketId) {
    const modal = document.getElementById('viewTicketModal');
    if (modal) {
        console.log('Chargement du ticket:', ticketId); // Debug

        // Charger les données du ticket via AJAX
        fetch(`../system/system_modif_ticket.php?id_ticket=${ticketId}`)
            .then(response => response.json())
            .then(data => {
                console.log('Données reçues pour visualisation:', data); // Debug

                if (data.error) {
                    alert('Erreur: ' + data.error);
                    return;
                }

                // Remplir la modale avec les données du ticket
                document.getElementById('ticket-subject').textContent = data.sujet || 'Sujet non disponible';
                document.getElementById('ticket-status').textContent = data.statut_ticket || 'Statut inconnu';
                document.getElementById('ticket-status').className = `status-badge ${data.statut_ticket === 'En cours' ? 'status-pending' : 'status-resolved'}`;
                document.querySelector('.ticket-id').textContent = `#${data.id_support}`;
                document.getElementById('ticket-description-text').textContent = data.message || 'Aucune description';
                document.getElementById('ticket-client').textContent = data.nom || 'Utilisateur inconnu';
                document.getElementById('ticket-email').textContent = data.gmail || 'Email non disponible';
                document.getElementById('ticket-date').textContent = new Date(data.date_ticket).toLocaleDateString('fr-FR');
                document.getElementById('ticket-update').textContent = new Date(data.date_ticket).toLocaleDateString('fr-FR');

                modal.style.display = 'block';
            })
            .catch(error => {
                console.error('Erreur lors du chargement du ticket:', error);
                alert('Erreur lors du chargement du ticket');
            });
    }
}

function editTicket(ticketId) {
    const modal = document.getElementById('editModal');
    if (modal) {
        console.log('Modification du ticket:', ticketId); // Debug

        // Vider les champs avant de charger
        document.getElementById('editSujet').value = '';
        document.getElementById('editClient').value = '';
        document.getElementById('editProbleme').value = '';
        document.getElementById('editMessage').value = '';
        document.getElementById('editStatut').value = '';
        document.getElementById('editDate').value = '';

        // Charger les données du ticket via AJAX
        fetch(`../system/system_modif_ticket.php?id_ticket=${ticketId}`)
            .then(response => {
                console.log('Réponse HTTP:', response.status); // Debug
                return response.json();
            })
            .then(data => {
                console.log('Données reçues pour modification:', data); // Debug

                if (data.error) {
                    alert('Erreur: ' + data.error);
                    return;
                }

                // Vérifier que les éléments existent avant de les remplir
                const editSujet = document.getElementById('editSujet');
                const editClient = document.getElementById('editClient');
                const editProbleme = document.getElementById('editProbleme');
                const editMessage = document.getElementById('editMessage');
                const editStatut = document.getElementById('editStatut');
                const editDate = document.getElementById('editDate');
                const editForm = document.getElementById('editForm');
                const editTicketId = document.getElementById('editTicketId');

                if (editSujet) editSujet.value = data.sujet || '';
                if (editClient) editClient.value = data.nom || 'Utilisateur inconnu';
                if (editProbleme) editProbleme.value = data.probleme || '';
                if (editMessage) editMessage.value = data.message || '';
                if (editStatut) editStatut.value = data.statut_ticket || '';
                if (editDate) editDate.value = data.date_ticket ? new Date(data.date_ticket).toLocaleDateString('fr-FR') : '';
                if (editForm) editForm.dataset.ticketId = ticketId;
                if (editTicketId) editTicketId.value = ticketId;

                console.log('Formulaire rempli avec:', {
                    sujet: data.sujet,
                    client: data.nom,
                    probleme: data.probleme,
                    statut: data.statut_ticket,
                    date: data.date_ticket
                }); // Debug

                // Vérifier que les champs sont bien remplis
                console.log('Valeurs dans les champs:', {
                    editSujet: editSujet ? editSujet.value : 'Element non trouvé',
                    editClient: editClient ? editClient.value : 'Element non trouvé',
                    editProbleme: editProbleme ? editProbleme.value : 'Element non trouvé',
                    editStatut: editStatut ? editStatut.value : 'Element non trouvé'
                }); // Debug

                modal.style.display = 'block';
            })
            .catch(error => {
                console.error('Erreur lors du chargement du ticket:', error);
                alert('Erreur lors du chargement du ticket: ' + error.message);
            });
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

// Gestion du formulaire d'édition
document.addEventListener('DOMContentLoaded', function() {
    const editForm = document.getElementById('editForm');
    if (editForm) {
        editForm.addEventListener('submit', function(e) {
            e.preventDefault();

            const ticketId = this.dataset.ticketId || document.getElementById('editTicketId').value;
            const sujet = document.getElementById('editSujet').value;
            const probleme = document.getElementById('editProbleme').value;
            const message = document.getElementById('editMessage').value;
            const statut = document.getElementById('editStatut').value;

            if (!ticketId || !statut) {
                alert('Données manquantes pour la modification (ID ticket et statut requis)');
                return;
            }

            console.log('Envoi de la modification:', { ticketId, sujet, probleme, message, statut }); // Debug

            // Envoyer la mise à jour via AJAX
            const formData = new FormData();
            formData.append('id_ticket', ticketId);
            formData.append('sujet', sujet);
            formData.append('probleme', probleme);
            formData.append('message', message);
            formData.append('statut', statut);

            fetch('../system/system_modif_ticket.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                console.log('Réponse du serveur:', data); // Debug

                if (data === 'success') {
                    closeModal('editModal');
                    showMessage('Statut du ticket mis à jour avec succès !');
                    // Recharger la page pour voir les changements
                    setTimeout(() => {
                        window.location.reload();
                    }, 1500);
                } else {
                    alert('Erreur lors de la modification: ' + data);
                }
            })
            .catch(error => {
                console.error('Erreur lors de la modification:', error);
                alert('Erreur lors de la modification du ticket');
            });
        });
    }
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