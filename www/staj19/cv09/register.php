<?php require "./db.php" ?>

<?php

session_start();

if (!empty($_SESSION) && $_SESSION['userId']) {
  exit('You are logged');
}

if (!empty($_POST)) {
  $email = $_POST['email'];
  $password = $_POST['password'];
  $name = $_POST['name'];

  $passHash = password_hash($password, PASSWORD_DEFAULT);

  $statement = $db->prepare("INSERT INTO shopUsers (email, name, password) VALUES (:email, :name, :password)");
  $statement->execute([
    'email' => $email,
    'name' => $name,
    'password' => $passHash
  ]);

  header('Location: index.php');
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
      <label for="name">Name</label>
      <input name="name" class="form-control" placeholder="Name" required autofocus value="<?php echo isset($product) ? $product['name'] : ''; ?>">
    </div>

    <div class="form-label-group">
      <label for="email">Email</label>
      <input type="email" name="email" class="form-control" placeholder="Email" required value="<?php echo isset($product) ? $product['email'] : ''; ?>">
    </div>

    <div class="form-label-group">
      <label for="password">Password</label>
      <input type="password" name="password" class="form-control" placeholder="Password" required value="<?php echo isset($product) ? $product['password'] : ''; ?>">
    </div>

    <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Login</button>
  </form>
</main>

<?php require __DIR__ . '/foot.php' ?>