<?php 
include '_database.php';

echo signUp();

function signUp() : string {
    global $conn;

    if(!isset($_POST)) {
        return "Geen data ontvangen, probeer het opnieuw";
    }

    if(empty($_POST['naam']) || empty($_POST['email']) || empty($_POST['password'])) {
        return "Niet alle velden zijn ingevuld";
    }

    $naam = $_POST['naam'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $naam = cleanData($naam);
    $email = cleanData($email);
    $password = cleanData($password);

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return "Email is niet geldig";
    }

    if(!preg_match('/@glr.nl/', $email)) {
        return "Gebruik een GLR email adres";
    }

    if(strlen($password) < 8) {
        return "Wachtwoord moet minimaal 8 tekens lang zijn";
    }

    if(!preg_match('/[A-Z]/', $password)) {
        return "Wachtwoord moet minimaal 1 hoofdletter bevatten";
    }

    if(!preg_match('/[0-9]/', $password)) {
        return "Wachtwoord moet minimaal 1 cijfer bevatten";
    }

    if(strlen($naam) < 3) {
        return "Naam moet minimaal 3 tekens lang zijn";
    }

    if(strlen($naam) > 50) {
        return "Naam mag maximaal 50 tekens lang zijn";
    }

    if(!preg_match('/^[a-zA-Z\s]+$/', $naam)) {
        return "Naam mag alleen letters en spaties bevatten";
    }

    if(strlen($email) > 50) {
        return "Email mag maximaal 50 tekens lang zijn";
    }

    if(strlen($password) > 50) {
        return "Wachtwoord mag maximaal 50 tekens lang zijn";
    }

    $sql = "SELECT * FROM users WHERE email = '$email' AND isAllowed = 1";
    $result = mysqli_query($conn, $sql);

    if(!$result) {
        return mysqli_error($conn);
    }

    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $userID = $row['userID'];

        if($row['isAllowed'] == 1) {
            return "Er bestaat al een account met dit email adres";
        }else{
            $sql = "DELETE FROM users WHERE userID = $userID";
            mysqli_query($conn, $sql);
        }

    }

    $userCode = bin2hex(random_bytes(16));
    $password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (userID, name, email, password, isAdmin, isAllowed) VALUES ('$userCode', '$naam', '$email', '$password', 0, 0)";
    $result = mysqli_query($conn, $sql);

    if(!$result) {
        return mysqli_error($conn);
    }

    $linkCode = bin2hex(random_bytes(16));

    $sql = "INSERT INTO confirm (linkID, userID, linkType) VALUES ('$linkCode', '$userCode', 'confirm')";
    $result = mysqli_query($conn, $sql);

    if(!$result) {
        return mysqli_error($conn);
    }

    include 'mail.php';
    $mail = new email($email, "Account aanmaken", "
        Beste $naam,<br><br>

        Bedankt voor het aanmaken van een account op Challas '23.<br>
        Klik op de onderstaande link om je account te activeren.<br><br>
        <a href='http://{$_SERVER['SERVER_NAME']}/confirm.php?link={$linkCode}'>Account activeren</a><br>
        Geen account aangemaakt? Negeer deze email.<br><br>
        "
    );
    $mail->prepareMail();
    $mail->sendMail();
    

    return "Naam: $naam, Email: $email, Wachtwoord: $password";
}

