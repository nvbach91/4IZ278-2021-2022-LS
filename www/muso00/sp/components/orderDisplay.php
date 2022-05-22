<?php
$ordersDB = new OrdersDB();

$result = $ordersDB->fetchByAnyId('user_id', $id);
$orders = $result->fetchAll();
?>
<div class="form-profile mb-5 form rounded shadow mx-auto p-5">
    <h4 id="orders">Order summary</h4>
    <div class="container">
        <div class="row text-secondary">
            <div class="col"><small>Order ID</small></div>
            <div class="col"><small>Date created</small></div>
            <div class="col"></div>
        </div>
        <hr />
        <?php foreach ($orders as $order) : ?>
            <div class="row shadow-sm justify-content-center align-items-center">
                <div class="col bold"><?php echo $order['order_id']; ?></div>
                <div class="col"><?php echo $order['date']; ?></div>
                <div class="col p-2"><a class="btn btn-outline-secondary float-end" href="
                    <?php echo '/~muso00/sp/order-details.php?order_id=' . $order['order_id']
                        . '&date=' . $order['date']; ?>">View details</a></div>
            </div>
        <?php endforeach; ?>
    </div>
</div>