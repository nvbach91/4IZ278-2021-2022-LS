<?php

require __DIR__ . '/util/is-admin.php';

$pageName = 'EventsBox | Edit User';

$userId = $_GET['userId'];

if (isset($userId) && $userId != $_SESSION['user']['id']) {
  require_once __DIR__ . '/db/users-db.php';

  $userDB = new UsersDB();
  $existingUser = $userDB->fetchById($userId);
} else {
  header('Location: users.php');
  exit();
}

if (!empty($_POST)) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $privilege = $_POST['privilege'];

  if (strlen($password) < 1) {
    $hashedPassword = $existingUser['password'];
  }

  require __DIR__ . '/validate/validate.php';
  $validate = new Validate();

  $err['name'] = $validate->name($name);
  $err['email'] = $validate->email($email);
  if (!isset($hashedPassword)) {
    $err['password'] = $validate->password($password);
  }
  $err['privilege'] = $validate->privilege($privilege);

  array_filter($err, function ($value) {
    return !is_null($value) && $value !== '';
  });

  if (!empty($err)) {
    $userDB = new UsersDB();
    $existingUser = $userDB->fetchByEmail($email);

    if ($existingUser && $existingUser['id'] != $userId) {
      $wrongCred = 'Email in use';
    } else {
      if (!isset($hashedPassword)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
      }
      $userDB->updateRow($email, $name, $privilege, $hashedPassword, $userId);
      header('Location: users.php');
      exit();
    }
  }
}

?>

<?php require __DIR__ . '/comp/head.php'; ?>


<h1>Edit user</h1>

<form class="m-5" method="POST">
  <?php if (isset($wrongCred)) : ?>
    <p><?php echo $wrongCred; ?></p>
  <?php endif ?>
  <div>
    <label class="form-label" for="name">Name</label><br>
    <input class="form-control" type="text" name="name" value="<?php echo isset($existingUser['name']) ? $existingUser['name'] : '' ?>" required>
    <?php if (isset($err) && isset($err['name'])) : ?>
      <br><small><?php echo $err['name'] ?></small>
    <?php endif ?>
  </div>
  <div>
    <label class="form-label" for="email">Email</label><br>
    <input class="form-control" type="email" name="email" value="<?php echo isset($existingUser['email']) ? $existingUser['email'] : '' ?>" required>
    <?php if (isset($err) && isset($err['email'])) : ?>
      <br><small><?php echo $err['email'] ?></small>
    <?php endif ?>
  </div>
  <div>
    <label class="form-label" for="privilege">Privilege</label><br>
    <input class="form-control" name="privilege" value="<?php echo isset($existingUser['privilege']) ? $existingUser['privilege'] : '' ?>" required>
    <?php if (isset($err) && isset($err['privilege'])) : ?>
      <br><small><?php echo $err['privilege'] ?></small>
    <?php endif ?>
  </div>
  <div>
    <label class="form-label" for="password">Password</label><br>
    <input class="form-control" type="password" name="password" value="<?php echo isset($password) ? $password : '' ?>" required>
    <?php if (isset($err) && isset($err['password'])) : ?>
      <br><small><?php echo $err['password'] ?></small>
    <?php endif ?>
  </div>
  <button class="btn btn-primary m-3" type="submit">Save</button>
</form>


<?php require __DIR__ . '/comp/foot.php'; ?>