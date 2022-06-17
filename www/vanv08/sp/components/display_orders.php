<?php
$ordersDB = new OrdersDB();
$usersDB = new UsersDB();
?>
<?php
// $result = $ordersDB->fetchByAnyId('user_id', $id);
// $orders = $result->fetchAll();

$orders = $ordersDB->fetchAll();
$user_id = $_SESSION['user_id'];
$i=0;

?>

<div class="wrapper">
    <h2 class="m-5"> My orders</h2>
    <div class="container">
        <div class="row text-primary">
            <div class="col fs-3 fw-bold">Order ID</div>
            <div class="col fs-3 fw-bold">Date</div>
            <div class="col fs-3 fw-bold" >Seller_id</div>
            <div class="col fs-3 fw-bold">Price</div>
        </div>

        <?php foreach ($orders as $order) : ?>
        <?php if($order['buyer_id'] == $user_id) : 
            $i++;?>
        <div class="row shadow-sm justify-content-center align-items-center">
            <div class="col"><?php echo $order['order_id']; ?></div>
            <div class="col"><?php echo $order['date']; ?></div>
            <div class="col"><?php echo $order['seller_id']; ?></div>
            <div class="col"><?php echo $order['price'] . "$"; ?></div>
        </div>
        <?php endif; ?>
        <?php endforeach; ?>>
        <?php if($i==0) : ?>
            <div class="col"><?php echo 'Seems like you have not ordered yet'; ?> </div>
        <?php endif; ?>
    </div>
</div>