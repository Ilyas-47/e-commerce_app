<?php
// Démarrer la session seulement si elle n'est pas déjà active
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: ../user/login.php");
    exit();
}

require_once('../connection/connection.php');

// Récupérer les tickets de l'utilisateur connecté
try {
    $req = $pdo->prepare("
        SELECT id_support, sujet, probleme, message, statut_ticket, date_ticket
        FROM support
        WHERE id_user = :id_user
        ORDER BY date_ticket DESC
    ");
    $req->bindParam(':id_user', $_SESSION['user_id'], PDO::PARAM_INT);
    $req->execute();
    $tickets = $req->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    error_log("Erreur lors de la récupération des tickets: " . $e->getMessage());
    $tickets = [];
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/user_support.css">
</head>
<body>
    <?php include("../includes/nav.php") ?>
    <main>
        <div class="supp-container">
            <div class="supp-grid"> 
                <?php include('user_nav.php'); ?>
                
                <div class="supp-content">
                    <div class="supp-header">
                        <h1><i class="fas fa-life-ring"></i> Support & Assistance</h1>
                    </div>

                    <div class="supp-form">
                        <h2>Ouvrir un nouveau ticket</h2>
                        <form id="ticket-form" action="../system_user/system_insert_support.php" method="POST">
                            <input type="hidden" name="id_user" value="<?php echo $_SESSION['user_id']; ?>">

                            <div class="supp-form-group">
                                <label for="sujet">Sujet</label>
                                <input type="text" id="sujet" name="sujet" class="supp-form-control" required placeholder="Résumez votre problème">
                            </div>

                            <div class="supp-form-group">
                                <label for="probleme">Problème</label>
                                <select id="probleme" name="probleme" class="supp-form-control" required>
                                    <option value="">Sélectionnez un type de problème</option>
                                    <option value="Problème technique">Problème technique</option>
                                    <option value="Facturation">Facturation</option>
                                    <option value="Compte utilisateur">Compte utilisateur</option>
                                    <option value="Commande">Commande</option>
                                    <option value="Produit">Produit</option>
                                    <option value="Autre">Autre</option>
                                </select>
                            </div>

                            <div class="supp-form-group">
                                <label for="message">Message</label>
                                <textarea id="message" name="message" class="supp-form-control" rows="5" required placeholder="Décrivez votre problème en détail"></textarea>
                            </div>

                            <button type="submit" class="supp-btn">Envoyer le ticket</button>
                        </form>
                    </div>
                    <div class="ticket-history">
                        <h2>Historique de mes tickets</h2>
                        
                        <?php if (!empty($tickets)): ?>
                            <?php foreach ($tickets as $ticket): ?>
                                <div class="ticket-item">
                                    <div class="ticket-info">
                                        <h3><?php echo htmlspecialchars($ticket['sujet']); ?></h3>
                                        <p>Créé le <?php echo date('d/m/Y à H:i', strtotime($ticket['date_ticket'])); ?></p>
                                    </div>
                                    <span class="order-status <?php echo strtolower($ticket['statut_ticket']) === 'résolu' ? 'status-completed' : 'status-pending'; ?>">
                                        <?php echo htmlspecialchars($ticket['statut_ticket']); ?>
                                    </span>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="no-tickets">
                                <p>Aucun ticket trouvé</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php include("../includes/footer.php")?>

    <script>
        // Gestion de la soumission du formulaire
        document.getElementById('ticket-form').addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);

            // Afficher un message de traitement
            showToast('⏳ Envoi du ticket en cours...', 'info');

            fetch('../system_user/system_insert_support.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                if (data === 'success') {
                    showToast('✅ Ticket créé avec succès !', 'success');
                    // Réinitialiser le formulaire
                    this.reset();
                    // Recharger la page après 2 secondes pour afficher le nouveau ticket
                    setTimeout(() => {
                        window.location.reload();
                    }, 2000);
                } else if (data === 'error_validation') {
                    showToast('❌ Veuillez remplir tous les champs obligatoires', 'error');
                } else if (data === 'error_sujet_trop_long') {
                    showToast('❌ Le sujet est trop long (maximum 255 caractères)', 'error');
                } else if (data === 'error_message_trop_long') {
                    showToast('❌ Le message est trop long (maximum 1000 caractères)', 'error');
                } else if (data === 'error_unauthorized') {
                    showToast('❌ Vous n\'êtes pas autorisé à effectuer cette action', 'error');
                } else if (data === 'error_not_authenticated') {
                    showToast('❌ Vous devez être connecté pour créer un ticket', 'error');
                    setTimeout(() => {
                        window.location.href = '../user/login.php';
                    }, 2000);
                } else {
                    showToast('❌ Une erreur est survenue lors de la création du ticket', 'error');
                }
            })
            .catch(error => {
                console.error('Erreur:', error);
                showToast('❌ Une erreur de connexion est survenue', 'error');
            });
        });

        // Fonction pour afficher les toasts
        function showToast(message, type = 'info') {
            const toast = document.createElement('div');
            toast.className = `toast toast-${type}`;

            let icon = 'fa-info-circle';
            if (type === 'success') icon = 'fa-check-circle';
            else if (type === 'error') icon = 'fa-exclamation-circle';
            else if (type === 'warning') icon = 'fa-exclamation-triangle';

            toast.innerHTML = `
                <div class="toast-content">
                    <i class="fas ${icon} toast-icon"></i>
                    <span>${message}</span>
                </div>
                <button class="toast-close">
                    <i class="fas fa-times"></i>
                </button>
            `;

            document.body.appendChild(toast);

            // Animation d'entrée
            setTimeout(() => {
                toast.style.transform = 'translateX(0)';
                toast.style.opacity = '1';
            }, 100);

            // Durée d'affichage
            const duration = type === 'success' ? 4000 : 3000;
            setTimeout(() => {
                toast.style.transform = 'translateX(100%)';
                toast.style.opacity = '0';
                setTimeout(() => {
                    if (toast.parentNode) {
                        toast.remove();
                    }
                }, 300);
            }, duration);

            // Fermeture manuelle
            toast.querySelector('.toast-close').addEventListener('click', () => {
                toast.style.transform = 'translateX(100%)';
                toast.style.opacity = '0';
                setTimeout(() => {
                    if (toast.parentNode) {
                        toast.remove();
                    }
                }, 300);
            });
        }
    </script>
</body>
</html>