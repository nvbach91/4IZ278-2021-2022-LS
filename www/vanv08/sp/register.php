<!DOCTYPE html>
<html>
<head>
  <title>Registration system PHP and MySQL</title>
  <link rel="stylesheet" type="text/css" href="./css/style.css">
</head>
<?php
require  __DIR__ . '/db/UsersDB.php';
$errors = [];
$usersDB = new UsersDB();
if(!empty($_POST)){
    
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hashedPassword= password_hash($password, PASSWORD_DEFAULT);
    $existingUser = $usersDB->fetchByEmail($email);
    
    


if (strlen($email) < 3) {
    array_push($errors, 'Wrong email');
}
if (strlen($password) < 3) {
    array_push($errors, 'Wrong password');  
}

if (!count($errors)){
  if(is_null($existingUser)){
    $users = $usersDB->create(['email' => $email, 'password' => $hashedPassword]);
  }
  else{
    array_push($errors, 'same email');  
  }
}
}
?>
<body>
  <div class="header">
  <div class="alert alert-danger">
                <?php 
        foreach($errors as $error): ?>
                <div class="error"><?= $error; ?></div>
                <?php endforeach; ?>
            </div>
  	<h2>Register</h2>
  </div>
  <form method="post" action="register.php">
  	
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
  		Already a member? <a href="login.php">Sign in</a>
  	</p>
  </form>
</body>
</html>


