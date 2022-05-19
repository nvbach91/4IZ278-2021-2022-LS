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
    <div class="event-grid">
      <div class="event">
        <img class="event-cover" src="https://4fis.cz/wp-content/uploads/2022/04/FB-Event-4FIS-PubQuiz-openair-03.png" alt="event-cover">
        <h3 class="event-title">FIS Pubquiz</h3>
        <form method="POST" action="../index.php">
          <button class="event-button">Koupit lístek</button>
        </form>
      </div>
      <div class="event">
        <img class="event-cover" src="https://4fis.cz/wp-content/uploads/2022/04/FB-Event-4FIS-PubQuiz-openair-03.png" alt="event-cover">
        <h3 class="event-title">FIS Pubquiz</h3>
        <form method="POST" action="../index.php">
          <button class="event-button">Koupit lístek</button>
        </form>
      </div>
      <div class="event">
        <img class="event-cover" src="https://4fis.cz/wp-content/uploads/2022/04/FB-Event-4FIS-PubQuiz-openair-03.png" alt="event-cover">
        <h3 class="event-title">FIS Pubquiz</h3>
        <form method="POST" action="../index.php">
          <button class="event-button">Koupit lístek</button>
        </form>
      </div>
      <div class="event">
        <img class="event-cover" src="https://4fis.cz/wp-content/uploads/2022/04/FB-Event-4FIS-PubQuiz-openair-03.png" alt="event-cover">
        <h3 class="event-title">FIS Pubquiz</h3>
        <form method="POST" action="../index.php">
          <button class="event-button">Koupit lístek</button>
        </form>
      </div>
      <div class="event">
        <img class="event-cover" src="https://4fis.cz/wp-content/uploads/2022/04/FB-Event-4FIS-PubQuiz-openair-03.png" alt="event-cover">
        <h3 class="event-title">FIS Pubquiz</h3>
        <form method="POST" action="../index.php">
          <button class="event-button">Koupit lístek</button>
        </form>
      </div>
      <div class="event">
        <img class="event-cover" src="https://4fis.cz/wp-content/uploads/2022/04/FB-Event-4FIS-PubQuiz-openair-03.png" alt="event-cover">
        <h3 class="event-title">FIS Pubquiz</h3>
        <form method="POST" action="../index.php">
          <button class="event-button">Koupit lístek</button>
        </form>
      </div>
      <div class="event">
        <img class="event-cover" src="https://4fis.cz/wp-content/uploads/2022/04/FB-Event-4FIS-PubQuiz-openair-03.png" alt="event-cover">
        <h3 class="event-title">FIS Pubquiz</h3>
        <form method="POST" action="../index.php">
          <button class="event-button">Koupit lístek</button>
        </form>
      </div>
      <div class="event">
        <img class="event-cover" src="https://4fis.cz/wp-content/uploads/2022/04/FB-Event-4FIS-PubQuiz-openair-03.png" alt="event-cover">
        <h3 class="event-title">FIS Pubquiz</h3>
        <form method="POST" action="../index.php">
          <button class="event-button">Koupit lístek</button>
        </form>
      </div>
    </div>
  </div>
  <?php include './database/events.php'; ?>
</main>

<?php include './include/foot.php'; ?>