<?php include 'inc/header.php'?>
<?php require "functions/userRequired.php" ?>
<?php require 'functions/cartBuilder.php' ?>
<?php require 'ctrl/orderDetailsController.php' ?>
<?php

if(empty($_SESSION['od_values'])){
    header('Location: orderDetails.php');
}

$productsDB = new ProductsDB();
$shipping = $productsDB->fetchById($_SESSION['od_values']['shipping'])[0];

$usersDB = new UsersDB();
$user = $usersDB->fetchById($_SESSION['lg_email'])[0];

$total = 0;
$results = cartBuilder();

//Generate timestamp on load
$_SESSION['od_values']['time'] = date("Y-m-d H:i:s");

?>
<h1 class="text-center text-black mt-5">Shrnutí objednávky</h1>
<div class="container w-75 mx-auto text-black">
    <table class="table align-middle">
        <thead>
        <tr>
            <th scope="col">Položka</th>
            <th scope="col">ID</th>
            <th scope="col">Velikost</th>
            <th scope="col">Množství</th>
            <th scope="col">Cena za ks</th>
            <th scope="col">Cena celkem</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($results as $result): ?>
            <tr>
                <th scope="row"><?php echo $result['name']; ?></th>
                <td><?php echo $result['id']; ?></td>
                <td><?php echo $result['size']; ?></td>
                <td><?php echo $result['count']; ?></td>
                <td><?php echo $result['price']; ?> Kč</td>
                <td><?php echo ($result['price']*$result['count']); ?> Kč</td>
            </tr>
            <?php $total += ($result['price']*$result['count']); // Count total price?>
        <?php endforeach; ?>
            <tr>
                <th scope="row"><?php echo $shipping['prod_name']?></th>
                <td><?php echo $shipping['prod_id']?></td>
                <td></td>
                <td>1</td>
                <td><?php echo $shipping['price']?></td>
                <td><?php echo $shipping['price']?></td>
                <?php $total += $shipping['price'] // add shipping price to total?>
            </tr>
        </tbody>
        <tfoot>
        <tr>
            <th></th>
            <td></td>
            <td></td>
            <td></td>
            <td><h5>Celkem:</h5></td>
            <td><h5><?php echo $total ?> Kč</h5></td>
        </tr>
        </tfoot>
    </table>
    <div class="d-flex flex-column align-items-start">
        <p class="me-auto">
            <h4>Dodací údaje</h4>
            <?php echo $user['f_name']." ".$user['s_name']?>
        <br>
            <?php echo $_SESSION['od_values']['street']." ". $_SESSION['od_values']['number']?>
        <br>
            <?php echo $_SESSION['od_values']['city']?>
        <br>
            <?php echo $_SESSION['od_values']['zip']?>
        <br>
            Doručení: <?php echo $shipping['prod_name']?>
        <br>
            Email: <?php echo $user['email']?>
        </p>
        <a href="ctrl/createOrder.php" class="btn btn-primary btn-lg align-self-end mb-3">Závazně objednat</a>
    </div>
</div>


<?php include 'inc/footer.php'?>
