<?php require './OrdersDB.php' ?>
<?php
    $ordersDB = new OrdersDB();
    $orders = $ordersDB -> fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
</head>
<body>
    <?php foreach($orders as $order):?>
        <div>
            <?php echo $order['number'];?>
            <br>
            <?php echo $order['date'];?>
    </div>
    <?php endforeach ; ?>
</body>
</html>