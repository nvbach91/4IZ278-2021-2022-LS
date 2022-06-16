<?php
include "include/header.php";

require "database/ordersdb.php";
require "database/ordereditemsdb.php";
require "functions/adminCheck.php";

$ordersDb = new OrdersDB();
$orderedItemsDb = new OrderItemsDB();
$orders = $ordersDb->fetchAll();
$sales = [];

foreach ($orders as $order) {
    $date = date_create($order["created_at"]);
    $dateFormatted = date_format($date, "m/d/Y");
    $orderedItems = $orderedItemsDb->fetchByOrderId($order["id"]);
    $quantity = 0;
    foreach ($orderedItems as $item) $quantity += $item["quantity"];
    if (key_exists($dateFormatted, $sales)) {
        $sales[$dateFormatted]["orders"]++;
        $sales[$dateFormatted]["quantity"] += $quantity;
        $sales[$dateFormatted]["total"] += $order["total"];
    }
    else {
        $sales[$dateFormatted] = [
            "orders" => 1,
            "quantity" => $quantity,
            "total" => $order["total"]
        ];
    }
}
?>

<h1 class="text-center text-black mt-5">Sales</h1>
<div class="d-flex w-50 mx-auto text-black flex-column flex-wrap mt-4 mb-5">
    <table class="table table-striped table-product">
        <thead>
            <tr class="align-middle">
                <th>DATE</th>
                <th>NUMBER OF ORDERS</th>
                <th>ITEMS SOLD</th>
                <th>TOTAL</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($sales as $key => $data): ?>
            <tr class="align-middle">
                <td><?php echo $key; ?></td>
                <td><?php echo $data["orders"]; ?></td>
                <td><?php echo $data["quantity"]; ?></td>
                <td>$<?php echo $data["total"] ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include "include/footer.php"; ?>
