<?php
include 'inc/_database.php';

$_SESSION['key'] = random_bytes(8);

include 'view/login.view.php';