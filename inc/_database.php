<?php

$server = "81.206.73.35";
$user = "LucasDatabase";
$password = "LucasDatabase";
$database = "challas";

$conn = mysqli_connect($server, $user, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
session_start();

function cleanData($data) {
    global $conn;

    //only allow utf-8 characters (no weird characters)
    $data = mb_convert_encoding($data, "UTF-8");

    $data = trim($data);
    $data = htmlspecialchars($data);
    $data = stripslashes($data);

    $data = mysqli_real_escape_string($conn, $data);

    return $data;
}