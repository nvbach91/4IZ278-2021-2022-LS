<?php
require __DIR__ . '/db.php';
if (session_status() !== PHP_SESSION_ACTIVE) session_start();
if (!empty($_POST)) {
   $email = $_POST['email'];
   $password = $_POST['password'];

   $stmt = $db->prepare("SELECT * FROM users WHERE email like :email LIMIT 1");
   $stmt->execute(['email' => $email]);
   $existingUser = $stmt->fetch();
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
<?php include __DIR__ . '/includes/header.php'; ?>
<?php include __DIR__ . '/includes/navbar.php'; ?>
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
<?php include __DIR__ . '/includes/footer.php'; ?>