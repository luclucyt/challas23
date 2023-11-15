<?php

$host = "localhost";
$user = "LucasDatabase";
$password = "LucasDatabase";
$database = "challas";

$conn = mysqli_connect($host, $user, $password, $database);

function cleanData($data) {
    global $conn;

    $data = trim($data);
    $data = htmlspecialchars($data);
    $data = stripslashes($data);

    $data = mysqli_real_escape_string($conn, $data);

    return $data;
}