<?php
$title = 'Order details';
session_start();
?>
<?php include __DIR__ . '/incl/head.php'; ?>
<?php include __DIR__ . '/incl/nav.php'; ?>
<?php require __DIR__ . '/db/OrderItemsDB.php'; ?>
<?php require __DIR__ . '/db/ProductsDB.php'; ?>
<?php require __DIR__ . '/db/OrdersDB.php'; ?>
<?php require __DIR__ . '/db/DeliveryDB.php'; ?>
<?php require __DIR__ . '/utils/user_required.php'; ?>

<?php
$orderItemsDB = new OrderItemsDB();
$productsDB = new ProductsDB();
$ordersDB = new OrdersDB();
$deliveryDB = new DeliveryDB();

if (isset($_GET)) {
    $orderId = $_GET['order_id'];
    $date = $_GET['date'];
}

$res = $orderItemsDB->fetchByOrderId($orderId);
$orderItems = $res->fetchAll();
$res = $ordersDB->fetchByAnyId('order_id', $orderId);
$orderInfo = $res->fetchAll()[0];
$res = $deliveryDB->fetchById($orderInfo['delivery_type_id']);
$deliveryType = $res->fetchAll()[0];

?>
<main>
    <div class="container">
        <div class="row">
            <div class="col-5 mt-5 p-2">
                <a href="javascript:history.go(-1)" class="btn btn-outline-secondary"><i class="bi bi-arrow-left"></i>&nbsp;Back</a>
            </div>
            <div class="col-4 text-start">
                <h1 class="text-start">Order details</h1>
            </div>
        </div>
    </div>
    <div class="container shadow rounded p-3 mb-4">
        <div class="row p-3">
            <div class="col p-2">
                <div class="row">
                    <div class="col text-secondary">Fullname</div>
                    <div class="col"><?php echo $orderInfo['full_name']; ?></div>
                </div>
                <div class="row">
                    <div class="col text-secondary">Address</div>
                    <div class="col"><?php echo $orderInfo['address']; ?></div>
                </div>
                <div class="row">
                    <div class="col text-secondary">Phone number</div>
                    <div class="col"><?php echo $orderInfo['phone']; ?></div>
                </div>
            </div>
            <div class="col p-2">
                <div class="row">
                    <div class="col text-secondary">Delivery method</div>
                    <div class="col"><?php echo $deliveryType['name']; ?></div>
                </div>
                <div class="row">
                    <div class="col text-secondary">Payment method</div>
                    <div class="col"><?php echo $orderInfo['payment']; ?></div>
                </div>
                <div class="row">
                    <div class="col text-secondary">Date created</div>
                    <div class="col"><?php echo $date; ?></div>
                </div>
            </div>
        </div>
    </div>
    <div class="container shadow rounded p-3 mb-5">
        <div class="row text-secondary">
            <div class="col">Item ID</div>
            <div class="col">Item name</div>
            <div class="col text-end">Quantity</div>
            <div class="col text-end">Price</div>
        </div>
        <hr />
        <?php 
        $subtotal = 0;
        foreach ($orderItems as $orderItem) {
            $res = $productsDB->fetchById($orderItem['product_id']);
            $items = $res->fetchAll()[0];
        ?>
            <div class="row shadow-sm p-2 align-items-center">
                <div class="col">
                    <?php echo $orderItem['product_id']; ?>
                </div>
                <div class="col">
                    <a class="link-primary" href="./product.php?id=<?php echo $orderItem['product_id']; ?>"><?php echo $items['name']; ?></a>
                </div>
                <div class="col text-end">
                    <?php echo $orderItem['qty']; ?>
                </div>
                <div class="col text-end">
                    $<?php echo $price = number_format($orderItem['qty'] * $orderItem['price'], 2); ?>
                </div>
            </div>
        <?php
            $subtotal = $subtotal + $price;
        } ?>
        <hr />
        <div class="row p-2 text-secondary">
            <div class="col">Subtotal</div>
            <div class="col"></div>
            <div class="col text-end"><?php echo $totalQty = sumArrayVars($orderItems, 'qty'); ?></div>
            <div class="col text-end">$<?php echo number_format($subtotal, 2); ?></div>
        </div>
        <div class="row p-2 text-secondary">
            <div class="col">Shipping</div>
            <div class="col"></div>
            <div class="col"></div>
            <div class="col text-end">+&nbsp;$<?php echo $shipping = $deliveryType['price']; ?></div>
        </div>
        <hr />
        <div class="row text-success h4">
            <div class="col">Total</div>
            <div class="col"></div>
            <div class="col text-end"><?php echo $totalQty; ?></div>
            <div class="col text-end">$<?php echo $subtotal + $shipping; ?></div>
        </div>
</main>
<?php require __DIR__ . '/incl/foot.php'; ?>