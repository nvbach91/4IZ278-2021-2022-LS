<?php if (session_status() !== PHP_SESSION_ACTIVE) session_start(); 
if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
  }
?>

<?php include './include/head.php'; ?>

 <main class="container">
        <h1>Home</h1>
        <?php include './database/events.php'; ?>
 </main>

 <?php include './include/foot.php'; ?>