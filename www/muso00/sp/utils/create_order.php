<?php
// create order header
$ordersDB->create([
    'date' => date('Y-m-d H:i:s', time()),
    'userId' => $id,
    'fullName' => $_SESSION['order_fullname'],
    'address' => $_SESSION['order_address'],
    'phone' => $_SESSION['order_phone'],
    'payment' => $_SESSION['payment'],
    'deliveryTypeId' => $_SESSION['delivery_id'],
]);

// fetch order ID
$res = $ordersDB->fetchById($id);
$order = $res->fetchAll()[0];
$orderId = $order['order_id'];

// create order items
foreach ($_SESSION['shopping_cart'] as $keys => $values) {
    $orderItemsDB->create([
        'qty' => $values['item_qty'],
        'price' => $values['item_price'],
        'productId' => $values['item_id'],
        'orderId' => $orderId,
    ]);

    // fetch product details
    $res = $productsDB->fetchById($values['item_id']);
    $products = $res->fetchAll()[0];
    // new stock
    $stock = $products['stock'] - $values['item_qty'];
    // update the stock in DB
    $productsDB->updateById($values['item_id'], 'stock', $stock);
}
