<?php

if (session_status() !== PHP_SESSION_ACTIVE) session_start();

if (isset($_SESSION['user_id'])) {
  header('Location: index.php');
  exit();
}

if (!empty($_POST)) {
  require_once __DIR__ . '/classes/UsersDB.php';

  $email = $_POST['email'];
  $password = $_POST['password'];

  $userDB = new UsersDB();
  $existingUser = $userDB->fetchByEmail($email);

  if (password_verify($password, $existingUser['password'])) {
    $_SESSION['user_id'] = $existingUser['id'];
    $_SESSION['user_name'] = $existingUser['name'];
    $_SESSION['user_privilege'] = $existingUser['privilege'];

    header('Location: index.php');
    exit();
  } else {
    $wrongCred = 'Wrong credentials';
  }
}


?>


<?php require __DIR__ . '/head.php'; ?>

<main class="container" style="min-height: 80vh;">
  <h1>Login</h1>
  <?php if (isset($wrongCred)) : ?>
    <p><?php echo $wrongCred; ?></p>
  <?php endif; ?>
  <form class="form-signin" method="POST">
    <div class="form-label-group">
      <label for="email">Email</label>
      <input name="email" class="form-control" placeholder="Email" required type="email" value="<?php echo isset($email) ? $email : ''; ?>">
    </div>

    <div class="form-label-group">
      <label for="password">Password</label>
      <input name="password" class="form-control" placeholder="password" required type="password" value="<?php echo isset($password) ? $password : ''; ?>">
    </div>

    <input type="hidden" name="id" value="<?php echo $user['id']; ?>'">
    <br>
    <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Submit</button>
  </form>
</main>

<?php require __DIR__ . '/foot.php'; ?>