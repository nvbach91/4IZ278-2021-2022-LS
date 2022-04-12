<?php

if (session_status() !== PHP_SESSION_ACTIVE) session_start();

if (!isset($_SESSION['user_id'])) {
  header('Location: login.php');
  exit();
}

$id = $_SESSION['user_id'];

require_once __DIR__ . '/classes/UsersDB.php';
$userDB = new UsersDB();

if (!empty($_POST)) {
  $name = $_POST['name'];
  $email = $_POST['email'];

  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $err['email'] = "Invalid email format";
  }

  if (strlen($name) < 3) {
    $err['name'] = "Name is too short";
  }

  if (!isset($err)) {
    $existingUser = $userDB->fetchByEmail($email);

    if ($existingUser && $existingUser['id'] !== $id) {
      $wrongCred = 'Email in use';
    } else {
      $userDB->updateUser($email, $name, $id);
      $_SESSION['user_name'] = $name;
    }
  }
}

$existingUser = $userDB->fetchById($id);

?>

<?php require __DIR__ . '/head.php'; ?>

<main class="container" style="min-height: 75vh;">
  <h1>Profile</h1>
  <?php if (isset($wrongCred)) : ?>
    <p><?php echo $wrongCred; ?></p>
  <?php endif; ?>
  <form method="POST">
    <div class="form-group">
      <label for="name">Name</label>
      <input class="form-control" id="name" placeholder="Name" name="name" value="<?php echo isset($name) ? $name : $existingUser['name']; ?>">
      <?php if (isset($err) && isset($err['name'])) : ?>
        <small><?php echo $err['name']; ?></small>
      <?php endif; ?>
    </div>
    <div class="form-group">
      <label for="email">Email</label>
      <input class="form-control" id="email" placeholder="Email" name="email" value="<?php echo isset($email) ? $email : $existingUser['email']; ?>">
      <?php if (isset($err) && isset($err['email'])) : ?>
        <small><?php echo $err['email']; ?></small>
      <?php endif; ?>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button> or <a href="./">Go back to Homepage</a>
  </form>
  <div style="margin-bottom: 600px"></div>
</main>

<?php require __DIR__ . '/foot.php'; ?>