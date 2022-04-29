<?php
if (session_status() !== PHP_SESSION_ACTIVE) session_start();

if (!isset($_SESSION['privilege']) && $_SESSION['privilege'] != 3) {
    header("Location: index.php");
}
?>