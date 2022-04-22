<?php

if (session_status() !== PHP_SESSION_ACTIVE) session_start();


require __DIR__ . '/userRequired.php';
require __DIR__ . '/managerRequired.php';


require_once __DIR__ . '/classes/ProductsDB.php';
$productsDB = new ProductsDB();
$product = $productsDB->deleteById($_GET['id']);

header('Location: index.php');
exit();
