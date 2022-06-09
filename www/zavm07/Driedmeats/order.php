<?php require 'inc/header.php' ?>
<?php require 'functions/userRequired.php' ?>
<?php require 'db/OrdersDB.php'?>
<?php require 'db/Ordered_itemsDB.php' ?>

<?php

if(!isset($_GET['id'])){
    header('Location: userOrders.php');
}

$ordersDB = new OrdersDB();
$order = $ordersDB->fetchById($_GET['id'])[0];

if(empty($order)){
    header('Location: userOrders.php');
}

if($order['user_id']!==$_SESSION['lg_id']){
    header('Location: userOrders.php');
}

$ordered_itemsDB = new Ordered_itemsDB();
$items = $ordered_itemsDB->fetchById($_GET['id']);

var_dump($items);
$total = 0;
?>
<h1 class="text-center text-black mt-5">Historie objednávek</h1>
<div class="container w-75 mx-auto text-black">
    <table class="table align-middle">
        <thead>
        <tr>
            <th scope="col">Položka</th>
            <th scope="col">ID</th>
            <th scope="col">Množství</th>
            <th scope="col">Cena za ks</th>
            <th scope="col">Cena celkem</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($items as $item): ?>
            <tr>
                <th scope="row"><?php echo $item['prod_name']; ?></th>
                <td><?php echo $item['prod_id']; ?></td>
                <td><?php echo $item['count']; ?></td>
                <td><?php echo $item['price']; ?> Kč</td>
                <td><?php echo ($item['price']*$item['count']); ?> Kč</td>
            </tr>
            <?php $total += ($item['price']*$item['count']); // Count total price?>
        <?php endforeach; ?>
        </tbody>
        <tfoot>
        <tr>
            <th></th>
            <td></td>
            <td></td>
            <td><h5>Celkem:</h5></td>
            <td><h5><?php echo $total ?> Kč</h5></td>
        </tr>
        </tfoot>
    </table>
        <div class="d-flex flex-column align-items-start">
            <p class="me-auto">
                <h4>Dodací adresa</h4>
                <?php echo $order['street'] ?>
                <br>
                <?php echo $order['city']?>
                <br>
                <?php echo $order['zip']?>
            <br>
            </p>
            <a href="userOrders.php" class="btn btn-primary btn-lg align-self-end">Zpět</a>
        </div>
</div>

<?php require 'inc/footer.php' ?>
