<?php

require __DIR__ . '/util/is-not-logged.php';

$pageName = 'EventsBox | Register';


if (!empty($_POST)) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];

  require __DIR__ . '/validate/validate.php';
  $validate = new Validate();

  $err['name'] = $validate->name($name);
  $err['email'] = $validate->email($email);
  $err['password'] = $validate->password($password);

  array_filter($err, function ($value) {
    return !is_null($value) && $value !== '';
  });


  if (!empty($err)) {
    require_once __DIR__ . '/db/users-db.php';

    $userDB = new UsersDB();
    $existingUser = $userDB->fetchByEmail($email);

    if ($existingUser) {
      $wrongCred = 'Email is in use';
    } else {
      $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
      $userDB->insertRow($email, $name, $hashedPassword);
      mail($email, 'Registration Success', "Hello $name, your registration in EventsBox was successful!");
      header('Location: login.php?ref=reg');
      exit();
    }
  }
}

?>

<?php require __DIR__ . '/comp/head.php' ?>


<h1>Register</h1>

<form class="m-5" method="POST">
  <?php if (isset($wrongCred)) : ?>
    <p><?php echo $wrongCred; ?></p>
  <?php endif ?>
  <div>
    <label class="form-label" for="name">Name</label><br>
    <input class="form-control" type="text" name="name" value="<?php echo isset($name) ? $name : '' ?>" required>
    <?php if (isset($err) && isset($err['name'])) : ?>
      <br><small><?php echo $err['name'] ?></small>
    <?php endif ?>
  </div>
  <div>
    <label class="form-label" for="email">Email</label><br>
    <input class="form-control" type="email" name="email" value="<?php echo isset($email) ? $email : '' ?>" required>
    <?php if (isset($err) && isset($err['email'])) : ?>
      <br><small><?php echo $err['email'] ?></small>
    <?php endif ?>
  </div>
  <div>
    <label class="form-label" for="password">password</label><br>
    <input class="form-control" type="password" name="password" value="<?php echo isset($password) ? $password : '' ?>" required>
    <?php if (isset($err) && isset($err['password'])) : ?>
      <br><small><?php echo $err['password'] ?></small>
    <?php endif ?>
  </div>
  <button class="btn btn-primary m-3" type="submit">Register</button>
</form>


<?php require __DIR__ . '/comp/foot.php' ?>