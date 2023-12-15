<?php
include 'inc/_database.php';

if(!isset($_SESSION['admin']) || $_SESSION['admin'] != 1){
    header("Location: home.php");
    exit();
}


include 'header.php';
include 'view/admin.view.php';
