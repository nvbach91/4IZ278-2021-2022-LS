<?php session_start() ?>
<?php require '../db/Database.php' ?>
<?php require '../functions/adminRequired.php' ?>
<?php require '../db/ProductsDB.php' ?>
<?php

if(empty($_POST)){
    var_dump(1);
    header('Location ../index.php');
    exit();
}

$productsDB = new ProductsDB();
$productsDB->deleteById($_POST['id']);

header('Location: ../deleteItem.php?success=1');
exit()
?>
