<?php
$title = 'Sell product';
require __DIR__ . '/utils/protec_acess.php';
require __DIR__ . '/db/UsersDB.php';
require __DIR__ . '/db/ProductsDB.php';
require __DIR__ . '/db/OrdersDB.php';
include __DIR__ . '/incl/head.php';
include __DIR__ . '/incl/nav.php';
?>

<body class="d-flex flex-column min-vh-100">
    <?php require __DIR__ . '/components/display_orders.php'; ?>
</body>

<?php include __DIR__ . '/incl/footer.php' ?>