<?php
if (session_status() !== PHP_SESSION_ACTIVE) session_start();

if (!isset($_SESSION['user_privilege']) || $_SESSION['user_privilege'] == 1) {
    exit();
}
