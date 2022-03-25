<?php

include '../components/head.php';
require '../php/utils.php';

$users = getUsers();

?>

<main>
  <h1>All users in DB</h1>
  <?php foreach ($users as $user) : ?>
    <div style="width: 300px;">
      <h2><?php echo $user['name']; ?></h2>
      <p>Email: <?php echo $user['email']; ?></p>
      <p>Password: <?php echo $user['password']; ?></p>
    </div>
  <?php endforeach; ?>
</main>

<?php include '../components/foot.php'; ?>