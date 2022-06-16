<?php
include "include/header.php";
require "database/ordersdb.php";
require "functions/userCheck.php";

$ordersDb = new OrdersDB();
$ret = $ordersDb->fetchByUserId($_SESSION["login_id"]);
$orders = [];

foreach ($ret as $row) {
    $order = [
        "id" => $row["id"],
        "date" => $row["created_at"],
        "total" => $row["total"]
    ];
    array_push($orders, $order);
}
?>

<h1 class="text-center text-black mt-5">My Orders</h1>
<div class="d-flex w-50 mx-auto text-black flex-column flex-wrap mt-4 mb-5">
    <table class="table table-striped table-product">
        <thead>
            <tr class="align-middle">
                <th>ID</th>
                <th>DATE</th>
                <th>TOTAL</th>
                <th>DETAILS</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order): ?>
            <tr class="align-middle">
                <td><?php echo $order["id"]; ?></td>
                <td><?php echo $order["date"]; ?></td>
                <td>$<?php echo $order["total"]; ?></td>
                <td><a class="btn" href="./order?id=<?php echo $order["id"]; ?>"><img src="./resources/details30.png" alt="orders" width="24"></a></td>
            </tr>
            <?php endforeach; ?>
            </tr>
        </tbody>
    </table>
</div>

<?php include "include/footer.php"; ?>
