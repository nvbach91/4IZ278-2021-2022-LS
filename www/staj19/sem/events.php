<?php
if (session_status() !== PHP_SESSION_ACTIVE) session_start();

$pageName = 'EventsBox | Events';

if (isset($_SESSION['user'])) {
  $user = $_SESSION['user'];
}


require_once __DIR__ . '/db/event-db.php';
$eventDB = new EventDB();
$events = $eventDB->fetchAll();

$eventsAdded = 0;

?>

<?php require __DIR__ . '/comp/head.php'; ?>


<h1>Events
  <?php if (isset($user)) : ?>
    <a class="ms-3" href="event-create.php">+</a>
  <?php endif ?>
</h1>

<div class="my-5 mx-auto container">
  <div class="row row-cols-4">
    <?php foreach ($events as $event) : ?>
      <?php if (strtotime($event['datetime']) > time()) : ?>
        <div class="col">
          <?php $eventsAdded++ ?>
          <div class=" card m-3" style="width: 18rem;">
            <img class="card-img-top" src="
      <?php echo isset($event['img']) ? $event['img']
          : 'https://media.istockphoto.com/photos/dancing-friends-picture-id501387734?k=20&m=501387734&s=612x612&w=0&h=1mli5b7kpDg428fFZfsDPJ9dyVHsWsGK-EVYZUGWHpI=' ?>
    " alt="Event image">
            <div class="card-body">
              <h5 class="card-title"><?php echo $event['name'] ?></h5>
              <h6 class="card-subtitle mb-2 text-muted"><?php echo date('H:i d.m.Y', strtotime($event['datetime'])) ?></h6>
              <?php if (isset($event['description'])) : ?>
                <p class="card-text text-truncate"><?php echo $event['description'] ?></p>
              <?php endif ?>
              <a href="event-detail.php?id=<?php echo $event['id'] ?>" class="btn btn-primary">Go to detail</a>
            </div>
          </div>
        </div>
      <?php endif ?>
    <?php endforeach ?>
    <?php if ($eventsAdded == 0) : ?>
      <p>No events found</p>
    <?php endif ?>
  </div>
</div>

<?php require __DIR__ . '/comp/foot.php'; ?>