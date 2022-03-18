<?php

require 'utils.php';

$err = [];

if ($_POST) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $passwordConfirm = $_POST['passwordConfirm'];

  if (strlen($name) < 3) {
    $err['name'] = 'Invalid name';
  }

  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $err['email'] = 'Invalid email';
  }

  if (
    strlen($password) < 6
    || !preg_match('/[a-z]/', $password)
    || !preg_match('/[A-Z]/', $password)
    || !preg_match('/\d/', $password)
    || preg_match('/\s/', $password)
    || preg_match('/;/', $password)
  ) {
    $err['password'] = "Invalid password";
  }

  if ($passwordConfirm !== $password) {
    $err['passwordConfirm'] = 'Passwords do not match';
  }

  if (!count($err)) {
    $err['form'] = registerNewUser($name, $email, $password);
  }
}

?>

<form method="POST" action="registration.php">
  <?php if (isset($err['form'])) : ?>
    <div class="dangerArea">
      <p><?php echo $err['form']; ?></p>
    </div>
  <?php endif; ?>
  <div <?php echo isset($err['name']) ? 'class="danger"' : ''; ?>>
    <label for="name">Name*</label>
    <input name="name" value="<?php echo isset($name) ? $name : ''; ?>">
    <?php if (isset($err['name'])) : ?>
      <small><?php echo $err['name']; ?></small>
    <?php endif; ?>
  </div>
  <div <?php echo isset($err['email']) ? 'class="danger"' : ''; ?>>
    <label for="email">Email*</label>
    <input name="email" value="<?php echo isset($email) ? $email : ''; ?>">
    <?php if (isset($err['email'])) : ?>
      <small><?php echo $err['email']; ?></small>
    <?php endif; ?>
  </div>
  <div <?php echo isset($err['password']) ? 'class="danger"' : ''; ?> title="Use lower case, upper case and number. Whitespaces and semicolons are forbidden.">
    <label for="password">Password*</label>
    <input name="password" type="password" value="<?php echo isset($password) ? $password : ''; ?>">
    <?php if (isset($err['password'])) : ?>
      <small><?php echo $err['password']; ?></small>
    <?php endif; ?>
  </div>
  <div <?php echo isset($err['passwordConfirm']) ? 'class="danger"' : ''; ?>>
    <label for="passwordConfirm">Password confirm*</label>
    <input name="passwordConfirm" type="password" value="<?php echo isset($passwordConfirm) ? $passwordConfirm : ''; ?>">
    <?php if (isset($err['passwordConfirm'])) : ?>
      <small><?php echo $err['passwordConfirm']; ?></small>
    <?php endif; ?>
  </div>
  <button type="submit">Register</button>
</form>