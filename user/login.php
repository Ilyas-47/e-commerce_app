<?php         
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<body>
    <?php include_once '../includes/nav.php'; ?>
    <link rel="stylesheet" type="text/css" href="../assets/css/login_register.css">

    <div class="login-wrapper">
        <div class="container">
            <div class="form-box login">
                <form action="../system/system_login.php" method="POST">
                    <h1>Login</h1>
                    <div class="input-box">
                        <input type="email" placeholder="Email" name="email" required>
                        <i class='bx bxs-user'></i>
                    </div>
                    <div class="input-box">
                        <input type="password" placeholder="Password" name="mot_de_passe" required>
                        <i class='bx bxs-lock-alt' ></i>
                    </div>
                    <div class="forgot-link">
                        <a href="#">Forgot Password?</a>
                    </div>
                    <button type="submit" class="btn">Login</button>
                    <?php
        if (isset($_SESSION['error'])) {
            echo '<p class="error_message">' . $_SESSION['error'] . '</p>';
            unset($_SESSION['error']); 
        }
        ?>
                </form>
            </div>

            <div class="form-box register">
                <form action="../system/system_sign_up.php" method="POST">
                    <h1>Registration</h1>
                    <div class="input-box">
                        <input type="text" placeholder="Username" name="nom" required>
                        <i class='bx bxs-user'></i>
                    </div>
                    <div class="input-box">
                        <input type="email" placeholder="Email" name="email" required>
                        <i class='bx bxs-envelope' ></i>
                    </div>
                    <div class="input-box">
                        <input type="tel" placeholder="Phone Number" name="telephone" required>
                        <i class='bx bxs-phone'></i>
                    </div>
                    <div class="input-box">
                        <input type="password" placeholder="Password" name="mot_de_passe" required>
                        <i class='bx bxs-lock-alt' ></i>
                    </div>
                    <button type="submit" class="btn">Register</button>
                </form>
            </div>

            <div class="toggle-box">
                <div class="toggle-panel toggle-left">
                    <h1>Hello, Welcome!</h1>
                    <p>Don't have an account?</p>
                    <button class="btn register-btn">Register</button>
                </div>

                <div class="toggle-panel toggle-right">
                    <h1>Welcome Back!</h1>
                    <p>Already have an account?</p>
                    <button class="btn login-btn">Login</button>
                </div>
            </div>
        </div>
    </div>

    <?php include_once '../includes/footer.php'; ?>
</body>
</html>