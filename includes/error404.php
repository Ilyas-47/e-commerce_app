<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error 404</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            font-family: 'Segoe UI', sans-serif;
        }
        main {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f8f9fa;
        }
        .error-container {
            text-align: center;
            padding: 40px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            max-width: 500px;
            width: 90%;
        }
        .error-code {
            font-size: 140px;
            background: linear-gradient(45deg, #ff0000, #ff4444);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-weight: bold;
            line-height: 1.2;
            margin-bottom: 20px;
            animation: pulse 2s infinite;
        }
        .error-message {
            font-size: 28px;
            color: #2d3436;
            margin-bottom: 15px;
            font-weight: 600;
        }
        .error-description {
            color: #636e72;
            margin-bottom: 30px;
            font-size: 16px;
            line-height: 1.6;
        }
        .home-button {
            display: inline-block;
            padding: 15px 35px;
            background: linear-gradient(45deg, #00b894, #00cec9);
            color: white;
            text-decoration: none;
            border-radius: 30px;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0, 184, 148, 0.3);
        }
        .home-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 184, 148, 0.4);
        }
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
    </style>
</head>
<body>
    <main>
        <div class="error-container">
            <h1 class="error-code">404</h1>
            <h2 class="error-message">Oups ! Page introuvable</h2>
            <p class="error-description">
                La page que vous recherchez semble avoir disparu dans le cyberespace.
                Pas d'inquiétude, vous pouvez toujours retourner à l'accueil !
            </p>
            <a href="../user/accueil.php" class="home-button">Retour à l'accueil</a>
        </div>
    </main>
</body>
</html>
