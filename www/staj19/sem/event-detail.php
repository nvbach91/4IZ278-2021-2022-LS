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

require_once __DIR__ . '/db/category-db.php';
$categoryDB = new CategoryDB();
$category = $categoryDB->fetchById($event['category']);


$eventId = $_GET['id'];

require_once __DIR__ . '/db/registred-to-db.php';
$registerDB = new RedisteredToDB();

$registeredCount = $registerDB->getCount($eventId);

if (isset($user) && ($user['id'] !== $event['owner'])) {
  $userRegistered = $registerDB->fetchByAll($user['id'], $eventId);

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($userRegistered === '') {
      $registerDB->insertRow($user['id'], $eventId);
    } else {
      $registerDB->deleteRow($user['id'], $eventId);
    }
    header("Location: event-detail.php?id=$eventId");
    exit();
  }
}

?>

<?php require __DIR__ . '/comp/head.php'; ?>

<main class="mx-auto">
  <h1><?php echo $event['name'] ?></h1>

  <div class="mx-auto container">
    <div class="p-3 row row-cols-2">
      <div class="col">
        <?php if (isset($event['datetime'])) : ?>
          <div>Datetime: <?php echo $event['datetime'] ?></div>
        <?php endif ?>
        <?php if (isset($event['name'])) : ?>
          <div>Owner: <?php echo $owner['name'] ?></div>
        <?php endif ?>
        <?php if (isset($event['description'])) : ?>
          <div>Description:<br>
            <p class="m-2"><?php echo $event['description'] ?></p>
          </div>
        <?php endif ?>
        <?php if (isset($event['capacity'])) : ?>
          <div>Capacity: <?php echo $registeredCount['COUNT(user_id)'] . '/' . $event['capacity'] ?></div>
        <?php endif ?>
        <?php if (isset($event['location'])) : ?>
          <div>Location: <?php echo $event['location'] ?></div>
        <?php endif ?>
        <?php if (isset($category['name'])) : ?>
          <div>Category: <?php echo $category['name'] ?></div>
        <?php endif ?>
      </div>
      <div class="col">
        <img src="<?php echo isset($event['img']) ? $event['img']
                    : 'https://media.istockphoto.com/photos/dancing-friends-picture-id501387734?k=20&m=501387734&s=612x612&w=0&h=1mli5b7kpDg428fFZfsDPJ9dyVHsWsGK-EVYZUGWHpI=' ?>
        " alt="Event image">
      </div>
    </div>
    <div class="col">
      <?php if (isset($user) && ($user['id'] === $event['owner'])) : ?>
        <a class="btn btn-primary ms-3" href="event-edit.php?id=<?php echo $eventId ?>">Edit event</a>
      <?php else : ?>
        <form class="d-inline" method="POST">
          <button class="btn btn-primary m-3" type="submit"><?php echo $userRegistered !== '' ? 'No longer interested' : 'Register to' ?></button>
        </form>
      <?php endif ?>
      <a href="events.php" class="m-3">Back</a>
    </div>
  </div>
</main>



<?php require __DIR__ . '/comp/foot.php'; ?>