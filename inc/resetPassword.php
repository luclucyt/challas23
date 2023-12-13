<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/resetPassword.css">
</head>
<body>
    <?php include '../header.php'; ?>
    <?php include '_database.php'; ?>
    <?php include 'mail.php'; ?>

    <?php
    if(!isset($_POST['email']) && !isset($_GET['link'])){?>
        <form method='post' action=''>
            <input type='email' name='email' placeholder='012345@glr.nl' required><br>
            <button type='submit'>Verstuur</button>
    
        <?php
        die();
    }

    
    if(isset($_POST['email'])){
        $mail = $_POST['email'];

        canReset($mail);
        echo "<p>controleer je email voor vereder instructies</p><br>";
        echo "<a href='../login.php'><button>Ga terug</button></a>";
        die();
    }


    function canReset($mail){
        global $conn;

        $mail = cleanData($mail);

        $sql = "SELECT * FROM users WHERE email = '$mail'";
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) == 0){
            echo "<p>Er bestaat geen account opdeze mail</p>";
            echo "<a href='login.php'><button>Ga terug</button></a>";
            die();
        }

        $row = mysqli_fetch_assoc($result);

        $userCode = $row['userID'];
        $name = $row['name'];
        $email = $row['email'];

        $resetMail = new email($email, "Wachtwoord resetten",
        "Beste $name, <br><br>
        Klik op de onderstande link om je wachtwoord te resetten: <br>
        <a href='http://{$_SERVER['SERVER_NAME']}/inc/resetPassword.php?link={$userCode}'>Wachtwoord resetten</a><br>
        Heeft u geen wachtwoord reset aangevraagd? Negeer deze mail dan.
        ");

        $resetMail->prepareMail();
        $resetMail->sendMail();

        echo "<p>controleer je email voor vereder instructies</p><br>";
        echo "<a href='../login.php'><button>Ga terug</button></a>";
        die();
    }

    
    if(isset($_POST['new-password'])){
        $password = $_POST['new-password'];
        $userCode = $_POST['userCode'];

        $password = mysqli_real_escape_string($conn, $password);
        $userCode = mysqli_real_escape_string($conn, $userCode);

        $password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "UPDATE users SET password = '$password' WHERE userID = '$userCode'";
        $result = mysqli_query($conn, $sql);

        if(!$result){
            echo "<p>Er is iets fout gegaan</p>";
            echo $sql;
            die();
        }

        if(mysqli_affected_rows($conn) == 0){
            echo "<p>Wachtwoord is niet veranderd</p>";
            echo $sql;
            die();
        }
        echo "<p>Wachtwoord is veranderd</p>";
        echo "<a href='../login.php'><button>Login pagina</button></a>";
        die();

    }


    if(isset($_GET['link'])){
        $link = $_GET['link'];
    }
    
    ?>

    <form method='post' action=''>
        <input type='hidden' name='userCode' value='<?= htmlspecialchars($link, ENT_QUOTES, 'UTF-8') ?>'>
        <input type='password' name='new-password' placeholder='Nieuw wachtwoord' required><br>
        <button type='submit'>Wachtwoord veranderen</button>
    </form>
</body>
</html>