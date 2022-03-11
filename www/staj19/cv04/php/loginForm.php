<?php

require 'utils.php';

$err = [];
$loggedIn = false;

if ($_GET) {
  $email = $_GET['email'];
  $ref = $_GET['ref'];
}

if ($_POST) {
  $email = $_POST['email'];
  $password = $_POST['password'];

  if (strlen($email) < 3) {
    $err['email'] = 'Fill in the email';
  }

  if (strlen($password) < 3) {
    $err['password'] = 'Fill in the password';
  }

  if (count($err) < 1) {
    $auth = authenticate($email, $password);
    if (is_string($auth)) {
      $err['form']  = $auth;
    } else {
      $loggedIn = true;
    }
  }
}

?>

<?php if (!$loggedIn) : ?>
  <?php if (isset($ref) && $ref ===  'register') : ?>
    <div class="successArea">
      <p>Registration was successfull</p>
    </div>
  <?php endif; ?>
  <form method="POST" action="login.php">
    <?php if (isset($err['form'])) : ?>
      <div class="dangerArea">
        <p><?php echo $err['form']; ?></p>
      </div>
    <?php endif; ?>
    <div <?php echo isset($err['email']) ? 'class="danger"' : ''; ?>>
      <label for="email">Email*</label>
      <input name="email" value="<?php echo isset($email) ? $email : ''; ?>">
      <?php if (isset($err['email'])) : ?>
        <small><?php echo $err['email']; ?></small>
      <?php endif; ?>
    </div>
    <div <?php echo isset($err['password']) ? 'class="danger"' : ''; ?>>
      <label for="password">Password*</label>
      <input name="password" type="password" value="<?php echo isset($password) ? $password : ''; ?>">
      <?php if (isset($err['password'])) : ?>
        <small><?php echo $err['password']; ?></small>
      <?php endif; ?>
    </div>
    <button type="submit">Login</button>
  </form>
<?php else : ?>
  <p>Successfully logged in!</p>
<?php endif; ?>