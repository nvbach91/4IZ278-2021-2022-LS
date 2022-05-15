<?php

require __DIR__ . '/util/is-logged.php';

$pageName = 'EventsBox | Profile';

require_once __DIR__ . '/db/users-db.php';

$userDB = new UsersDB();
$existingUser = $userDB->fetchById($user['id']);

$name = $existingUser['name'];
$email = $existingUser['email'];

if (!empty($_POST)) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];

  if ($password == null) {
    $hashedPassword = $existingUser['password'];
  }

  require __DIR__ . '/validate/validate.php';
  $validate = new Validate();

  $err['name'] = $validate->name($name);
  $err['email'] = $validate->email($email);
  if (!isset($hashedPassword)) {
    $err['password'] = $validate->password($password);
  }

  array_filter($err, function ($value) {
    return !is_null($value) && $value !== '';
  });

  if (!empty($err)) {
    $userDB = new UsersDB();
    $existingUser = $userDB->fetchByEmail($email);

    if ($existingUser && $existingUser['id'] != $user['id']) {
      $wrongCred = 'Email in use';
    } else {
      if (!isset($hashedPassword)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
      }
      $userDB->updateRow($email, $name, $user['privilege'], $hashedPassword, $user['id']);
      header('Location: profile.php');
      exit();
    }
  }
}

?>

<?php require __DIR__ . '/comp/head.php'; ?>


<h1>Profile</h1>

<form class="m-5" method="POST">
  <?php if (isset($wrongCred)) : ?>
    <p><?php echo $wrongCred; ?></p>
  <?php endif ?>
  <div>
    <label class="form-label" for="name">Name</label><br>
    <input class="form-control" type="text" name="name" value="<?php echo isset($name) ? $name : '' ?>" required>
    <?php if (isset($err) && isset($err['name'])) : ?>
      <br><small class="danger"><?php echo $err['name'] ?></small>
    <?php endif ?>
  </div>
  <div>
    <label class="form-label" for="email">Email</label><br>
    <input class="form-control" type="email" name="email" value="<?php echo isset($email) ? $email : '' ?>" required>
    <?php if (isset($err) && isset($err['email'])) : ?>
      <br><small class="danger"><?php echo $err['email'] ?></small>
    <?php endif ?>
  </div>
  <div>
    <label class="form-label" for="password">password</label><br>
    <input class="form-control" type="password" name="password" value="<?php echo isset($password) ? $password : '' ?>">
    <?php if (isset($err) && isset($err['password'])) : ?>
      <br><small class="danger"><?php echo $err['password'] ?></small>
    <?php endif ?>
  </div>
  <button class="btn btn-primary m-3" type="submit">Save</button>
</form>


<?php require __DIR__ . '/comp/foot.php'; ?>