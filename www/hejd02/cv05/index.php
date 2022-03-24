<?php
require "./models/DB.php";
require "./models/OrdersDB.php";
require "./models/UsersDB.php";
require "./models/ProductsDB.php";

$orders = new OrdersDB();
$orders->configInfo();
$orders->create(['first_name' => 'daniel', 'last_name' => 'hejna', 'products' => 'xanax', 'total' => 1500]);
$orders->create(['first_name' => 'daniel', 'last_name' => 'hejna', 'products' => 'xanax', 'total' => 1500]);
$orders->create(['first_name' => 'daniel', 'last_name' => 'hejna', 'products' => 'xanax', 'total' => 1500]);

$users = new UsersDB();
$users->create(['first_name' => 'daniel', 'last_name' => 'hejna', 'email' => 'hejd02@vse.cz', 'pwd' => password_hash("heslicko", PASSWORD_DEFAULT)]);
echo ($users->fetchById(1)['email']);

$products = new ProductsDB();
$products->create(['product_name' => 'Xanax', 'product_category' => 'lék', 'product_price' => 1500]);
$products->create(['product_name' => 'Bromazepam', 'product_category' => 'lék', 'product_price' => 1299]);

foreach ($products->fetchAll() as $product) {
    var_dump($product);
    echo "<br>";
}
echo ($products->fetchById(1)['product_price'])."<br>";
$products->updateById(1, 'product_price', 1600);
echo ($products->fetchById(1)['product_price'])."<br>";
$products->deleteById(1);
echo "<br>";

