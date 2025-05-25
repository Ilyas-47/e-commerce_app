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

        // Fermer le modal en cliquant à l'extérieur
        window.onclick = function(event) {
            let modal = document.getElementById("addModal");
            if (event.target === modal) {
                closeAddModal();
            }
        }

        document.getElementById("addForm").addEventListener("submit", function(e) {
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
            alert("Erreur lors de l'ajout de la catégorie.");
        }
    })
    .catch(error => console.error("Erreur:", error));
});

function deleteCategory(categoryId) {
    if (!confirm("Voulez-vous vraiment supprimer cette catégorie ?")) {
        return;
    }

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
        } else {
            showErrorMessage("Erreur lors de la suppression !");
        }
    })
    .catch(error => showErrorMessage("Une erreur inattendue est survenue !"));
}
