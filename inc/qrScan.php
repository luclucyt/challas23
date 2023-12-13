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

        $sql = "SELECT * FROM users WHERE userID = '$code'";
        $result = mysqli_query($conn, $sql);

        $row = mysqli_fetch_assoc($result);
        if($row['etenBonnen'] == 0 && $row['bonnen'] == 0){
            return [1, "Gebruiker heeft geen etens bonnen meer"];
        }

        if($row['etenBonnen'] > 0){
            $sql = "UPDATE users SET etenbonnen = 0 WHERE userID = '$code'";
            $result = mysqli_query($conn, $sql);
            return [1, "Gebruiker heeft 1 etens bon gebruikt"];
        }

        $sql = "UPDATE users SET bonnen = bonnen - 1 WHERE userID = '$code'";
        $result = mysqli_query($conn, $sql);

        $sql = "UPDATE users set gebruikteBonnen = gebruikteBonnen + 1 WHERE userID = '$code'";
        $result = mysqli_query($conn, $sql);

        return [1, "Gebruiker heeft 1 etens bon gebruikt"];
    }

    if($adminType == "drinken"){
        $sql = "SELECT * FROM users WHERE userID = '$code'";
        $result = mysqli_query($conn, $sql);

        $row = mysqli_fetch_assoc($result);
        if($row['drinkenBonnen'] == 0 && $row['bonnen'] == 0){
            return [1, "Gebruiker heeft geen drinken bonnen meer"];
        }

        if($row['drinkenBonnen'] > 0){
            $sql = "UPDATE users SET drinkenbonnen = 0 WHERE userID = '$code'";
            $result = mysqli_query($conn, $sql);
            return [1, "Gebruiker heeft 1 drinken bon gebruikt"];
        }

        $sql = "UPDATE users SET bonnen = bonnen - 1 WHERE userID = '$code'";
        $result = mysqli_query($conn, $sql);

        $sql = "UPDATE users set gebruikteBonnen = gebruikteBonnen + 1 WHERE userID = '$code'";
        $result = mysqli_query($conn, $sql);

        return [1, "Gebruiker heeft 1 drinken bon gebruikt"];
    }


    $sql = "SELECT * FROM users WHERE userID = '$code'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    if($row['teller'] == 4){

        if($row['bonnen'] == 4){
            return [1, "Gebruiker heeft meer dan 4 bonnen al behaald!"];
        }

        if($row['bonnen'] + $row['gebruikteBonnen'] >= 4){
            return [1, "Gebruiker heeft meer dan 4 bonnen al behaald!"];
        }

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