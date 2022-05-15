<?php
require_once  __DIR__ . '/UsersDB.php';
$errors = [];


session_start();
$usersDB = new UsersDB();

$credentials = $db ->prepare("SELECT * FROM users");

if(!empty($_POST)){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hashedPassword= password_hash($password, PASSWORD_DEFAULT);


if (strlen($email) < 3) {
    array_push($errors, 'Wrong email');
}
if (strlen($password) < 3) {
    array_push($errors, 'Wrong password');  
}
if (!count($errors)){
  exit();
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h2>Register</h2>
    <div class="login-form">
    <form method="post" action="login.php">
  	
  	<div class="input-group">
  	  <label>Email</label>
  	  <input class="form-control" name="email" value="<?php echo isset($email) ? $email : '' ?>">
  	</div>
  	<div class="input-group">
  	  <label>Password</label>
  	  <input class="form-control" name="password" value="<?php echo isset($password) ? $password : '' ?>">
  	</div>
  	<div class="input-group">
  	<div class="input-group">
  	  <button type="submit" class="btn" name="reg_user">Register</button>
  	</div>
  	<p>
  		Not a member? <a href="register.php">Sign in</a>
  	</p>
  </form>
    </div>
</body>
</html>