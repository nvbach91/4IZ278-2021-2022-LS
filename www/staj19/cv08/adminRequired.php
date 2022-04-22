<?php

if (session_status() !== PHP_SESSION_ACTIVE) session_start();

if ($_SESSION['user_privilege'] < 3) {
  header('Location: login.php');
  exit();
}
