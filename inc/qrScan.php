<?php
include '_database.php';

echo json_encode(scanQR());

function scanQR(): array{
    global $conn;

    if(!isset($_POST['code'])){
        return [0, "Geen QR code gevonden"];
    }

    if(!isset($_SESSION['userID'])){
        return [0, "Geen gebruiker gevonden"];
    }

    if(!isset($_POST['adminType'])){
        return [0, "Selecteer een admin type voor je begint met scannen"];
    }



    $code = $_POST['code'];
    $code = cleanData($code);
    $adminType = $_POST['adminType'];
    $adminType = cleanData($adminType);

   
    $sql = "SELECT * FROM users WHERE userID = '$code'";
    $result = mysqli_query($conn, $sql);

    if(!$result){
        return [0, "Geen gebruiker gevonden"];
    }

    if($adminType == "eten"){
        $sql = "UPDATE users set gebruikteBonnen = gebruikteBonnen + 1 WHERE userID = '$code'";
        $result = mysqli_query($conn, $sql);

        $row = mysqli_fetch_assoc($result);
        if($row['gebruikteBonnen'] == 4){
            return [0, "Gebruiker heeft al 4 bonnen gebruikt"];
        }

        if(!$result){
            return [0, "Gebruiker kunnen updaten"];
        }
        
        return [1, "Gebruiker geupdate"];
    }

    $row = mysqli_fetch_assoc($result);

    if($row['teller'] == 4){
        $sql = "UPDATE users SET teller = 0, bonnen = bonnen + 1 WHERE userID = '$code'";
        $result = mysqli_query($conn, $sql);
    }else{
        $sql = "UPDATE users SET teller = teller + 1 WHERE userID = '$code'";
        $result = mysqli_query($conn, $sql);
    }

    if(!$result){
        return [0, "Gebruiker niet geupdate"];
    }

    return [1, "Gebruiker geupdate"];
}