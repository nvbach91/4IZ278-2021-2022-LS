<?php
session_start();
require __DIR__ . '/db.php';

if (!isset($_COOKIE['name'])) {
    header('Location: login.php');
    exit();
}

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

$sql = "SELECT * FROM goods WHERE id = :id";
$stmt = $db->prepare($sql);
$stmt->execute(['id' => $_GET['id']]);
$goods = $stmt->fetch();

if (!$goods) {
    exit("Item does not exist!");
}
if (in_array($goods["id"], $_SESSION['cart'])) {
    exit("Item is already in cart!");
}
array_push($_SESSION['cart'], $goods["id"]);
header('Location: cart.php');
exit();
