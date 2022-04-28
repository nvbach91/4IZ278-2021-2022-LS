<?php require "./db.php" ?>

<?php

session_start();

if (!empty($_SESSION) && $_SESSION['userId']) {
  exit('You are logged');
}

if (!empty($_POST)) {
  $email = $_POST['email'];
  $password = $_POST['password'];

  $statement = $db->prepare("SELECT * FROM shopUsers WHERE email = :email LIMIT 1");
  $statement->execute([
    'email' => $email
  ]);
  $existingUser = $statement->fetchAll()[0];

  if (password_verify($password, $existingUser['password'])) {
    $_SESSION['userId'] = $existingUser['id'];
    $_SESSION['email'] = $existingUser['email'];
    $_SESSION['userPrivilege'] = $existingUser['privilege'];

    header('Location: edit.php?id=1');
  } else {
    $wrongCred = 'Wrong credentials';
  }
}

?>

<?php require __DIR__ . '/head.php' ?>

<main class="container" style="min-height: 80vh;">
  <h1>Login</h1>
  <?php if (isset($wrongCred)) : ?>
    <p><?php echo $wrongCred; ?></p>
  <?php endif; ?>
  <form class="form-signin" method="POST">
    <div class="form-label-group">
      <label for="email">Email</label>
      <input type="email" name="email" class="form-control" placeholder="Email" required autofocus value="<?php echo isset($product) ? $product['email'] : ''; ?>">
    </div>

    <div class="form-label-group">
      <label for="password">Password</label>
      <input type="password" name="password" class="form-control" placeholder="Password" required value="<?php echo isset($product) ? $product['password'] : ''; ?>">
    </div>

    <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Login</button> or <a href="register.php">Register</a>
  </form>
</main>

<?php require __DIR__ . '/foot.php' ?>