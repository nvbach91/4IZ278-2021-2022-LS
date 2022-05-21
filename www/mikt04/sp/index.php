<?php if (session_status() !== PHP_SESSION_ACTIVE) session_start(); 
if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
  }
?>

<?php include './include/head.php'; ?>
<?php include './include/nav.php'; ?>


<main>
  <div class="promo">
    <div class="welcome-text">
        <h2>Akce</h2>
    </div>
  </div>
  <div class="wrapper">
    <?php include './include/event-grid.php'; ?>
  </div>
</main>

<?php include './include/foot.php'; ?>