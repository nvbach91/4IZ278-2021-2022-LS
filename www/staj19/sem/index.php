<?php
if (session_status() !== PHP_SESSION_ACTIVE) session_start();

$pageName = 'EventsBox | Home';

if (isset($_SESSION['user'])) {
  $user = $_SESSION['user'];
}

?>

<?php require __DIR__ . '/comp/head.php' ?>


<h1>Home</h1>


<?php require __DIR__ . '/comp/foot.php' ?>