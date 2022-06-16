<?php require __DIR__ . '/db/ProductsDB.php'; ?>
<?php require __DIR__ . '/db/UsersDB.php'; ?>
<?php require __DIR__ . '/db/OrdersDB.php';?>
<?php require __DIR__ . '/utils/protec_acess.php'; ?>
<?php include __DIR__ . '/incl/head.php'; 
include __DIR__ . '/incl/nav.php';
?>
<?php
    $productsDB = new ProductsDB();
    $usersDB = new UsersDB();
    $ordersDB = new OrdersDB();
    $id = intval($_GET['id']);
    $result = $productsDB->fetchById($id);
    $product = $result->fetchAll()[0];

    $date = date("Y/m/d");
    // VALIDACE SAME BUYERA

?>

<body class="d-flex flex-column min-vh-100">
    <?
    include __DIR__ . '/utils/success_buy.php';
    ?>
    <a href="index.php">Go back to homepage ...</a>
    <?
    // add to sp_orders
    $ordersDB->create(['date' => $date, 'seller_id' => $product['user_id'],  'buyer_id' => $_SESSION['user_id'], 'product_id' => $product['product_id'], 'price' => $product['price']]);
    // remove from sp_products
    $id_delete_product = $product['product_id'];
    $productsDB->deleteById($id_delete_product);

    ?>
</body>
<?php include __DIR__ . '/incl/footer.php' ?>