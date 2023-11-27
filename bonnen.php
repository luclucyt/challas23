<?php
include 'inc/_database.php';

$sql = "SELECT * FROM users WHERE userID = '$_SESSION[userID]'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$_SESSION['bonnen'] = $row['bonnen'];
$_SESSION['teller'] = $row['teller'];

include 'view/bonnen.view.php';