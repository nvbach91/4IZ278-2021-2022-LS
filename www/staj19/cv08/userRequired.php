<?php

if (session_status() !== PHP_SESSION_ACTIVE) session_start();

if (!isset($_SESSION['user_id'])) {
  header('Location: login.php');
  exit();
}

require_once __DIR__ . '/classes/UsersDB.php';

$userDB = new UsersDB();
$currentUser = $userDB->fetchByID($_SESSION['user_id']);

if (!$currentUser) {
  session_destroy();
  header('Location: index.php');
  exit();
}
