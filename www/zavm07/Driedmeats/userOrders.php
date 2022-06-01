<?php require 'inc/header.php'?>
<?php require 'functions/userRequired.php' ?>
<?php require 'db/OrdersDB.php'?>

<?php
$ordersDB = new OrdersDB();
$orders = $ordersDB->fetchByUser($_SESSION['lg_id']);
?>
<h1 class="text-center text-black mt-5 mb-3">Historie objednávek</h1>
<div class="d flex w-50 mx-auto">
    <table class="table">
        <thead>
            <th>Číslo objednávky</th>
            <th>Datum</th>
        </thead>
        <tbody>
            <?php foreach ($orders as $order): ?>
            <tr>
                <td><a href="order.php?id=<?php echo $order['order_id'] ?>"><?php echo $order['order_id'] ?></a></td>
                <td><?php echo $order['date'] ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>


<?php require 'inc/footer.php'?>
