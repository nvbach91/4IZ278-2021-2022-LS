<?php
$title = 'Sell product';
session_start();
require __DIR__ . '/db/UsersDB.php';
require __DIR__ . '/db/ProductsDB.php';
require __DIR__ . '/db/OrdersDB.php';
include __DIR__ . '/incl/head.php';
include __DIR__ . '/incl/nav.php';
include __DIR__ . '/utils/protec_acess.php';
?>

<body>
    <?php require __DIR__ . '/components/display_offers.php'; ?>
</body>