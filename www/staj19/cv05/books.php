<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Books DB</title>
</head>

<body>
  <?php

  require './classes/BooksDB.php';

  $orders = new BooksDB();
  $orders->configInfo();
  $orders->create([
    'id' => 194,
    'title' => 'Harry Potter',
    'published' => '1995',
    'price' => 500.99
  ]);
  $orders->fetchBy(42);

  ?>
</body>

</html>