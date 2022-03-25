<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Users DB</title>
</head>

<body>
  <?php

  require './classes/UsersDB.php';

  $orders = new UsersDB();
  $orders->configInfo();
  $orders->create([
    'id' => 65,
    'email' => 'email@example.com',
    'password' => '12ABcd.,'
  ]);
  $orders->updateById(42, 'password', '1234abcd');

  ?>
</body>

</html>