<?php
include '_database.php';


echo json_encode(scanQR());

function scanQR(){
    global $conn;

    if(!isset($_POST['code'])){
        return [0, "Geen QR code gevonden"];
    }

    $code = $_POST['code'];
    $code = cleanData($code);

    $sql = "SELECT * FROM users WHERE userID = '$code'";
    $result = mysqli_query($conn, $sql);

    if(!$result){
        return [0, "Geen gebruiker gevonden"];
    }

    $row = mysqli_fetch_assoc($result);

    if($row['teller'] == 5){
        $sql = "UPDATE "
    }
}