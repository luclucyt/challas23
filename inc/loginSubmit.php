<?php
include '_database.php';

echo json_encode(login());

function login() : array {
    global $conn;

    if(!isset($_POST)) {
        return [0, "Geen data ontvangen, probeer het opnieuw"];
    }

    if(empty($_POST['email']) || empty($_POST['password'])) {
        return [0, "Niet alle velden zijn ingevuld"];
    }

    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $email = cleanData($email);
    $password = cleanData($password);

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return [0, "Email is niet geldig"];
    }

    if(!preg_match('/@glr.nl/', $email)) {
        return [0, "Gebruik een GLR email adres"];
    }

    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) == 0) {
        return [0, "Geen account gevonden, als je nog geen account hebt registreer dan eerst"];
    }


    $row = mysqli_fetch_assoc($result);

    if($row['isAllowed'] == 0) {
        return [0, "Je account is nog niet geactiveerd, check je email voor je activatie link"];
    }

    if(!password_verify($password, $row['password'])) {
        return [0, "Wachtwoord is niet correct"];
    }

    $_SESSION['isLoggedIn'] = true;
    $_SESSION['userID'] = $row['userID'];
    $_SESSION['name'] = $row['name'];
    $_SESSION['email'] = $row['email'];
    $_SESSION['isAdmin'] = $row['isAdmin'];

    return [1, "Je bent ingeloged"];
}