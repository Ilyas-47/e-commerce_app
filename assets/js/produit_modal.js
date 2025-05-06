function openModal(id) {
    const modal = document.getElementById('editModal');
    modal.style.display = 'block';
    // Ici vous pouvez ajouter la logique pour charger les données existantes
    // Afficher l'image actuelle
    document.getElementById('currentImage').src = '../assets/images/netflix.png';
}

function closeModal() {
    const modal = document.getElementById('editModal');
    modal.style.display = 'none';
}

// Fermer le modal si on clique en dehors
window.onclick = function(event) {
    const modal = document.getElementById('editModal');
    if (event.target == modal) {
        modal.style.display = 'none';
    }
}

document.getElementById('editForm').onsubmit = function(e) {
    e.preventDefault();
    // Fermer le modal
    closeModal();
    // Ici votre logique de sauvegarde
    
    // Afficher le message
    const message = document.getElementById('successMessage');
    message.style.display = 'block';
    
    // Masquer le message après 3 secondes
    setTimeout(() => {
        message.style.display = 'none';
    }, 3000);
};

function openAddModal() {
    const modal = document.getElementById('addModal');
    modal.style.display = 'block';
}

function closeAddModal() {
    const modal = document.getElementById('addModal');
    modal.style.display = 'none';
}

// Preview de l'image pour l'ajout
document.getElementById('addImage').onchange = function(e) {
    if (e.target.files && e.target.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('newImage').src = e.target.result;
        };
        reader.readAsDataURL(e.target.files[0]);
    }
};

document.getElementById('addForm').onsubmit = function(e) {
    e.preventDefault();
    // Fermer le modal
    closeAddModal();
    
    // Ici votre logique d'ajout
    
    // Afficher le message
    const message = document.getElementById('successMessage');
    message.textContent = 'Produit ajouté avec succès !';
    message.style.display = 'block';
    
    // Masquer le message après 3 secondes
    setTimeout(() => {
        message.style.display = 'none';
    }, 5000);
}; 