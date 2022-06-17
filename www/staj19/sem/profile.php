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


<main>
  <h1>Profile</h1>

  <form class="my-5 mx-auto w-50" method="POST">
    <?php if (isset($wrongCred)) : ?>
      <p class="text-danger"><?php echo $wrongCred; ?></p>
    <?php endif ?>
    <div class="mb-3">
      <label class="form-label" for="name">Name</label>
      <input class="form-control<?php echo (isset($err) && isset($err['name'])) ? ' border border-danger' : '' ?>" type="text" name="name" value="<?php echo isset($name) ? $name : '' ?>" required>
      <?php if (isset($err) && isset($err['name'])) : ?>
        <small class="text-danger"><?php echo $err['name'] ?></small>
      <?php endif ?>
    </div>
    <div class="mb-3">
      <label class="form-label" for="email">Email</label>
      <input class="form-control<?php echo (isset($err) && isset($err['email'])) ? ' border border-danger' : '' ?>" type="email" name="email" value="<?php echo isset($email) ? $email : '' ?>" required>
      <?php if (isset($err) && isset($err['email'])) : ?>
        <small class="text-danger"><?php echo $err['email'] ?></small>
      <?php endif ?>
    </div>
    <div class="mb-3">
      <label class="form-label" for="password">Password</label>
      <input class="form-control<?php echo (isset($err) && isset($err['password'])) ? ' border border-danger' : '' ?>" type="password" name="password" value="<?php echo isset($password) ? $password : '' ?>" required>
      <?php if (isset($err) && isset($err['password'])) : ?>
        <small class="text-danger"><?php echo $err['password'] ?></small>
      <?php endif ?>
    </div>
    <button class="btn btn-primary m-3" type="submit">Save</button>
  </form>
</main>


<?php require __DIR__ . '/comp/foot.php'; ?>