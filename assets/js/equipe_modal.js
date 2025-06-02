// Fonction pour ouvrir la modal d'ajout
function openAddModal() {
    // Vérifier si l'utilisateur est chef administratif
    if (!isChefAdministratif) {
        showErrorMessage("Accès refusé ! Seuls les chefs administratifs peuvent gérer l'équipe.");
        return;
    }

    const modal = document.getElementById('addModal');
    if (modal) {
        modal.style.display = 'block';
        // Réinitialiser le formulaire
        document.getElementById('addForm').reset();
    } else {
        console.error("addModal not found!");
    }
}

// Fonction pour fermer la modal d'ajout
function closeAddModal() {
    document.getElementById('addModal').style.display = 'none';
    // Réinitialiser le formulaire
    document.getElementById('addForm').reset();
}

// Fonction pour ouvrir la modal de modification
function openModal(userId) {
    // Vérifier si l'utilisateur est chef administratif
    if (!isChefAdministratif) {
        showErrorMessage("Accès refusé ! Seuls les chefs administratifs peuvent gérer l'équipe.");
        return;
    }

    const modal = document.getElementById('editModal');
    if (modal) {
        modal.style.display = 'block';
        loadUserData(userId);
    } else {
        console.error("editModal not found!");
    }
}

// Fonction pour fermer la modal de modification
function closeModal() {
    document.getElementById('editModal').style.display = 'none';
    // Réinitialiser le formulaire
    document.getElementById('editForm').reset();
}

// Alias pour la compatibilité
function closeEditModal() {
    closeModal();
}

// Fonction pour charger les données de l'utilisateur
async function loadUserData(userId) {
    try {
        const response = await fetch(`../system/system_modif_equipe.php?id_user=${userId}`);
        const user = await response.json();

        if (user && !user.error) {
            // Remplir les champs de la modal de modification
            document.getElementById('editUserId').value = user.id_user || '';
            document.getElementById('editName').value = user.nom || '';
            document.getElementById('editEmail').value = user.gmail || '';
            document.getElementById('editPhone').value = user.telephone || '';
            document.getElementById('editRole').value = user.role || '';
        } else {
            console.error("No user data received for ID:", userId);
            if (user && user.error) {
                showErrorMessage("Erreur: " + user.error);
            } else {
                showErrorMessage("Erreur: Utilisateur introuvable.");
            }
        }
    } catch (error) {
        console.error("Error loading user data:", error);
        showErrorMessage("Erreur lors du chargement des données utilisateur.");
    }
}

// Fonction pour supprimer un utilisateur
function deleteUser(userId) {
    // Vérifier si l'utilisateur est chef administratif
    if (!isChefAdministratif) {
        showErrorMessage("Accès refusé ! Seuls les chefs administratifs peuvent gérer l'équipe.");
        return;
    }

    if (!confirm("Voulez-vous vraiment supprimer cet utilisateur ?")) {
        return;
    }

    fetch("../system/system_supp_user.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: `id_user=${userId}`
    })
    .then(response => response.text())
    .then(data => {
        console.log("Server response:", data); // Debug: afficher la réponse du serveur
        const response = data.trim();

        if (response === "success") {
            showSuccessMessage("Utilisateur supprimé avec succès !");
            setTimeout(() => {
                location.reload();
            }, 2000);
        } else {
            console.error("Unexpected server response:", response); // Debug: afficher la réponse inattendue

            // Gérer les différents types d'erreurs
            let errorMessage = "Erreur lors de la suppression !";
            switch(response) {
                case "error_access_denied":
                    errorMessage = "Accès refusé ! Seuls les chefs administratifs peuvent gérer l'équipe.";
                    break;
                case "error_invalid_id":
                    errorMessage = "ID utilisateur invalide !";
                    break;
                case "error_user_not_found":
                    errorMessage = "Utilisateur introuvable !";
                    break;
                case "error_has_orders":
                    errorMessage = "Impossible de supprimer cet utilisateur car il a des commandes associées !";
                    break;
                case "error_sql":
                    errorMessage = "Erreur de base de données lors de la suppression !";
                    break;
                case "error_exception":
                    errorMessage = "Une erreur technique est survenue !";
                    break;
                case "error_method":
                    errorMessage = "Méthode de requête invalide !";
                    break;
                default:
                    errorMessage = "Erreur inconnue : " + response;
            }

            showErrorMessage(errorMessage);
        }
    })
    .catch(error => {
        console.error("Error:", error);
        showErrorMessage("Une erreur inattendue est survenue !");
    });
}

// Fonction pour afficher les messages de succès
function showSuccessMessage(message) {
    let successMessage = document.getElementById("successMessage");
    let successText = document.getElementById("successText");

    if (!successMessage || !successText) {
        console.error("L'élément successMessage ou successText n'existe pas !");
        return;
    }

    successText.textContent = message;
    successMessage.style.display = "block";

    setTimeout(() => {
        successMessage.classList.add("show");
    }, 10);

    setTimeout(() => {
        hideSuccessMessage();
    }, 5000);
}

function hideSuccessMessage() {
    let successMessage = document.getElementById("successMessage");
    if (!successMessage) {
        return;
    }
    successMessage.classList.remove("show");
    setTimeout(() => {
        successMessage.style.display = "none";
    }, 300);
}

// Fonction pour afficher les messages d'erreur
function showErrorMessage(message) {
    let errorMessage = document.getElementById("erreurMessage");
    let errorText = document.getElementById("erreurText");

    if (!errorMessage || !errorText) {
        console.error("L'élément erreurMessage ou erreurText n'existe pas !");
        return;
    }

    errorText.textContent = message;
    errorMessage.style.display = "block";

    setTimeout(() => {
        errorMessage.classList.add("show");
    }, 10);

    setTimeout(() => {
        hideErrorMessage();
    }, 5000);
}

function hideErrorMessage() {
    let errorMessage = document.getElementById("erreurMessage");
    if (!errorMessage) {
        return;
    }
    errorMessage.classList.remove("show");
    setTimeout(() => {
        errorMessage.style.display = "none";
    }, 300);
}

// Gestion de la soumission des formulaires
document.addEventListener('DOMContentLoaded', function() {
    // Formulaire d'ajout
    const addForm = document.getElementById('addForm');
    if (addForm) {
        addForm.addEventListener('submit', function(e) {
            e.preventDefault();

            // Vérifier si l'utilisateur est chef administratif
            if (!isChefAdministratif) {
                showErrorMessage("Accès refusé ! Seuls les chefs administratifs peuvent gérer l'équipe.");
                return;
            }

            const email = document.getElementById('addEmail').value;
            const role = document.getElementById('addRole').value;
            addUser(email, role);
        });
    }

    // Formulaire de modification
    const editForm = document.getElementById('editForm');
    if (editForm) {
        editForm.addEventListener('submit', function(e) {
            e.preventDefault();

            // Vérifier si l'utilisateur est chef administratif
            if (!isChefAdministratif) {
                showErrorMessage("Accès refusé ! Seuls les chefs administratifs peuvent gérer l'équipe.");
                return;
            }

            const userId = document.getElementById('editUserId').value;
            const name = document.getElementById('editName').value;
            const email = document.getElementById('editEmail').value;
            const phone = document.getElementById('editPhone').value;
            const role = document.getElementById('editRole').value;
            modifyUser(userId, name, email, phone, role);
        });
    }
});

// Fonction pour ajouter un utilisateur
async function addUser(email, role) {
    try {
        const response = await fetch('../system/system_insert_equipe.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `email=${encodeURIComponent(email)}&role=${encodeURIComponent(role)}`
        });

        const result = await response.text();

        if (result.trim() === 'success') {
            showSuccessMessage('Membre ajouté avec succès !');
            closeAddModal();
            setTimeout(() => {
                location.reload();
            }, 2000);
        } else {
            let errorMessage = "Erreur lors de l'ajout !";
            switch(result.trim()) {
                case "error_access_denied":
                    errorMessage = "Accès refusé ! Seuls les chefs administratifs peuvent gérer l'équipe.";
                    break;
                case "error_update":
                    errorMessage = "Erreur lors de la mise à jour du rôle !";
                    break;
                case "error_insert":
                    errorMessage = "Erreur lors de la création du compte !";
                    break;
                case "error_exception":
                    errorMessage = "Une erreur technique est survenue !";
                    break;
                case "error_method":
                    errorMessage = "Méthode de requête invalide !";
                    break;
                default:
                    errorMessage = "Erreur inconnue : " + result;
            }
            showErrorMessage(errorMessage);
        }
    } catch (error) {
        console.error('Error:', error);
        showErrorMessage('Une erreur inattendue est survenue !');
    }
}

// Fonction pour modifier un utilisateur
async function modifyUser(userId, name, email, phone, role) {
    try {
        const response = await fetch('../system/system_modif_equipe.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `id_user=${encodeURIComponent(userId)}&nom=${encodeURIComponent(name)}&gmail=${encodeURIComponent(email)}&telephone=${encodeURIComponent(phone)}&role=${encodeURIComponent(role)}`
        });

        const result = await response.text();

        if (result.trim() === 'success') {
            showSuccessMessage('Membre modifié avec succès !');
            closeEditModal();
            setTimeout(() => {
                location.reload();
            }, 2000);
        } else {
            let errorMessage = "Erreur lors de la modification !";
            switch(result.trim()) {
                case "error_not_found":
                    errorMessage = "Utilisateur introuvable !";
                    break;
                case "error_email_exists":
                    errorMessage = "Cette adresse email est déjà utilisée !";
                    break;
                default:
                    errorMessage = "Erreur inconnue : " + result;
            }
            showErrorMessage(errorMessage);
        }
    } catch (error) {
        console.error('Error:', error);
        showErrorMessage('Une erreur inattendue est survenue !');
    }
}

// Fermer les modales en cliquant à l'extérieur
window.onclick = function(event) {
    const addModal = document.getElementById('addModal');
    const editModal = document.getElementById('editModal');

    if (event.target === addModal) {
        closeAddModal();
    }
    if (event.target === editModal) {
        closeEditModal();
    }
}