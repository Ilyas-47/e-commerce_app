function generateReport() {
    document.getElementById('reportModal').style.display = 'block';
}

function closeModal() {
    document.getElementById('reportModal').style.display = 'none';
}

function downloadReport(id) {
    showSuccessMessage('Téléchargement du rapport...');
}

function deleteReport(id) {
    if(confirm('Êtes-vous sûr de vouloir supprimer ce rapport ?')) {
        showSuccessMessage('Rapport supprimé avec succès !');
    }
}

function showSuccessMessage(message) {
    const messageElement = document.getElementById('successMessage');
    messageElement.textContent = message;
    messageElement.style.display = 'block';
    setTimeout(() => {
        messageElement.style.display = 'none';
    }, 3000);
}

document.getElementById('reportForm').onsubmit = function(e) {
    // Vérifier que les champs sont remplis
    const rapport = this.querySelector('select[name="rapport"]').value;
    const periode = this.querySelector('select[name="periode"]').value;

    if (!rapport || !periode) {
        e.preventDefault();
        alert('Veuillez sélectionner un type de rapport et une période.');
        return false;
    }

    // Laisser le formulaire se soumettre normalement pour télécharger le fichier Excel
    closeModal();
    showSuccessMessage('Génération du rapport Excel en cours...');

    // Recharger la liste des téléchargements après un délai
    setTimeout(() => {
        loadDownloads();
    }, 2000);

    // Le téléchargement se fera automatiquement
    return true;
};


// Charger les téléchargements au chargement de la page
document.addEventListener('DOMContentLoaded', function() {
    loadDownloads();
});

function loadDownloads() {
    fetch('../system/manage_downloads.php?action=list')
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            // Vérifier si le serveur a retourné une erreur
            if (data.error) {
                throw new Error(data.error);
            }

            displayDownloads(data);
        })
        .catch(error => {
            console.error('Erreur lors du chargement des téléchargements:', error);
            const container = document.getElementById('downloads-list');
            if (container) {
                container.innerHTML = `
                    <tr>
                        <td colspan="4" class="text-center">
                            <div class="alert alert-danger">
                                Erreur lors du chargement des fichiers: ${error.message}
                            </div>
                        </td>
                    </tr>
                `;
            }
        });
}

function displayDownloads(files) {
    const container = document.getElementById('downloads-list');
    if (!container) return;

    if (files.length === 0) {
        container.innerHTML = `
            <tr>
                <td colspan="4" class="text-center">
                    <div class="alert alert-info">Aucun rapport généré pour le moment</div>
                </td>
            </tr>
        `;
        return;
    }

    let html = '';

    files.forEach(file => {
        html += `
            <tr>
                <td style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 300px;">
                    <i class="fas fa-file-excel text-success"></i>
                    <span title="${file.name}">${file.name}</span>
                </td>
                <td>${file.date}</td>
                <td>${getPeriodFromFilename(file.name)}</td>
                <td>
                    <button class="btn-icon" onclick="downloadFile('${file.name}')" title="Télécharger">
                        <i class="fas fa-download"></i>
                    </button>
                    <button class="btn-delete" onclick="deleteFile('${file.name}')" title="Supprimer">
                        <i class="fas fa-trash"></i>
                    </button>
                </td>
            </tr>
        `;
    });

    container.innerHTML = html;
}

function getPeriodFromFilename(filename) {
    if (filename.includes('Ce_mois') || filename.includes('this_month')) {
        return 'Ce mois';
    } else if (filename.includes('Mois_dernier') || filename.includes('last_month')) {
        return 'Mois dernier';
    } else if (filename.includes('cette_annee') || filename.includes('this_year')) {
        return 'Cette année';
    } else {
        return 'Période inconnue';
    }
}

function downloadFile(filename) {
    window.location.href = `../system/manage_downloads.php?action=download&file=${encodeURIComponent(filename)}`;
}

function deleteFile(filename) {
    if (confirm(`Êtes-vous sûr de vouloir supprimer le fichier "${filename}" ?`)) {
        fetch(`../system/manage_downloads.php?action=delete&file=${encodeURIComponent(filename)}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showSuccessMessage('Fichier supprimé avec succès');
                    loadDownloads(); // Recharger la liste
                } else {
                    alert('Erreur: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Erreur lors de la suppression:', error);
                alert('Erreur lors de la suppression du fichier');
            });
    }
}

