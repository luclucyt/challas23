<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bonnen</title>

    <link rel="stylesheet" href="../css/bonnen.css">
</head>

<?php include 'header.php'; ?>

<body>
    <div class="background_img">
        <div class="qr_code">
            <img src="IMG/qr/<?= $_SESSION['email'] ?>.png" alt="">
        </div>

        <div class="activiteiten-wrapper">
            Je moet nog <?= 5 - $_SESSION['teller'] ?> activiteiten doen om een bon te krijgen.
        </div>

        <div class="bonnen-wrapper">
            Je hebt <?= $_SESSION['bonnen'] ?> bonnen.
        </div>
    </div>
</body>
</html>