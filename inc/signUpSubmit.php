<?php 
include '_database.php';

echo json_encode(signUp());

function signUp() : array {
    global $conn;

    if(!isset($_POST)) {
        return [0, "Geen data ontvangen, probeer het opnieuw"];
    }

    if(empty($_POST['naam']) || empty($_POST['email']) || empty($_POST['password'])) {
        return [0, "Niet alle velden zijn ingevuld"];
    }

    $naam = $_POST['naam'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $naam = cleanData($naam);
    $email = cleanData($email);
    $password = cleanData($password);

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return [0, "Email is niet geldig"];
    }

    if(!preg_match('/@glr.nl/', $email)) {
        return [0, "Gebruik een GLR email adres"];
    }

    if(strlen($password) < 8) {
        return [0, "Wachtwoord moet minimaal 8 tekens lang zijn"];
    }

    if(!preg_match('/[A-Z]/', $password)) {
        return [0, "Wachtwoord moet minimaal 1 hoofdletter bevatten"];
    }

    if(!preg_match('/[0-9]/', $password)) {
        return [0, "Wachtwoord moet minimaal 1 cijfer bevatten"];
    }

    if(strlen($naam) < 3) {
        return [0, "Naam moet minimaal 3 tekens lang zijn"];
    }

    if(strlen($naam) > 50) {
        return [0, "Naam mag maximaal 50 tekens lang zijn"];
    }

    if(!preg_match('/^[a-zA-Z\s]+$/', $naam)) {
        return [0, "Naam mag alleen letters en spaties bevatten"];
    }

    if(strlen($email) > 50) {
        return [0, "Email mag maximaal 50 tekens lang zijn"];
    }

    if(strlen($password) > 50) {
        return [0, "Wachtwoord mag maximaal 50 tekens lang zijn"];
    }

    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0) {

        $row = mysqli_fetch_assoc($result);
        $userID = $row['userID'];

        if($row['isAllowed'] == 1) {
            return [0, "Er bestaat al een account met dit email adres"];
        }else{
            $sql = "DELETE FROM users WHERE userID = '$userID'";
            $result = mysqli_query($conn, $sql);

            if(!$result) {
                return [0, mysqli_error($conn)];
            }

        }

    }

    $userCode = bin2hex(random_bytes(16));
    $password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (userID, name, email, password, bonnen, gebruikteBonnen, teller, isAdmin, isAllowed) VALUES ('$userCode', '$naam', '$email', '$password', 1, 0, 0, 0, 0)";
    $result = mysqli_query($conn, $sql);

    if(!$result) {
        return [0, mysqli_error($conn)];
    }

    $linkCode = bin2hex(random_bytes(16));

    $sql = "INSERT INTO confirm (linkID, userID, linkType) VALUES ('$linkCode', '$userCode', 'confirm')";
    $result = mysqli_query($conn, $sql);

    if(!$result) {
        return [0, mysqli_error($conn)];
    }

    include 'mail.php';
    $mail = new email($email, "Account aanmaken", "
        Beste $naam,<br><br>

        Bedankt voor het aanmaken van een account op Challas '23.<br>
        Klik op de onderstaande link om je account te activeren.<br><br>
        <a href='http://{$_SERVER['SERVER_NAME']}/confirm.php?link={$linkCode}' target='_blank'>Account activeren</a><br>
        Geen account aangemaakt? Negeer deze email.
        "
    );
    $mail->prepareMail();
    $mail->sendMail();


    include 'makeQR.php';
    $qr = new MakeQR($userCode, $naam, $email);
    $qr->create();
    

    return [1, "Account aangemaakt, controleer je email om je account te activeren"];
}