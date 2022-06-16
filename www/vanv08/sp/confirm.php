<?php require __DIR__ . '/db/ProductsDB.php'; ?>
<?php require __DIR__ . '/db/UsersDB.php'; ?>
<?php require __DIR__ . '/db/OrdersDB.php';?>
<?php
$productsDB = new ProductsDB();
$usersDB = new UsersDB();
$ordersDB = new OrdersDB();
    $id = intval($_GET['id']);
    $result = $productsDB->fetchById($id);
    $product = $result->fetchAll()[0];

    session_start();
    $date = date("Y/m/d");
    // VALIDACE SAME BUYERA


    // add to sp_orders
    $ordersDB->create(['date' => $date, 'seller_id' => $product['user_id'],  'buyer_id' => $_SESSION['user_id'], 'product_id' => $product['product_id'], 'price' => $product['price']]);
    // remove from sp_products
    echo $product['product_id'];
    $id_delete_product = $product['product_id'];
    
    $productsDB->deleteById($id_delete_product);

    ?>
