<?php

require __DIR__ . '/util/is-not-logged.php';

$pageName = 'EventsBox | Login';


if (!empty($_POST)) {
  $email = $_POST['email'];
  $password = $_POST['password'];

  require_once __DIR__ . '/db/users-db.php';

  $userDB = new UsersDB();
  $existingUser = $userDB->fetchByEmail($email);

  $email = $_POST['email'];
  $password = $_POST['password'];

  if ($existingUser == '') {
    $wrongCred = 'User does not exist';
  } else if (password_verify($password, $existingUser['password'])) {
    $_SESSION['user'] = [
      'id' => $existingUser['id'],
      'name' => $existingUser['name'],
      'privilege' => $existingUser['privilege']
    ];
    $_SESSION['LAST_ACTIVITY'] = time();

    header('Location: index.php');
    exit();
  } else {
    $wrongCred = 'Wrong credentials';
  }
}

?>

<?php require __DIR__ . '/comp/head.php' ?>


<h1>Login</h1>

<form class="m-5" method="POST">
  <?php if (isset($wrongCred)) : ?>
    <p><?php echo $wrongCred; ?></p>
  <?php endif ?>
  <div>
    <label class="form-label" for="email">Email</label><br>
    <input class="form-control" type="email" name="email" value="<?php echo isset($email) ? $email : '' ?>" required>
  </div>
  <div>
    <label class="form-label" for="password">Password</label><br>
    <input class="form-control" type="password" name="password" value="<?php echo isset($password) ? $password : '' ?>" required>
  </div>
  <button class="btn btn-primary m-3" type="submit">Login</button>
</form>


<?php require __DIR__ . '/comp/foot.php' ?>