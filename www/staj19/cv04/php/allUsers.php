<?php

require 'utils.php';

$users = getUsers();

?>

<h1>All users in DB</h1>
<?php foreach ($users as $user) : ?>
  <div>
    <p>Name: <?php echo $user[0]; ?></p>
    <p>Email: <?php echo $user[1]; ?></p>
    <p>Password: <?php echo $user[2]; ?></p>
  </div>
<?php endforeach; ?>