<?php
$title = 'Sell product';
require __DIR__ . '/utils/protec_acess.php';
require __DIR__ . '/db/UsersDB.php';
require __DIR__ . '/db/ProductsDB.php';
require __DIR__ . '/db/OrdersDB.php';
include __DIR__ . '/incl/head.php';
include __DIR__ . '/incl/nav.php';

?>


<?php
// $ordersDB->create(['date' => $date, 'seller_id' => 99,  'buyer_id' => 99, 'product_id' => 99, 'price' => 22]);

if (!empty($_GET)) {
    $productsDB = new ProductsDB();
    $usersDB = new UsersDB();
    $id = intval($_GET['id']);
    $result = $productsDB->fetchById($id);
    $product = $result->fetchAll()[0];

    
}   
    ?>
<?php require __DIR__ . '/utils/user_email_fr_id.php'; ?>
<?php
    $price = $product['price'];



?>

<body class="d-flex flex-column min-vh-100">
    <form method="post" action="order_confirm.php">
        <div class="wrapper">
            <div class="container">
                <div class="row">
                    <h2>Order confirmation</h2>
                </div>
            </div>
            <div class="container">
                <div class="row border">
                    <div class="col border">
                        <h4>Product name</h4>
                    </div>
                    <div class="col border">
                        <h4>Price</h4>
                    </div>
                    <div class="col border">
                        <h4>Seller</h4>
                    </div>
                </div>
                <div class="row ">
                    <div class="col border">
                        <?php echo $product['name']; ?>
                    </div>
                    <div class="col border">
                        <?php echo $price . "$"; ?>
                    </div>
                    <div class="col border">
                        <?php echo $seller_email; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row ">
                <div class="col border">
                    <h4> Buyer's name </h4>
                </div>
                <div class="col border">
                    <h4>Phone</h4>
                </div>
                <div class="col border">
                    <h4>Adress</h4>
                </div>
            </div>
            <div class="row border">
                <div class="col border">
                    <div class="name">
                        <?php echo $first_name . " " . "$last_name"; ?>
                    </div>
                </div>
                <div class="col border">
                    <?php echo $userInfo['phone']; ?>
                </div>
                <div class="col border">
                    <?php echo $adress; ?>
                </div>
            </div>
            <h3 class="mb-4">
                <a href="./confirm.php?id=<?php echo $product['product_id']; ?>">Confirm purchase</a>
            </h3>
    </form>
    </div>
</body>
</div>
<?php include __DIR__ . '/incl/footer.php' ?>