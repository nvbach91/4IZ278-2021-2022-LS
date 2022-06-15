<?php require_once __DIR__ . '/includes/header.php'; ?>
<?php require_once __DIR__ . '/db/EventDB.php'; ?>

<?php
session_start();
$orders = [];

$userId = intval($_SESSION['user_id']);

  $eventDB = new EventDB();
  $events = $eventDB->fetchByUserId($userId);

// if(!empty($_SESSION['user_id'])){
//   $userId = $_SESSION['user_id'];

//   $eventDB = new EventDB();
//   $events = $eventDB->fetchByUserId($userId);
// }
?>
<h2>Zakoupené vstupenky</h2>
<?php echo $userId; ?>
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Datum nákupu</th>
      <th scope="col">Konference</th>
      <th scope="col">Místo konání</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach($events as $event) : ?>
      <tr>
        <td><?php echo $userId; ?></td>
        <td><?php echo $event['date']; ?></td>
      </tr>
  <?php endforeach; ?>
  </tbody>
</table>

<?php require __DIR__ . '/includes/footer.php'; ?>