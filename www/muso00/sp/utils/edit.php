<?php
    $name = $_POST['name'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $img = $_POST['img'];
    $description = $_POST['info'];
    $alcVol = $_POST['alc_vol'];
    $size = $_POST['bottle_size'];
    $origin = $_POST['origin'];
    $catId = $_POST['category_id'];

    $productsDB->updateAllbyId($name, $price, $stock, $img, $description, $alcVol, $size, $origin, $catId, $productId);