document.addEventListener('DOMContentLoaded', function() {

    // Helper function for showing error messages
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

    // Function to load product data into the edit modal
    async function loadProductData(id) {
        try {
            const response = await fetch(`../system/system_modif_produit.php?id=${id}`);
            const product = await response.json();

            if (product) {
                document.getElementById('editProductId').value = product.id_produit || '' ;
                document.getElementById('editNom').value = product.nom_produit;
                document.getElementById('editDescription').value = product.description;
                document.getElementById('editImage').src = product.image ? `../assets/images/${product.image}` : '../assets/images/office.png'; // Assuming image path
                document.getElementById('editPrix').value = product.prix;
                document.getElementById('editStock').value = product.quantite_stock;
                document.getElementById('editCategorie').value = product.id_categorie;
                document.getElementById('editPromo').value = product.code_promo ;
                document.getElementById('editPourcentage').value = product.pourcentage;
            } else {
                console.error("No product data received for ID:", id);
                showErrorMessage("Erreur: Produit introuvable.");
            }
        } catch (error) {
            console.error("Error loading product data:", error);
            showErrorMessage("Erreur lors du chargement des données du produit.");
        }
    }


    function openModal(id) {
        const modal = document.getElementById('editModal');
        if (modal) {
            modal.style.display = 'block';
            loadProductData(id); // Load data when opening the edit modal
        } else {
            console.error("editModal not found!");
        }
    }

    function closeModal() {
        const modal = document.getElementById('editModal');
        if (modal) {
            modal.style.display = 'none';
        }
    }

    function openAddModal() {
        const modal = document.getElementById('addModal');
        if (modal) {
            modal.style.display = 'block';
            // Clear previous values in add form
            document.getElementById('addForm').reset();
            document.getElementById('newImagePreview').style.display = 'none'; // Hide image preview
            document.getElementById('newImagePreview').src = '';
        } else {
            console.error("addModal not found!");
        }
    }

    function closeAddModal() {
        const modal = document.getElementById('addModal');
        if (modal) {
            modal.style.display = 'none';
        }
    }

    // Fermer les modales si on clique en dehors
    window.onclick = function(event) {
        const editModal = document.getElementById('editModal');
        if (editModal && event.target === editModal) {
            closeModal();
        }

        const addModal = document.getElementById('addModal');
        if (addModal && event.target === addModal) {
            closeAddModal();
        }
    }

    // Event listener for Edit Form Submission
    const editForm = document.getElementById('editForm');
    if (editForm) {
        editForm.addEventListener('submit', async function(e) {
            e.preventDefault();

            let formData = new FormData(this);

            try {
                const response = await fetch("../system/system_modif_produit.php", {
                    method: "POST",
                    body: formData
                });
                const data = await response.text(); // Or response.json() if your PHP returns JSON

                if (data.includes("success")) {
                    showSuccessMessage("Produit modifiée avec succès !");
                    closeModal();
                    setTimeout(() => {
                        location.reload(); // Reload to reflect changes
                    }, 1500);
                } else {
                    showErrorMessage("Erreur lors de la modification de Produit.");
                    console.error("Server response:", data);
                }
            } catch (error) {
                console.error("Erreur Fetch:", error);
                showErrorMessage("Une erreur inattendue est survenue lors de la modification !");
            }
        });
    } else {
        console.error("editForm not found!");
    }


    // Event listener for Add Form Submission
    const addForm = document.getElementById("addForm");
    if (addForm) {
        addForm.addEventListener("submit", async function(e) {
            e.preventDefault();

            let formData = new FormData(this);

            try {
                const response = await fetch("../system/system_insert_produit.php", {
                    method: "POST",
                    body: formData
                });
                const data = await response.text();

                if (data.includes("success")) {
                    showSuccessMessage("Produit ajoutée avec succès !");
                    closeAddModal();
                    setTimeout(() => {
                        location.reload(); // Reload to show the new product
                    }, 1500);
                } else {
                    showErrorMessage("Erreur lors de l'ajout de Produit.");
                    console.error("Server response:", data);
                }
            } catch (error) {
                console.error("Erreur:", error);
                showErrorMessage("Une erreur inattendue est survenue lors de l'ajout !");
            }
        });
    } else {
        console.error("addForm not found!");
    }

    function deleteProduit(id_produit) {
        if (!confirm("Voulez-vous vraiment supprimer ce produit ?")) {
            return;
        }

        fetch("../system/system_supp_produit.php", { // Removed ?id_produit from URL
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: `id_produit=${id_produit}`
        })
        .then(response => response.text())
        .then(data => {
            if (data.includes("success")) {
                showSuccessMessage("Produit supprimée avec succès !");
                setTimeout(() => {
                    location.reload();
                }, 2000);
            } else {
                showErrorMessage("Erreur lors de la suppression !");
                console.error("Server response:", data);
            }
        })
        .catch(error => {
            console.error("Erreur:", error);
            showErrorMessage("Une erreur inattendue est survenue !");
        });
    }

    // Image preview for Add Product modal
    const addImageInput = document.getElementById('addImage');
    if (addImageInput) {
        addImageInput.addEventListener('change', function(e) {
            if (e.target.files && e.target.files[0]) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    const previewImage = document.getElementById('newImagePreview');
                    if (previewImage) {
                        previewImage.src = event.target.result;
                        previewImage.style.display = 'block'; // Show the preview image
                    }
                };
                reader.readAsDataURL(e.target.files[0]);
            }
        });
    }

    // Image preview for Edit Product modal
    const editImageInput = document.getElementById('editImage');
    if (editImageInput) {
        editImageInput.addEventListener('change', function(e) {
            if (e.target.files && e.target.files[0]) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    const currentImage = document.getElementById('currentImage');
                    if (currentImage) {
                        currentImage.src = event.target.result;
                        currentImage.style.display = 'block'; // Ensure it's visible
                    }
                };
                reader.readAsDataURL(e.target.files[0]);
            }
        });
    }

    // Expose functions to the global scope so they can be called from HTML onclick attributes
    window.openModal = openModal;
    window.closeModal = closeModal;
    window.openAddModal = openAddModal;
    window.closeAddModal = closeAddModal;
    window.deleteProduit = deleteProduit;
    // showSuccessMessage, hideSuccessMessage, showErrorMessage, hideErrorMessage are called internally
    // loadProductData is also called internally by openModal
});