<?php include 'inc/header.php'?>
<?php require 'functions/adminRequired.php';?>
<?php require 'db/OrdersDB.php' ?>
<?php
    $productsDB = new OrdersDB();
    $orders = $productsDB->fetchAggregation();
?>
<h1 class="text-center text-black mt-5">Přehled tržby</h1>
<div class="container w-50 text-black mx-auto">
    <table class="table align-middle">
        <thead>
            <tr>
                <td>Datum</td>
                <td>Počet objednávek</td>
                <td>Celkový obrat</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order): ?>
                <tr>
                    <td><?php echo $order['date'] ?></td>
                    <td><?php echo $order['sum'] ?></td>
                    <td><?php echo $order['price'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include 'inc/footer.php'?>
