<?php
require __DIR__ . '/db.php';
if (!isset($_COOKIE['name'])) {
   header('Location: login.php');
   exit();
}
$name = @$_COOKIE['name'];
?>
<?php include __DIR__ . '/incl/header.php'; ?>
<?php include __DIR__ . '/incl/navbar.php'; ?>
<main class="container">
   <h1>About me</h1>
   <form method="POST">
      <div class="form-group">
         <label for="name">Name</label>
         <input class="form-control" id="name" placeholder="Name" value="<?php echo $name; ?>">
      </div>
      <button type="submit" class="btn btn-primary">Submit</button> or <a href="./">Go back to Homepage</a>
   </form>
   <div style="margin-bottom: 600px"></div>
</main>
<?php include __DIR__ . '/incl/footer.php'; ?>