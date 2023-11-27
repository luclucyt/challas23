<?php
$server = "localhost";
$user = "LucasDatabase";//"challas";
$password = "LucasDatabase";//"gRET-McXS-4k9S-Y_yv-4h&j-E";
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