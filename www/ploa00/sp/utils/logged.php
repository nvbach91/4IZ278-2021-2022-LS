<?php

if (session_status() !== PHP_SESSION_ACTIVE) session_start();

if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
  session_destroy();
}

if (!isset($_SESSION['user'])) {
  header('Location: login.php');
  exit();
}

$user = $_SESSION['user'];