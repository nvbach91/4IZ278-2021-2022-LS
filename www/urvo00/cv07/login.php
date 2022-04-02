<?php
require __DIR__ . '/db.php';
$existingName = "abc";
$existingPassword = "123";
if (!empty($_POST)) {
   $name = $_POST['name'];
   $password = $_POST['password'];

   if ($name === $existingName && $password === $existingPassword) {
      setcookie('name', $name, time() + 3600);
      header("Location: index.php");
      exit();
   }
   echo 'wrong credentials';
}
?>
<?php include __DIR__ . '/incl/header.php'; ?>
<?php include __DIR__ . '/incl/navbar.php'; ?>
<main class="container">
   <h1>Login</h1>
   <form method="POST">
      <div class="form-group">
         <label for="name">Name</label>
         <input class="form-control" type="text" name="name" placeholder="name">
         <label for="name">Password</label>
         <input class="form-control" placeholder="password" name="password" type="text">
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
   </form>
   <div style="margin-bottom: 600px"></div>
</main>
<?php include __DIR__ . '/incl/footer.php'; ?>