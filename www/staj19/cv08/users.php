<?php

if (session_status() !== PHP_SESSION_ACTIVE) session_start();

require __DIR__ . '/userRequired.php';
require __DIR__ . '/adminRequired.php';

require_once __DIR__ . '/classes/ProductsDB.php';
$usersDB = new usersDB();

if (!empty($_POST)) {
  $usersDB->updateUserPrivilege($_POST['email'], $_POST['name'], $_POST['privilege'], $_POST['id']);
}

$users = $usersDB->fetchAll();

?>

<?php require __DIR__ . '/head.php' ?>
<main class="container">

  <h1>Update user</h1>

  <?php foreach ($users as $user) : ?>
    <form class="form-signin" method="POST">
      <div class="form-label-group">
        <label for="name">Name</label>
        <input name="name" class="form-control" placeholder="Name" required autofocus value="<?php echo $user['name']; ?>">
      </div>

      <div class="form-label-group">
        <label for="email">Email</label>
        <input name="email" class="form-control" placeholder="Email" required value="<?php echo $user['email']; ?>">
      </div>

      <div class="form-label-group">
        <label for="privilege">Privilege</label>
        <input name="privilege" type="number" class="form-control" placeholder="Privilege" required value="<?php echo $user['privilege']; ?>">
      </div>

      <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
      <br>
      <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Save</button> or <a href="index.php">Cancel</a>
    </form>
  <?php endforeach; ?>
  <div style="margin-bottom: 600px"></div>
</main>
<?php require __DIR__ . '/foot.php' ?>