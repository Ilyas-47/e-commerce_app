// Fonction pour ouvrir la modal et charger les données de l'utilisateur
function openModal(userId) {
    const modal = document.getElementById('editModal');
    if (modal) {
        modal.style.display = 'block';
        loadUserData(userId);
    } else {
        console.error("editModal not found!");
    }
}

// Fonction pour fermer la modal
function closeModal() {
    document.getElementById('editModal').style.display = 'none';
    // Réinitialiser le formulaire
    document.getElementById('editForm').reset();
}

// Fonction pour charger les données de l'utilisateur
async function loadUserData(userId) {
    try {
        const response = await fetch(`../system/system_modif_user.php?id_user=${userId}`);
        const user = await response.json();

        if (user && !user.error) {
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

// Gestion de la soumission du formulaire
document.addEventListener('DOMContentLoaded', function() {
    const editForm = document.getElementById('editForm');
    if (editForm) {
        editForm.addEventListener('submit', async function(e) {
            e.preventDefault();

            const formData = new FormData(this);

            try {
                const response = await fetch('../system/system_modif_user.php', {
                    method: "POST",
                    body: formData
                });

                const data = await response.text();

                if (data.includes("success")) {
                    showSuccessMessage("Utilisateur modifié avec succès !");
                    closeModal();
                    setTimeout(() => {
                        location.reload();
                    }, 1500);
                } else {
                    showErrorMessage("Erreur lors de la modification de l'utilisateur.");
                    console.error("Server response:", data);
                }
            } catch (error) {
                console.error("Error:", error);
                showErrorMessage("Une erreur inattendue est survenue !");
            }
        });
    }
});

// Fermer la modal en cliquant à l'extérieur
window.onclick = function(event) {
    const modal = document.getElementById('editModal');
    if (event.target === modal) {
        closeModal();
    }
}