function openModal(id) {
    document.getElementById('editModal').style.display = 'block';
}

function closeModal() {
    document.getElementById('editModal').style.display = 'none';
}

function showSuccessMessage(message) {
    const messageElement = document.getElementById('successMessage');
    messageElement.textContent = message;
    messageElement.style.display = 'block';
    setTimeout(() => {
        messageElement.style.display = 'none';
    }, 3000);
}

document.getElementById('editForm').onsubmit = function(e) {
    e.preventDefault();
    closeModal();
    showSuccessMessage('Utilisateur modifié avec succès !');
};