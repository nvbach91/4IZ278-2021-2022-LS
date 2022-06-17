<?php

require __DIR__ . '/util/is-admin.php';

$pageName = 'EventsBox | Manage Events';

require_once __DIR__ . '/db/event-db.php';

$eventDB = new EventDB();

$nItemsPerPagination = 5;
$count = $eventDB->fetchCount();

if (isset($_GET['offset'])) {
  $offset = (int)$_GET['offset'];
} else {
  $offset = 0;
}


if (empty($_GET) || isset($_GET['offset'])) {
  $allEvents = $eventDB->fetchPagination($nItemsPerPagination, $offset);
} else {
  if (isset($_GET['search'])) {
    $allEvents = $eventDB->searchByName($_GET['search']);
  } else if (isset($_GET['filter'])) {
    if ($_GET['filter'] == 'ended') {
      $allEvents = $eventDB->fetchAllEnded();
      $showEndedEvents = true;
    }
  }
  $showAllEvents = true;
}

$users = $eventDB->fetchUsersWithEvents();

?>

<?php require __DIR__ . '/comp/head.php'; ?>

<main>
  <h1>Manage Events</h1>
  <a href="users.php">Manage Users</a>

  <form class="mt-3" method="GET">
    <input class="form-control" type="search" name="search" placeholder="Search for event name" value="<?php echo isset($_GET['search']) ? $_GET['search'] : '' ?>">
  </form>

  <p>
    <?php if (isset($showAllEvents)) : ?>
      <a class="ms-3 fs-0.5" href="events-manage.php">All events</a>
    <?php endif ?>
    <?php if (!isset($showEndedEvents)) : ?>
      <a class="ms-3 fs-0.5" href="events-manage.php?filter=ended">Passed events</a>
    <?php endif ?>
  </p>

  <table class="table my-5">
    <thead>
      <th scope="col">Id</th>
      <th scope="col">Name</th>
      <th scope="col">DateTime</th>
      <th scope="col">Owner</th>
      <th scope="col">Actions</th>
    </thead>
    <tbody>
      <?php if (count($allEvents) > 0) : ?>
        <?php foreach ($allEvents as $oneEvent) : ?>
          <tr>
            <th scope="row"><?php echo $oneEvent['id'] ?></td>
            <td><?php echo $oneEvent['name'] ?></td>
            <td><?php echo date('H:i d.m.Y', strtotime($oneEvent['datetime'])) ?></td>
            <?php foreach ($users as $user) : ?>
              <?php if ($oneEvent['owner'] == $user['id']) : ?>
                <td><?php echo $user['email'] ?></td>
              <?php endif ?>
            <?php endforeach ?>
            <td>
              <a href="events-manage-edit.php?id=<?php echo $oneEvent['id'] ?>">Edit</a> |
              <a href="events-manage-delete.php?id=<?php echo $oneEvent['id'] ?>">Delete</a>
            </td>
          </tr>
        <?php endforeach ?>
      <?php else : ?>
        <tr>
          <td colspan="5">No data available</td>
        </tr>
      <?php endif ?>
    </tbody>
  </table>
  <?php if ($count > $nItemsPerPagination && (isset($_GET['offset']) || empty($_GET))) : ?>
    <div class="pagination">
      <?php for ($i = 1; $i <= ceil($count / $nItemsPerPagination); $i++) : ?>
        <li class="page-item<?php echo $offset / $nItemsPerPagination + 1 == $i ? " active" : ""; ?>"><a class="page-link" href="events-manage.php?offset=<?php echo ($i - 1) * $nItemsPerPagination; ?>">
            <?php echo $i; ?>
          </a>
        </li>
      <?php endfor ?>
    </div>
  <?php endif ?>
</main>


<?php require __DIR__ . '/comp/foot.php'; ?>