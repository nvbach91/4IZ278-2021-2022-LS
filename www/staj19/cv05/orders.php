<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Orders DB</title>
</head>

<body>
  <?php

  require './classes/OrdersDB.php';

  $orders = new OrdersDB();
  $orders->configInfo();
  $orders->create([
    'id' => 42,
    'date' => '2009-12-12',
    'items' => 'Harry Potter, Star Wars'
  ]);
  $orders->deleteById(42);

  ?>
</body>

</html>