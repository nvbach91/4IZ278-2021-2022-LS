<?php
$title = 'Order summary';
session_start();
?>
<?php require __DIR__ . '/db/ProductsDB.php'; ?>
<?php require __DIR__ . '/db/OrdersDB.php'; ?>
<?php require __DIR__ . '/db/OrderItemsDB.php'; ?>
<?php require __DIR__ . '/db/DeliveryDB.php'; ?>
<?php include __DIR__ . '/incl/head.php'; ?>
<?php include __DIR__ . '/incl/nav.php'; ?>
<?php require __DIR__ . '/utils/user_required.php'; ?>
<?php require __DIR__ . '/utils/cart_empty.php'; ?>
<?php
$productsDB = new ProductsDB();
$deliveryDB =  new DeliveryDB();
$ordersDB = new OrdersDB();
$orderItemsDB = new OrderItemsDB();
$res = $deliveryDB->fetchById($_SESSION['delivery_id']);
$delivery = $res->fetchAll()[0];

$id = $_SESSION['user_id'];
$totalQty = array_sum(array_column($_SESSION['shopping_cart'], 'item_qty'));

if (isset($_GET['action'])) {
    if ($_GET['action'] == 'complete') {
        // create order
        $ordersDB->create([
            'date' => date('Y-m-d H:i:s', time()), 
            'userId' => $id, 
            'fullName' => $_SESSION['order_fullname'], 
            'address' => $_SESSION['order_address'], 
            'phone' => $_SESSION['order_phone'], 
            'payment' => $_SESSION['payment'], 
            'deliveryTypeId' => $_SESSION['delivery_id'],
        ]);
        
        // create order_items in DB
        $res = $ordersDB->fetchById($id);
        $order = $res->fetchAll()[0];
        $orderId = $order['order_id'];
        
        foreach($_SESSION['shopping_cart'] as $keys => $values) {
            $orderItemsDB->create([
                'qty' => $values['item_qty'],
                'price' => $values['item_price'],
                'productId' => $values['item_id'],
                'orderId' => $orderId,
            ]);

            // update stock
            $res = $productsDB->fetchById($values['item_id']);
            $products = $res->fetchAll()[0];
            $stock = $products['stock'] - $values['item_qty'];

            $productsDB->updateById($values['item_id'],'stock', $stock);

        }
        // unset session variables
        require __DIR__ . '/utils/clear_cart.php';
        sendEmail($_SESSION['user_email'],'Order confirmation');
        header('Location: order-complete.php');
        exit();
    }
}

?>
<main>
    <h1 class="text-center">Order summary</h1>
    <div class="mb-5">
        <div class="container shadow rounded mx-auto p-5">
            <div class="row bold mb-2 text-center">
                <div class="col"><a href="cart.php" class="text-faded-primary">Item summary</a></div>
                <div class="col"><a href="shipping.php" class="text-faded-primary">Shipping and payment</a></div>
                <div class="col"><a href="details.php" class="text-faded-primary">Delivery details</a></div>
                <div class="col text-primary">Order summary</div>
            </div>
            <div class="progress">
                <div class="progress-bar" role="progressbar" style="width: 100%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
        </div>
        <div class="container">
            <div class="shadow rounded mx-auto p-5 mt-4">
                <div class="row mb-2 shadow-sm p-3">
                    <div class="col">
                        <h4>Delivery information</h4>
                        <div class="row">
                            <div class="col text-secondary">Full name</div>
                            <div class="col bold"><?php echo $_SESSION['order_fullname']; ?></div>
                        </div>
                        <div class="row">
                            <div class="col text-secondary">Address</div>
                            <div class="col bold"><?php echo $_SESSION['order_address']; ?></div>
                        </div>
                        <div class="row">
                            <div class="col text-secondary">Phone number</div>
                            <div class="col bold"><?php echo $_SESSION['order_phone']; ?></div>
                        </div>
                        <div class="row">
                            <div class="col text-secondary">Delivery method</div>
                            <div class="col bold"><?php echo $delivery['name']; ?></div>
                        </div>
                        <div class="row">
                            <div class="col text-secondary">Payment method</div>
                            <div class="col bold"><?php echo $_SESSION['payment']; ?></div>
                        </div>
                    </div>
                </div>
                <div class="row mb-2 shadow-sm p-3">
                    <h4>Items</h4>
                    <div class="row mx-auto">
                        <?php
                        $subtotal = 0;
                        if (!empty($_SESSION['shopping_cart'])) {
                            foreach ($_SESSION['shopping_cart'] as $keys => $values) {
                                $itemId = $values['item_id'];
                                $res = $productsDB->fetchById($itemId);
                                $items = $res->fetchAll()[0];
                        ?>
                                <div class="row shadow-sm mb-2 p-3">
                                    <div class="col justify-content-center align-self-center"><a href="./product.php?id=<?php echo $itemId; ?>"><?php echo $items['name']; ?></a></div>
                                    <div class="col justify-content-center align-self-center text-end">
                                        <small class="text-secondary">Qty:&nbsp;</small><?php echo $values['item_qty'] ?>
                                    </div>
                                    <div class="col justify-content-center align-self-center text-end">$<?php echo number_format($values['item_qty'] * $values['item_price'], 2); ?></div>
                                </div>
                            <?php
                                $subtotal = $subtotal + ($values['item_qty'] * $values['item_price']);
                                $shipping = $delivery['price'];
                                $total = $subtotal + $shipping;
                            }
                            ?>

                            <div class="row text-secondary">
                                <hr />
                                <div class="col">Subtotal</div>
                                <div class="col text-end">
                                    <small>Qty:&nbsp;</small>
                                    <?php echo $totalQty; ?>
                                </div>
                                <div class="col text-end">$<?php echo number_format($subtotal, 2); ?></div>
                            </div>
                            <div class="row text-secondary">
                                <div class="col">Shipping</div>
                                <div class="col"></div>
                                <div class="col text-end">+ $<?php echo number_format($shipping, 2); ?></div>
                                <hr class="mt-3" />
                            </div>
                            <div class="row bold text-success fs-5">
                                <div class="col">Total</div>
                                <div class="col"></div>
                                <div class="col text-end">$<?php echo number_format($total, 2); ?></div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row mt-4">
                <div class="col"><a class="btn btn-secondary" href="./details.php"><i class="bi bi-arrow-left"></i> Back</a></div>
                <div class="col"><a class="btn btn-success float-end" href="?action=complete">Complete order <i class="bi bi-arrow-right"></i></a></div>
            </div>
        </div>
    </div>
</main>
<?php require __DIR__ . '/incl/foot.php'; ?>