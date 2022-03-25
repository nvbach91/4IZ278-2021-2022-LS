<?php require './ordersDB.php' ?>

<?php 
$ordersDB = new OrdersDB();
$orders = $ordersDB->create(['customer_name' => 'Dave', 'sum_products' => '3', 'total' => '7092 CZK']);
$orders = $ordersDB->fetchAll();

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
    <?php foreach($orders as $order): ?>
        <div>
            <?php echo "------------"; ?>
            <br>
            <?php echo "Order no.: " . $order['order_id']; ?>
            <br>
            <?php echo "Customer name: "  . $order['customer_name']; ?>
            <br>
            <?php echo "No. of products: " . $order['sum_products']; ?>
            <br>
            <?php echo "Total: " . $order['total']; ?>
        </div>
    <?php endforeach; ?>
</body>
</html>