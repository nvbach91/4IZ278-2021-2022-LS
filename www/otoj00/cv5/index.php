<?php
require "objects/DB.php";
require "objects/OrdersDB.php";
require "objects/UsersDB.php";
require "objects/ProductsDB.php";


$users = new UsersDB();
$users->create(['name' => 'Dave', 'age' => 42,"dave@email.com"]);
$users->create(['name' => 'David', 'age' => 35,"david@email.eu"]);
$users->fetch("dave@email.com");
$users->save();
$users->delete("dave@email.com");
$users->configInfo();
echo "<br>";

$products = new ProductsDB();
$products->create(['name' => 'Broom of Harry', 'price' => 4500]);
$products->create(['name' => 'Wand of Albuss', 'price' => 7690]);
echo "<br>";

$orders = new OrdersDB();
$orders->configInfo();
echo "<br>";
echo $orders, "<br>";
$orders->create(['number' => 42, 'date' => '2019-03-08']);
echo $orders, "<br>";
