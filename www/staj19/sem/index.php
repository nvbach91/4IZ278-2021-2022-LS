<?php
if (session_status() !== PHP_SESSION_ACTIVE) session_start();

$pageName = 'EventsBox | Home';

if (isset($_SESSION['user'])) {
  $user = $_SESSION['user'];
}

?>

<?php require __DIR__ . '/comp/head.php' ?>

<main>
  <h1>Welcome</h1>

  <p class="m-5" style="font-size: 1.5em;">
    Welcome on <b>Events</b>Box!<br>
    Here you can create your own events and share them with your friends.
  </p>
  <a href="events.php" class="btn btn-primary m-3">Go to events!</a>
</main>


<?php require __DIR__ . '/comp/foot.php' ?>