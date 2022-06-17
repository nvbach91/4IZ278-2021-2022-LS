<?php
$productsDB = new ProductsDB();
$usersDB = new UsersDB();
$id = intval($_GET['id']);


$result = $productsDB->fetchById($id);
$product = $result->fetchAll()[0];
?>