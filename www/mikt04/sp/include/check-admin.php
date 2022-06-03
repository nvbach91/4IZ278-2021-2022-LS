<?php

require_once './include/check-login.php';

if ($_SESSION['privilege'] < 2) {
    header("location: ./html/access-denied.php");
    exit;
}
?>