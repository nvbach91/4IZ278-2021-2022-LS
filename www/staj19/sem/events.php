<?php
if (session_status() !== PHP_SESSION_ACTIVE) session_start();

$pageName = 'EventsBox | Events';

if (isset($_SESSION['user'])) {
  $user = $_SESSION['user'];
}

require_once __DIR__ . '/db/event-db.php';
$eventDB = new EventDB();

$nItemsPerPagination = 8;
$count = $eventDB->fetchCount();

if (isset($_GET['offset'])) {
  $offset = (int)$_GET['offset'];
} else {
  $offset = 0;
}

if (empty($_GET) || isset($_GET['offset'])) {
  $events = $eventDB->fetchPagination($nItemsPerPagination, $offset);
} else {
  if (isset($_GET['search'])) {
    $events = $eventDB->searchByName($_GET['search']);
  } else if (isset($_GET['filter'])) {
    if ($_GET['filter'] === 'created') {
      $events = $eventDB->fetchByOwner($user['id']);
    } else if ($_GET['filter'] === 'registered') {
      $events = $eventDB->fetchByRegistredTo($user['id']);
    }
  } else if ($_GET['order']) {
    if ($_GET['order'] === 'asc') {
      $events = $eventDB->fetchByDate('asc');
    } else if ($_GET['order'] === 'desc') {
      $events = $eventDB->fetchByDate('desc');
    }
  }
  $showAllUsers = true;
}

?>

<?php require __DIR__ . '/comp/head.php'; ?>

<main>
  <h1>Events
    <?php if (isset($user)) : ?>
      <a class="ms-3" style="font-size: 1rem;" href="event-create.php">Create new</a>
    <?php endif ?>
  </h1>

  <form method="GET">
    <input class="form-control" type="search" name="search" placeholder="Search for event name" value="<?php echo isset($_GET['search']) ? $_GET['search'] : '' ?>">
  </form>

  <?php if (isset($showAllUsers) || isset($user)) : ?>
    <p>
      <?php if (isset($showAllUsers)) : ?>
        <a class="ms-3 fs-0.5" href="events.php">All events</a>
      <?php endif ?>
      <?php if (isset($user)) : ?>
        <?php if (!isset($_GET['filter']) || (isset($_GET['filter']) && $_GET['filter'] !== 'created')) : ?>
          <a class="ms-3 fs-0.5" href="events.php?filter=created">My events</a>
        <?php endif ?>
        <?php if (!isset($_GET['filter']) || (isset($_GET['filter']) && $_GET['filter'] !== 'registered')) : ?>
          <a class="ms-3 fs-0.5" href="events.php?filter=registered">Registered to events</a>
        <?php endif ?>
      <?php endif ?>
    </p>
  <?php endif ?>
  <p>
    <a class="ms-3 fs-0.5" href="events.php?order=asc">From earliest</a>
    <a class="ms-3 fs-0.5" href="events.php?order=desc">From furthest</a>
  </p>

  <div class="mx-auto container">
    <div class="row row-cols-4">
      <?php if (!empty($events) && count($events) >= 1) : ?>
        <?php foreach ($events as $event) : ?>
          <div class="col">
            <div class="card" style="width: 100%;">
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
        <?php endforeach ?>
      <?php else : ?>
        <p>No events found</p>
      <?php endif ?>
    </div>
  </div>
  <?php if ($count > $nItemsPerPagination && (isset($_GET['offset']) || empty($_GET))) : ?>
    <div class="pagination m-3">
      <?php for ($i = 1; $i <= ceil($count / $nItemsPerPagination); $i++) : ?>
        <li class="page-item<?php echo $offset / $nItemsPerPagination + 1 == $i ? " active" : ""; ?>"><a class="page-link" href="events.php?offset=<?php echo ($i - 1) * $nItemsPerPagination; ?>">
            <?php echo $i; ?>
          </a>
        </li>
      <?php endfor ?>
    </div>
  <?php endif ?>
</main>

<?php require __DIR__ . '/comp/foot.php'; ?>