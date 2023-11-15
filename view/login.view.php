<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Javascript -->
    <script defer src="JS/login.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
    <main>
        <section class="main">
            <div class="login-wrapper">
                <h1>Login</h1>
                <form method="post" id="login-form" action="">
                    <input type="hidden" name="token" value="">

                    <i class="fa-solid fa-user fa-lg"></i>
                    <input type="email" name="email" placeholder="012345@glr.nl" class="login-input" required>

                    <i class="fa-solid fa-lock fa-lg"></i>
                    <input type="password" name="wachtwoord" placeholder="Wachtwoord" class="login-input">

                    <button type="button" name="login-submit" class="submit-button login-btn" id="login-btn">
                        <h2>Log in</h2>
                    </button>
                </form>

                <a href="inc/resetPassword.php" class="forgot-password">Wachtwoord vergeten?</a>
            </div>

            <div class="signup-wrapper">
                <h1>Maak een Account</h1>
                <form method="POST" action="" autocomplete="off" id="signup-form" enctype="multipart/form-data">

                    <input type="hidden" name="token" value="">

                    <i class="fa-solid fa-user fa-lg"></i>
                    <input type="text" name="naam" placeholder="Voornaam + Achternaam" class="input-sign-up"><br>

                    <i class="fa-solid fa-envelope fa-lg"></i>
                    <input type="email" name="email" placeholder="012345@glr.nl" class="input-sign-up"><br>

                    <i class="fa-solid fa-lock fa-lg"></i>
                    <input type="password" name="password" placeholder="Wachtwoord" id="password" class="input-sign-up"><br>

                    <button type="button" name="signup-submit" class="submit-button sign-up-btn" id="signup-btn">
                        <h2>Registreer</h2>
                    </button>
                </form>
            </div>

            <p class="toggle-signup">verander state</p>
        </section>
    </main>

</body>

</html>

<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>