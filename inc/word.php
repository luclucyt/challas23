<?php

include '_database.php';

echo json_encode(woord());

function woord() : array{ 
    global $conn;

    $woordArray = ["test"];


    if(!isset($_POST['woord'])){
        return [0, "Geen woord gevonden"];
    }

    if(!isset($_SESSION['userID'])){
        return [0, "Geen gebruiker gevonden"];
    }

    $userCode = $_SESSION['userID'];

    $woord = $_POST['woord'];
    $woord = strtolower($woord);
    $woord = trim($woord);
    $woord = str_replace(" ", "", $woord);
    $woord = cleanData($woord);

    if($woord == ""){
        return [0, "Geen woord gevonden"];
    }

    //if the word is not in the array, return false
    if(!in_array($woord, $woordArray)){
        return [0, "Dit woord is verkeerd"];
    }


    $sql = "SELECT * FROM users WHERE userID = '$userCode'";
    $result = mysqli_query($conn, $sql);

    if(!$result){
        return [0, "Geen gebruiker gevonden"];
    }

    $row = mysqli_fetch_assoc($result);
    if($row['teller'] == 4){

        if($row['bonnen'] >= 4){
            return [1, "Gebruiker heeft meer dan 4 bonnen al behaald!"];
        }
        
        $sql = "UPDATE users SET teller = 0, bonnen = bonnen + 1 WHERE userID = '$userCode'";
        $result = mysqli_query($conn, $sql);
    }else{
        $sql = "UPDATE users SET teller = teller + 1 WHERE userID = '$userCode'";
        $result = mysqli_query($conn, $sql);
    }
    
    
    return [1, "Je hebt het woord goed geraden"];
}