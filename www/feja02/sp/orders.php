<?php

include "include/header.php";
include "database/usersdb.php";
require "database/ordersdb.php";
require "database/shippingdetailsdb.php";
require "functions/adminCheck.php";

$usersDb = new UsersDB();
$ordersDb = new OrdersDB();
$shippingDb = new ShippingDetailsDB();

if (isset($_GET["userId"])) $orders = $ordersDb->fetchByUserId($_GET["userId"]);
else $orders = $ordersDb->fetchAll();
?>

<h1 class="text-center text-black mt-5">Orders</h1>
<div class="d-flex w-50 mx-auto text-black flex-column flex-wrap mt-4 mb-5">
    <table class="table table-striped table-product">
        <thead>
            <tr class="align-middle">
                <th>ID</th>
                <th>DATE</th>
                <th>USER</th>
                <th>TOTAL</th>
                <th>DETAILS</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order): ?>
            <?php $shippingDetails = $shippingDb->fetchById($order["shipping_details_id"])[0]; ?>
            <tr class="align-middle">
                <td><?php echo $order["id"]; ?></td>
                <td><?php echo $order["created_at"]; ?></td>
                <td><?php echo $shippingDetails["email"]; ?></td>
                <td><?php echo $order["total"] ?></td>
                <td><a class="btn" href="./order?id=<?php echo $order["id"]; ?>"><img src="./resources/details30.png" alt="orders" width="24"></a></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include "include/footer.php"; ?>
