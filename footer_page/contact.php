<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact - Notre Marketplace Digitale</title>
    <style>
        body {
            font-family: 'Exo', sans-serif;
            margin: 0;
            padding: 0;
        }

        .contact-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .contact-header {
            text-align: center;
            margin: 40px 0;
        }

        .contact-header h1 {
            color: #000;
            font-size: 28px;
            font-weight: bold;
        }

        .contact-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            margin: 40px 0;
        }

        .contact-info {
            padding: 20px;
        }

        .contact-info h2 {
            color: #000;
            margin-bottom: 20px;
        }

        .info-item {
            margin-bottom: 15px;
            display: flex;
            align-items: center;
        }

        .contact-form {
            background: #f8f9fa;
            padding: 30px;
            border-radius: 8px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }

        .form-group textarea {
            height: 150px;
            resize: vertical;
        }

        .submit-btn {
            background-color: #000;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }

        .submit-btn:hover {
            background-color: #333;
        }

        @media (max-width: 768px) {
            .contact-content {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <?php include '../includes/nav.php'; ?>

    <div class="contact-container">
        <div class="contact-header">
            <h1>Contactez-nous</h1>
            <p>Notre équipe est là pour vous aider et répondre à toutes vos questions</p>
        </div>

        <div class="contact-content">
            <div class="contact-info">
                <h2>Nos Informations</h2>
                <div class="info-item">
                    <strong>Email:</strong>
                    <span>support@votremarketplace.com</span>
                </div>
                <div class="info-item">
                    <strong>Téléphone:</strong>
                    <span>+33 (0)1 23 45 67 89</span>
                </div>
                <div class="info-item">
                    <strong>Horaires:</strong>
                    <span>Lun - Ven: 9h00 - 18h00</span>
                </div>
                <div class="info-item">
                    <strong>Support:</strong>
                    <span>24/7 pour les urgences</span>
                </div>
            </div>

            <div class="contact-form">
                <form action="process_contact.php" method="POST">
                    <div class="form-group">
                        <label for="name">Nom complet</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="subject">Sujet</label>
                        <input type="text" id="subject" name="subject" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea id="message" name="message" required></textarea>
                    </div>
                    
                    <button type="submit" class="submit-btn">Envoyer le message</button>
                </form>
            </div>
        </div>
    </div>

    <?php include '../includes/footer.php'; ?>
</body>
</html>
