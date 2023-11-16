<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Javascript -->
    <script defer src="js/login.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            height: 100vh;
            background: linear-gradient(150deg, rgba(143, 81, 144, 1) 2%, rgba(167, 205, 72, 1) 29%, rgba(193, 65, 104, 1) 55%, rgba(188, 86, 55, 1) 61%, rgba(223, 199, 54, 1) 86%, rgba(81, 153, 191, 0.86) 100%);
            }

        .kop {
            color: #A7CD48;
            font-family: "Changeling Neo W01 Bold";
        }

        .tekst {
            color: #C14168!important;
            font-family: 'century-gothic-bold', sans-serif ;
        }

        .submit-button {
            border-color:  #C14168!important;
        }


    </style>


</head>
<?php
include("header.php");
?>

<section class="gradient-custom d-flex mt-3 align-items-center">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-dark h-100" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center d-flex flex-column justify-content-between h-100">
                            <div class="mb-md-5 mt-md-4 pb-2 login-wrapper">
                                <h2 class="fw-bold mb-2 text-uppercase kop">Login</h2>
                                <p class="mb-5"></p>
                                <div class="form-outline form-white mb-4">
                                    <form method="post" id="login-form" action="">
                                        <input type="email" name="email" placeholder="012345@glr.nl"
                                            class="login-input form-control  text-center form-control-lg" required />
                                        
                                </div>
                                <div class="form-outline form-white mb-4">
                                    <input type="password" name="wachtwoord" placeholder="Wachtwoord"
                                        class="login-input form-control text-center form-control-lg" />
                                   
                                    <p class="small tekst mb-5 pb-lg-2"><a class="tekst"
                                            href="inc/resetPassword.php" class="forgot-password">Wachtwoord
                                            vergeten?</a></p>
                                </div>
                                <button class="submit-button tekst login-btn btn btn-lg px-5"
                                    type="button" name="login-submit" id="login-btn">Login</button>
                            </form>
                        </div>

                        <div class="signup-wrapper">
                            <h1>Maak een Account</h1>
                            <form method="POST" action="" autocomplete="off" id="signup-form"
                                enctype="multipart/form-data">
                                <div class="form-outline form-white mb-4">
                                    <input type="text" name="naam" placeholder="Voor- en achternaam"
                                        class="input-sign-up form-control text-center form-control-lg" />
                                    
                                </div>

                                <div class="form-outline form-white mb-4">
                                    <input type="email" name="email" placeholder="012345@glr.nl"
                                        class="input-sign-up form-control text-center form-control-lg" />
                                    
                                </div>

                                <div class="form-outline form-white mb-4">
                                    <input type="password" name="password" placeholder="Wachtwoord" id="password"
                                        class="input-sign-up form-control text-center form-control-lg" />
                                    
                                </div>
                                <button class="submit-button sign-up-btn btn btn-outline-light btn-lg px-5"
                                    type="button" name="signup-submit" id="signup-btn">Registreer</button>
                            </form>
                        </div>
                    </div>
                    <p class="tekst mb-5 text-center toggle-signup">verander state</p>
                </div>
                
            </div>
        </div>
        </div>
    </section>

<!-- <div class="signup-wrapper">
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
-->












</body>

</html>

<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>



<!-- 
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
-->