<?php
if (session_status() !== PHP_SESSION_ACTIVE) session_start();

$pageName = 'EventsBox | Event detail';

if (isset($_SESSION['user'])) {
  $user = $_SESSION['user'];
}

$eventId = $_GET['id'];

require_once __DIR__ . '/db/event-db.php';
$eventDB = new EventDB();
$event = $eventDB->fetchById($eventId);

if (empty($event)) {
  header('Location: events.php');
  exit();
}

require_once __DIR__ . '/db/users-db.php';
$usersDB = new UsersDB();
$owner = $usersDB->fetchById($event['owner']);


$eventId = $_GET['id'];

require_once __DIR__ . '/db/registred-to-db.php';
$registerDB = new RedisteredToDB();

$registeredCount = $registerDB->getCount($eventId);

if (isset($user)) {
  $userRegistered = $registerDB->fetchByAll($user['id'], $eventId);

  if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  } else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($userRegistered !== '') {
      $registerDB->deleteRow($user['id'], $eventId);
    } else {
      $location = $registerDB->insertRow($user['id'], $eventId);
    }

    header("Location: event-detail.php?id=$eventId");
    exit();
  }
}

?>

<?php require __DIR__ . '/comp/head.php'; ?>


<h1><?php echo $event['name'] ?>
  <?php if (isset($user) && ($user['id'] === $event['owner'])) : ?>
    <a class="ms-3" href="event-edit.php?id=<?php echo $eventId ?>">/</a>
  <?php endif ?>
</h1>

<div class="my-5 mx-auto container">
  <div class="p-5 row row-cols-2">
    <div class="col">
      <div>Datetime: <?php echo $event['datetime'] ?></div>
      <div>Owner: <?php echo $owner['name'] ?></div>
      <div>Description: <?php echo $event['description'] ?></div>
      <div>Capacity: <?php echo $registeredCount['COUNT(user_id)'] . '/' . $event['capacity'] ?></div>
      <div>Location: <?php echo $event['location'] ?></div>
      <div>Category: <?php echo $event['category'] ?></div>
    </div>
    <div class="col">
      <img src="<?php echo $event['img'] ?>" alt="Event image">
    </div>
  </div>
  <div class="col">
    <?php if (isset($user) && $user['id'] !== $event['owner']) : ?>
      <form class="my-5 mx-auto" method="POST">
        <button class="btn btn-primary m-3" type="submit"><?php echo $userRegistered !== '' ? 'No longer interested' : 'Register to' ?></button>
      <?php endif ?>
      <a href="events.php" class="m-3">Back</a>
      <?php if (isset($user) && $user['id'] !== $event['owner']) : ?>
      </form>
    <?php endif ?>

  </div>
</div>



<?php require __DIR__ . '/comp/foot.php'; ?>