<?php 
if (session_status() !== PHP_SESSION_ACTIVE) session_start();

// Session set
if (isset($_SESSION['user_id'])) {
  $userId = $_SESSION['user_id'];
}
?>