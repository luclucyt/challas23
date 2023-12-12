<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Accout</title>

    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php
    include 'inc/_database.php';

    if(!isset($_GET['link'])) {
        echo "Geen link ontvangen";
        exit;
    }
    
    $link = $_GET['link'];
    $link = cleanData($link);

    $sql = "SELECT * FROM `confirm` WHERE `linkID` = '$link'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $userID = $row['userID'];


    $sql = "UPDATE `users` SET `isAllowed` = 1 WHERE `userID` = '$userID'";
    $result = mysqli_query($conn, $sql);

    $sql = "DELETE FROM `confirm` WHERE `linkID` = '$link'";
    mysqli_query($conn, $sql);

    $sql = "SELECT * FROM `users` WHERE `userID` = '$userID'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    $_SESSION['isLoggedIn'] = true;
    $_SESSION['userID'] = $row['userID'];
    $_SESSION['name'] = $row['name'];
    $_SESSION['email'] = $row['email'];
    $_SESSION['isAdmin'] = $row['isAdmin'];

    header("Location: login.php");

?>
</body>
</html>