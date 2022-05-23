<?php
$res = $productsDB->fetchById($productId);

if (!$res) {
    exit(404);
}

$products = $res->fetchAll()[0];

$name = $products['name'];
$price = $products['price'];
$stock = $products['stock'];
$img = $products['img'];
$description = $products['info'];
$alcVol = $products['alc_vol'];
$size = $products['bottle_size'];
$origin = $products['origin'];
$catId = $products['category_id'];
$lastModified = $products['date_modified'];
