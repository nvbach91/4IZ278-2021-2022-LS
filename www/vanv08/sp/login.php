<?php
$title = 'Log in';
session_start();
include __DIR__ . '/incl/head.php';
include __DIR__ . '/incl/nav.php';
require  __DIR__ . '/db/UsersDB.php';
$errors = [];


if (!empty($_GET)) {
  $email = $_GET['email'];
  $ref = $_GET['ref'];
}
$usersDB = new UsersDB();
if(!empty($_POST)){
    $email = $_POST['email'];
    $password = $_POST['password'];



// Find existing user
$result = $usersDB->fetchByEmail($email);
if ($result->rowCount() == 0) {
  $existingUser = null;
} else {
  $existingUser = $result->fetchAll()[0];
}

// create session with credentials if no problem
if (!count($errors)) {
  if (!is_null($existingUser)) {
      if (password_verify($password, $existingUser['password'])) {
          $_SESSION['user_id'] = $existingUser['user_id'];
          $_SESSION['user_email'] = $existingUser['email'];
          $_SESSION['user_level'] = $existingUser['level'];
          header('Location: profile.php');
          exit();
      } else {
          array_push($errors, "Invalid password");
      }
  } else {
      array_push($errors, 'Invalid username');
  }}

}
?>

<body class="d-flex flex-column min-vh-100">
    <div class="header">
        <h2>Log in</h2>
        <?php if (!empty($errors)) : ?>
        <div class="alert alert-danger" role="alert">
            <?php foreach ($errors as $error) : ?>
            <div><?php echo $error; ?></div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
    </div>
    <form method="post" action="login.php">
        <div class="mb-3">
            <label>Email</label>
            <input class="form-control" name="email" value="<?php echo isset($email) ? $email : '' ?>">
        </div>
        <div class="mb-3">
            <label>Password</label>
            <input class="form-control" name="password" type="password"
                value="<?php echo isset($password) ? $password : '' ?>">
        </div>
        <div class="mb-3">
            <div class="mb-3">
                <button type="submit" class="btn btn-secondary" name="login">Log in</button>
            </div>
        </div>
            <p>
                Not a member? <a href="register.php">Register</a>
            </p>
            
    </form>
</body>

<?php include __DIR__ . '/incl/footer.php' ?>