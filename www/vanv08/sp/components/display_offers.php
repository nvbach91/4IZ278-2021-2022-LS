<?php
$productsDB = new ProductsDB();
$usersDB = new UsersDB();
?>
<?php


$products = $productsDB->fetchAll();
$user_id = $_SESSION['user_id'];
$usr_level = $_SESSION['user_level'];
$i=0;

?>

<div class="wrapper">
    <? 
    if($usr_level == 1) : ?>
    <h2 class="m-5"> My offers</h2>
    <?else :?>
    <h2 class="m-5">Active products</h2>
    <? endif?>
    <div class="container">
        <div class="row text-primary">
            <div class="col fs-3 fw-bold">Product ID</div>
            <div class="col fs-3 fw-bold">Name</div>
            <div class="col fs-3 fw-bold">Price</div>
            <? if($usr_level == 2) : ?> <div class="col fs-3 fw-bold">Seller</div> <? endif ?>
        </div>

        <?php foreach ($products as $product) : ?>
        <?php if($product['user_id'] == $user_id && $usr_level == 1) : 
            $i++;?>
        <div class="row shadow-sm justify-content-center align-items-center">
            <div class="col"><?php echo $product['product_id']; ?></div>
            <div class="col"><?php echo $product['name']; ?></div>
            <div class="col"><?php echo $product['price'] . "$"; ?></div>
        </div>
        <? endif ?>

        <? if($usr_level == 2) : ?>
            <div class="row shadow-sm justify-content-center align-items-center">
            <div class="col"><?php echo $product['product_id']; ?></div>
            <div class="col"><?php echo $product['name']; ?></div>
            <div class="col"><?php echo $product['price'] . "$"; ?></div>
            <div class="col"><?php echo $product['user_id'] ?> </div>
        </div>
        <?php endif; ?>
        <?php endforeach; ?>>
        <?php if($i==0 && $usr_level == 1) : ?>
            <div class="col"><?php echo 'Seems like you have not offered a product yet'; ?> </div>
        <?php endif; ?>
    </div>
</div>