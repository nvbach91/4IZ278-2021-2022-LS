<?php
require __DIR__ . '/db/UsersDB.php';
if (session_status() !== PHP_SESSION_ACTIVE) session_start();
if (!empty($_POST)) {
   $email = $_POST['email'];
   $password = $_POST['password'];

   $usersDB = new UsersDB();
   $existingUser = $usersDB -> fetchByEmail($email)[0];
   if (password_verify($password, $existingUser['password'])) {
      $_SESSION['id'] = $existingUser['user_id'];
      $_SESSION['email'] = $existingUser['email'];
      $_SESSION['privilege'] = $existingUser['privilege'];
      setcookie('email', $email, time() + 3600);
      header("Location: index.php");
      exit();
   }
   echo 'wrong credentials';
}
?>
<?php include __DIR__ . '/incl/head.php'; ?>
<?php include __DIR__ . '/incl/navbar.php'; ?>
<main class="container">
   <h1>Login</h1>
   <form method="POST">
      <div class="form-group">
         <label for="email">Email</label>
         <input class="form-control" type="text" name="email" placeholder="email">
         <label for="password">Password</label>
         <input class="form-control" placeholder="password" name="password" type="text">
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
   </form>
   <a href="signup.php">Don't have an account yet? Sign up!</a>
   <div style="margin-bottom: 600px"></div>
</main>
<?php include __DIR__ . '/incl/foot.php'; ?>