<?php require __DIR__ . '/db/ProductsDB.php'; ?>
<?php require __DIR__ . '/db/UsersDB.php'; ?>
<?php require __DIR__ . '/db/OrdersDB.php';?>
<?php require __DIR__ . '/utils/protec_acess.php'; ?>
<?php include __DIR__ . '/incl/head.php'; 
include __DIR__ . '/incl/nav.php';
$title = 'Confirm order papge';
?>
<?php
    $productsDB = new ProductsDB();
    $usersDB = new UsersDB();
    $ordersDB = new OrdersDB();
    $id = intval($_GET['id']);
    $result = $productsDB->fetchById($id);
    $product = $result->fetchAll()[0];


    $date = date('Y-m-d H:i:s');
    // VALIDACE SAME BUYERA
?>
<?

function buyer_email($buyer_email,$product_name, $price){
$to      = $buyer_email;
$subject = 'Order confirmation';
$message = 'Yoo have bought: ' . $product_name . ' for: ' . $price . '$';
$headers = 'From: vanv08@vse.cz'       . "\r\n" .
             'Reply-To: vanv08@vse.cz' . "\r\n" .
             'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers);
// echo 'BUYER EMAIL: '.'to: ' . $to . ' subject: ' . $subject . ' message: ' . $message . ' headers: ' . $headers;

}
?>

<?
function seller_emailCr($seller_email,$product_name, $price, $buyer_email){
    $to      = $seller_email;
    $subject = 'Item sold confirmation';
    $message = 'You have sold: ' . $product_name. ' for: ' . $price . '$.' . 'Buyer:' . $buyer_email;
    $headers = 'From: vanv08@vse.cz'       . "\r\n" .
                'Reply-To: vanv08@vse.cz' . "\r\n" .
                'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers);
// echo 'SELLER_EMAIL: '.'to: ' . $to . ' subject: ' . $subject . ' message: ' . $message . ' headers: ' . $headers;
}

?>

<body class="d-flex flex-column min-vh-100">
    <?
    include __DIR__ . '/utils/success_buy.php';
    include __DIR__ . '/utils/login_user_info.php';
    include __DIR__ . '/utils/user_email_fr_id.php';
    ?>
    <a href="index.php">Go back to homepage ...</a>
    <?
    // add to sp_orders
    $ordersDB->create(['date' => $date, 'seller_id' => $product['user_id'],  'buyer_id' => $_SESSION['user_id'], 'product_id' => $product['product_id'], 'price' => $product['price']]);
    // remove from sp_products
    $id_delete_product = $product['product_id'];
    $productsDB->deleteById($id_delete_product);
    // send email to buyer

    buyer_email($_SESSION['user_email'], $product['name'], $product['price']); ?> <br> 
    <?
    seller_emailCr($seller_email,$product['name'],$product['price'], $_SESSION['user_email']);

    echo $date;
    ?>
</body>
<?php include __DIR__ . '/incl/footer.php' ?>