<?php session_start() ?>
<?php require '../db/Database.php' ?>
<?php require '../functions/adminRequired.php' ?>
<?php require '../db/ProductsDB.php' ?>
<?php

if(empty($_POST)){
    header('Location ../fb_login.php');
    exit();
}

$productsDB = new ProductsDB();

header('Location: ../deleteItem.php?success=1');
exit()
?>
