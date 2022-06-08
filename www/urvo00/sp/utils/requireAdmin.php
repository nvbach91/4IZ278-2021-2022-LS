<?php
if (session_status() !== PHP_SESSION_ACTIVE) session_start();
if (!isset($_SESSION['id'])) {
    exit();
}

if (!isset($_SESSION['privilege'])) {
    exit();
}

if ($_SESSION['privilege'] < 3) {
    exit();
}
?>