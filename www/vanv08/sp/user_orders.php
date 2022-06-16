<?php
$title = 'My orders';
session_start();
require __DIR__ . '/db/UsersDB.php';
require __DIR__ . '/db/ProductsDB.php';
require __DIR__ . '/db/OrdersDB.php';
include __DIR__ . '/incl/head.php';
include __DIR__ . '/incl/nav.php';
?>

<body>
    <?php require __DIR__ . '/components/display_orders.php'; ?>
</body>