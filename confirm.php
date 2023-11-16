<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Accout </title>
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

    $sql = "SELECT * FROM `users` WHERE `link` = '$link'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) == 0) {
        echo "Geen gelde Code";
        exit;
    }


    else{
        
    }
    
    
    ?>
</body>
</html>