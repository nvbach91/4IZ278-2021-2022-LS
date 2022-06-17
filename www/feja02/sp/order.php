<?php
include "include/header.php";
require "database/ordersdb.php";
require "database/ordereditemsdb.php";
require "database/shippingdetailsdb.php";
require "database/productsdb.php";
require "functions/userCheck.php";

if (empty($_GET["id"])) {
    header("Location: ./myOrders");
    exit();
}

$ordersDb = new OrdersDB();
$order = $ordersDb->fetchById($_GET["id"])[0];
if (!is_array($order)) header("Location: ./myOrders");
if (($order["user_id"] != $_SESSION["login_id"]) && ($_SESSION["login_role"] != 1)) {
    header("Location: ./myOrders");
    exit();
}

$orderedItemsDb = new OrderItemsDB();
$shippingDb = new ShippingDetailsDB();
$productsDb = new ProductsDB();
$items = $orderedItemsDb->fetchByOrderId($order["id"]);
$shipping = $shippingDb->fetchById($order["shipping_details_id"])[0];
?>

<h1 class="text-center text-black mt-5">Order ID: <?php echo $order["id"]; ?></h1>
<div class="d-flex w-50 mx-auto text-black flex-column flex-wrap mt-4 mb-5">
    <table class="table table-striped table-product">
        <thead>
            <tr class="align-middle">
                <th> </th>
                <th>PRODUCT</th>
                <th>QUANTITY</th>
                <th>PRICE</th>
                <th>SUBTOTAL</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($items as $item): ?>
            <?php $product = $productsDb->fetchById($item["product_id"])[0]; ?>
            <tr class="align-middle">
                <td><a class="table-link text-reset text-decoration-none" href="./product?id=<?php echo $product["id"]; ?>"><img src="<?php echo $product["image"]; ?>" alt="" width="100"></a></td>
                <td><a class="table-link text-reset text-decoration-none" href="./product?id=<?php echo $product["id"]; ?>"><?php echo $product["name"]; ?></a></td>
                <td><?php echo $item["quantity"]; ?></td>
                <td>$<?php echo $product["price"]; ?></td>
                <td>$<?php echo $item["total"] ?></td>
            </tr>
            <?php endforeach; ?>
            <tr>
                <td></td>
                <td>EMS Shipping with tracking</td>
                <td>1</td>
                <td>$29.99</td>
                <td>$29.99</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td><h5>Total:</h5></td>
                <td>$<?php echo $order["total"]; ?></td>
            </tr>
        </tbody>
    </table>
    <div>
        <h3>Shipping Details</h3>
        <h5><?php echo $shipping["first_name"] . " " . $shipping["last_name"]; ?></h5>
        <h5><?php echo $shipping["email"]; ?></h5>
        <h5><?php echo $shipping["phone"]; ?></h5>
        <h5><?php echo $shipping["street"]; ?></h5>
        <h5><?php echo $shipping["city"] . ", " . $shipping["zip_code"]; ?></h5>
        <h5><?php echo $shipping["country"]; ?></h5>
    </div>
</div>
<?php include "include/footer.php"; ?>
