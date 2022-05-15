<?php

require __DIR__ . '/util/is-admin.php';

$pageName = 'EventsBox | Manage Users';

require_once __DIR__ . '/db/users-db.php';

$userDB = new UsersDB();
$allUsers = $userDB->fetchAll();

?>

<?php require __DIR__ . '/comp/head.php'; ?>


<h1>Manage Users</h1>

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
          <input hidden name="id" value="<?php echo $oneUser['id'] ?>">
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


<?php require __DIR__ . '/comp/foot.php'; ?>