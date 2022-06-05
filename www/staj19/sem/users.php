<?php

require __DIR__ . '/util/is-admin.php';

$pageName = 'EventsBox | Manage Users';

require_once __DIR__ . '/db/users-db.php';

$userDB = new UsersDB();

$nItemsPerPagination = 5;
$count = $userDB->fetchCount() - 1;

if (isset($_GET['offset'])) {
  $offset = (int)$_GET['offset'];
} else {
  $offset = 0;
}


if (empty($_GET) || isset($_GET['offset'])) {
  $allUsers = $userDB->fetchPagination($nItemsPerPagination, $offset, $_SESSION['user']['id']);
} else {
  if (isset($_GET['search'])) {
    $allUsers = $userDB->searchByName($_GET['search']);
  }
  $showAllUsers = true;
}

?>

<?php require __DIR__ . '/comp/head.php'; ?>

<main>
  <h1>Manage Users</h1>
  <a href="events-manage.php">Manage Events</a>

  <form class="mt-3" method="GET">
    <input class="form-control" type="search" name="search" placeholder="Search for user email" value="<?php echo isset($_GET['search']) ? $_GET['search'] : '' ?>">
  </form>

  <?php if (isset($showAllUsers)) : ?>
    <p>
      <a class="ms-3 fs-0.5" href="users.php">All users</a>
    </p>
  <?php endif ?>

  <table class="table my-5">
    <thead>
      <th scope="col">Id</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Privilege</th>
      <th scope="col">Actions</th>
    </thead>
    <tbody>
      <?php foreach ($allUsers as $oneUser) : ?>
        <?php if ($oneUser['id'] != $user['id']) : ?>
          <tr>
            <th scope="row"><?php echo $oneUser['id'] ?></td>
            <td><?php echo $oneUser['name'] ?></td>
            <td><?php echo $oneUser['email'] ?></td>
            <td><?php echo $oneUser['privilege'] ?></td>
            <td>
              <a href="user-edit.php?userId=<?php echo $oneUser['id'] ?>">Edit</a> |
              <a href="user-delete.php?userId=<?php echo $oneUser['id'] ?>">Delete</a>
            </td>
          </tr>
        <?php endif ?>
      <?php endforeach ?>
    </tbody>
  </table>
  <?php if ($count > $nItemsPerPagination && (isset($_GET['offset']) || empty($_GET))) : ?>
    <div class="pagination">
      <?php for ($i = 1; $i <= ceil($count / $nItemsPerPagination); $i++) : ?>
        <li class="page-item<?php echo $offset / $nItemsPerPagination + 1 == $i ? " active" : ""; ?>"><a class="page-link" href="users.php?offset=<?php echo ($i - 1) * $nItemsPerPagination; ?>">
            <?php echo $i; ?>
          </a>
        </li>
      <?php endfor ?>
    </div>
  <?php endif ?>
</main>


<?php require __DIR__ . '/comp/foot.php'; ?>