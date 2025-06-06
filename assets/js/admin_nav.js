// Fonction pour effacer la recherche
function clearSearch() {
    const url = new URL(window.location);
    url.searchParams.delete('query');
    window.location.href = url.toString();
}

// Fonction pour naviguer vers un résultat
function goToResult(type, id, userRole = null) {
    let url = '';
    switch(type) {
        case 'produit':
            url = '../admin/produit.php';
            break;
        case 'commande':
            url = '../admin/commandes.php';
            break;
        case 'user':
            // Vérifier le rôle de l'utilisateur pour déterminer la page de destination
            if (userRole === 'user') {
                url = '../admin/user.php';
            } else if (userRole === 'admin' || userRole === 'chef administratif') {
                url = '../admin/equipe.php';
            } else {
                // Par défaut, aller à la page des utilisateurs
                url = '../admin/user.php';
            }
            break;
        case 'support':
            url = '../admin/tickets.php';
            break;
        default:
            return;
    }
    window.location.href = url;
}

// Fermer les résultats de recherche en cliquant à l'extérieur
document.addEventListener('click', function(event) {
    const searchResults = document.querySelector('.search-results');
    const searchBar = document.querySelector('.search-bar');

    if (searchResults && !searchBar.contains(event.target)) {
        // Ne pas fermer automatiquement pour permettre la navigation
    }
});

// Améliorer l'expérience de recherche avec Enter
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.querySelector('.search-input');
    if (searchInput) {
        searchInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                this.closest('form').submit();
            }
        });
    }
});