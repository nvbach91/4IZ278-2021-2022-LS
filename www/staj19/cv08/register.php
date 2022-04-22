<?php

if (session_status() !== PHP_SESSION_ACTIVE) session_start();

if (isset($_SESSION['user_id'])) {
  header('Location: index.php');
  exit();
}

if (!empty($_POST)) {
  $email = $_POST['email'];
  $name = $_POST['name'];
  $password = $_POST['password'];

  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $err['email'] = "Invalid email format";
  }

  if (strlen($name) < 3) {
    $err['name'] = "Name is too short";
  }

  if (strlen($password) < 8) {
    $err['password'] = "Name is too short";
  }

  if (!isset($err)) {
    require_once __DIR__ . '/classes/UsersDB.php';

    $userDB = new UsersDB();
    $existingUser = $userDB->fetchByEmail($email);

    if ($existingUser) {
      $wrongCred = 'Email in use';
    } else {
      $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
      $userDB->insertUser($email, $name, $hashedPassword);
      header('Location: login.php');
      exit();
    }
  }
}


?>


<?php require __DIR__ . '/head.php'; ?>

<main class="container" style="min-height: 80vh;">
  <h1>Register</h1>
  <?php if (isset($wrongCred)) : ?>
    <p><?php echo $wrongCred; ?></p>
  <?php endif; ?>

  <form class="form-signin" method="POST">
    <div class="form-label-group">
      <label for="name">Name</label>
      <input class="form-control" placeholder="Name" required type="text" name="name" value="<?php echo isset($name) ? $name : ''; ?>">
      <?php if (isset($err) && isset($err['name'])) : ?>
        <small><?php echo $err['name']; ?></small>
      <?php endif; ?>
    </div>

    <div class="form-label-group">
      <label for="email">Email</label>
      <input class="form-control" placeholder="Email" required type="email" name="email" value="<?php echo isset($email) ? $email : ''; ?>">
      <?php if (isset($err) && isset($err['email'])) : ?>
        <small><?php echo $err['email']; ?></small>
      <?php endif; ?>
    </div>

    <div class="form-label-group">
      <label for="password">Password</label>
      <input class="form-control" placeholder="Password" required type="password" name="password" value="<?php echo isset($password) ? $password : ''; ?>">
      <?php if (isset($err) && isset($err['password'])) : ?>
        <small><?php echo $err['password']; ?></small>
      <?php endif; ?>
    </div>

    <input type="hidden" name="id" value="<?php echo $user['id']; ?>'">
    <br>
    <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Submit</button>
  </form>
</main>

<?php require __DIR__ . '/foot.php'; ?>