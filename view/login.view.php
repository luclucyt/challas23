<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- Javascript -->
    <script defer src="js/login.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        body {
            height: 100vh;
            /*background: linear-gradient(150deg, rgba(143, 81, 144, 1) 2%, rgba(167, 205, 72, 1) 29%, rgba(193, 65, 104, 1) 55%, rgba(188, 86, 55, 1) 61%, rgba(223, 199, 54, 1) 86%, rgba(81, 153, 191, 0.86) 100%);*/
            background-image: url("../IMG/background-_1__1.webp");    
            background-size: cover;
            background-position: 90% 0;
        }

        .swal2-popup{
            background-color: #212529;
        }

        .center-element {
        margin: auto;
        position: absolute;
        top: 0; left: 0; bottom: 0; right: 0;
        }
        
        .card {
            z-index: 1;
            /*border: 0.2rem solid purple;
            box-shadow: 0 0 .2rem purple,
            0 0 .2rem purple,
            0 0 2rem #bc13fe,
            0 0 0.8rem #bc13fe,
            0 0 2.8rem #bc13fe,
            inset 0 0 1.3rem #bc13fe; */
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

        .vormpje1 {
            z-index: -1;
            top: -20px; 
            left: -20px; 
        }
        .vormpje4 {
            bottom: 0px;
            right: 15px;
        }
        .vormpje5 {
            z-index: -1;
            bottom: 0;

        }
        .vormpje6 {
            bottom: 5px;
            right: 0px;
        }

        .toggle-signup{
            cursor: pointer;
        }

    </style>

</head>
<?php
include("header.php");
?>

<section class="center-element gradient-custom d-flex mt-5 align-items-center">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-10 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-dark h-100" style="border-radius: 1rem;">
                    <img src="../IMG/vormpje1.png" class="vormpje1 position-absolute" alt="">
                    <img src="../IMG/vormpje4.png" class="vormpje4 position-absolute" alt="">
                    <img src="../IMG/vormpje5.png" class="vormpje5 position-absolute" alt="">
                    <img src="../IMG/vormpje6.png" class="vormpje6 position-absolute" alt="">

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
                                    
                                    <input type="password" name="password" placeholder="Wachtwoord"
                                        class="login-input form-control text-center form-control-lg" />
                                   
                                    <p class="small tekst mb-5 pb-lg-2"><a class="tekst"
                                            href="inc/resetPassword.php" class="forgot-password">Wachtwoord
                                            vergeten?</a></p>                                </div>
                                <button class="submit-button tekst login-btn btn btn-lg px-5"
                                    type="button" name="login-submit" id="login-btn">Login</button>
                            </form>
                        </div>

                        <div class="signup-wrapper">
                            <h2 class="kop">Maak een Account</h2>
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
                                <button class="submit-button sign-up-btn btn btn-outline-light tekst btn-lg px-5"
                                    type="button" name="signup-submit" id="signup-btn">Registreer</button>
                            </form>
                        </div>
                    </div>
                    <p class="tekst mb-5 text-center text-decoration-underline toggle-signup">verander state</p>
                </div>
            </div>
        </div>
        </div>
    </section>
    

</body>

</html>

<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>