// document.addEventListener("DOMContentLoaded", function() {
//             let addForm = document.getElementById("addForm");

//             if (addForm) {
//                 addForm.addEventListener("submit", function(e) {
//                     let categoryName = document.getElementById("categoryName").value.trim();

//                     if (categoryName === "") {
//                         e.preventDefault();
//                         alert("Veuillez entrer un nom de catégorie.");
//                         return;
//                     }

//                     // Si vous voulez tester sans soumettre réellement le formulaire
//                     e.preventDefault(); // Retirez cette ligne en production

//                     closeAddModal();
//                     showSuccessMessage("Catégorie ajoutée avec succès !");
//                 });
//             }
//         });

function openAddModal() {
    document.getElementById("addModal").style.display = "block";
}

function closeAddModal() {
    document.getElementById("addModal").style.display = "none";
    // Réinitialiser le formulaire
    document.getElementById("addForm").reset();
}

function showSuccessMessage(message) {
    let successMessage = document.getElementById("successMessage");
    let successText = document.getElementById("successText");

    if (!successMessage || !successText) {
        console.error("L'élément successMessage ou messageText n'existe pas !");
        return;
    }

    successText.textContent = message;
    successMessage.style.display = "block";

    // Ajouter la classe pour l'animation
    setTimeout(() => {
        successMessage.classList.add("show");
    }, 10);

    // Masquer automatiquement après 5 secondes
    setTimeout(() => {
        hideSuccessMessage();
    }, 5000);
}

function hideSuccessMessage() {
    let successMessage = document.getElementById("successMessage");

    // Animation de sortie
    successMessage.classList.remove("show");

    // Masquer complètement après l'animation
    setTimeout(() => {
        successMessage.style.display = "none";
    }, 300);
}

function showErrorMessage(message) {
    let errorMessage = document.getElementById("erreurMessage");
    let errorText = document.getElementById("erreurText");

    if (!errorMessage || !errorText) {
        console.error("L'élément erreurMessage ou erreurText n'existe pas !");
        return;
    }

    errorText.textContent = message;
    errorMessage.style.display = "block";

    // Ajouter la classe pour l'animation
    setTimeout(() => {
        errorMessage.classList.add("show");
    }, 10);

    // Masquer automatiquement après 5 secondes
    setTimeout(() => {
        hideErrorMessage();
    }, 5000);
}

function hideErrorMessage() {
    let errorMessage = document.getElementById("erreurMessage");
    if (!errorMessage) {
        return;
    }

    // Animation de sortie
    errorMessage.classList.remove("show");

    // Masquer complètement après l'animation
    setTimeout(() => {
        errorMessage.style.display = "none";
    }, 300);
}

// Fermer le modal en cliquant à l'extérieur
window.onclick = function(event) {
    let modal = document.getElementById("addModal");
    if (event.target === modal) {
        closeAddModal();
    }
}

// Event listener pour le formulaire d'ajout
document.addEventListener("DOMContentLoaded", function() {
    const addForm = document.getElementById("addForm");
    if (addForm) {
        addForm.addEventListener("submit", function(e) {
            e.preventDefault();

            let formData = new FormData(this);

            fetch("../system/system_insert_catego.php", {
                method: "POST",
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                if (data.includes("success")) {
                    showSuccessMessage("Catégorie ajoutée avec succès !");
                    closeAddModal();
                } else {
                    showErrorMessage("Erreur lors de l'ajout de la catégorie.");
                }
            })
            .catch(error => {
                console.error("Erreur:", error);
                showErrorMessage("Une erreur inattendue est survenue !");
            });
        });
    }
});

function deleteCategory(categoryId) {
    // Première vérification pour informer l'utilisateur
    fetch("../system/system_supp_catego.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: `id_categorie=${categoryId}&check_only=1`
    })
    .then(response => response.text())
    .then(data => {
        if (data.includes("error_has_products")) {
            // Extraire le nombre de produits
            const parts = data.split(":");
            const productCount = parts.length > 1 ? parts[1] : "plusieurs";
            const productText = productCount === "1" ? "produit" : "produits";

            showErrorMessage(`Cette catégorie contient ${productCount} ${productText}. Impossible de la supprimer.`);
            return;
        }

        // Si pas de produits, demander confirmation
        if (!confirm("Voulez-vous vraiment supprimer cette catégorie ?")) {
            return;
        }

        // Procéder à la suppression
        performCategoryDeletion(categoryId);
    })
    .catch(error => {
        console.error("Erreur lors de la vérification:", error);
        // En cas d'erreur de vérification, procéder quand même avec la méthode classique
        if (!confirm("Voulez-vous vraiment supprimer cette catégorie ?")) {
            return;
        }
        performCategoryDeletion(categoryId);
    });
}

function performCategoryDeletion(categoryId) {
    fetch("../system/system_supp_catego.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: `id_categorie=${categoryId}`
    })
    .then(response => response.text())
    .then(data => {
        if (data.includes("success")) {
            showSuccessMessage("Catégorie supprimée avec succès !");
            setTimeout(() => {
                location.reload();
            }, 2000);
        } else if (data.includes("error_has_products")) {
            // Extraire le nombre de produits de la réponse
            const parts = data.split(":");
            const productCount = parts.length > 1 ? parts[1] : "plusieurs";
            const productText = productCount === "1" ? "produit" : "produits";

            showErrorMessage(`Impossible de supprimer cette catégorie car elle contient ${productCount} ${productText}. Veuillez d'abord supprimer ou déplacer les produits de cette catégorie.`);
        } else {
            showErrorMessage("Erreur lors de la suppression !");
        }
    })
    .catch(error => showErrorMessage("Une erreur inattendue est survenue !"));
}

// Test function to verify that functions are accessible
function testFunctions() {
    console.log("Testing functions...");
    console.log("showErrorMessage:", typeof showErrorMessage);
    console.log("showSuccessMessage:", typeof showSuccessMessage);
    console.log("deleteCategory:", typeof deleteCategory);
}
