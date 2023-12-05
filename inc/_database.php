<?php
$server = "localhost";
$user = file_get_contents("../data/DB_user.txt");;
$password = file_get_contents("../data/DB_pw.txt");
$database = "challas";

error_reporting(E_ALL);
ini_set('display_errors', 1);

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