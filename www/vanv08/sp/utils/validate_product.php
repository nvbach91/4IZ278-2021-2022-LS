<?php
$ideal_price = '/^(0|[1-9]\d*)(\.\d{2})?$/';

if (strlen($name) < 2) {
    array_push($errors, 'Name of the product is too short');
}
if ($_POST['price'] && !preg_match($ideal_price, $price)) {
    array_push($errors, 'Invalid price format');
}
if(empty($_POST['price'])){
    array_push($errors,'Please input price');
}
if (strlen($product_info) < 10) {
    array_push($errors, 'Product information is too short');
}
if (filter_var($_POST['img_link'], FILTER_VALIDATE_URL) === FALSE) {
    array_push($errors,'Invalid link');
}
