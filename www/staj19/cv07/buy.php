<?php

session_start();

require_once __DIR__ . '/classes/ProductsDB.php';

if (!isset($_SESSION['cart'])) {
  $_SESSION['cart'] = [];
}

$productsDB = new ProductsDB();
$product = $productsDB->fetchById($_GET['id'])[0];


if (!$product) {
  exit('Unable to find product!');
}

$_SESSION['cart'][] = $product['id'];


header('Location: cart.php');
exit();
