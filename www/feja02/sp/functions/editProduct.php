<?php
session_start();

require "../database/database.php";
require "../database/brandsdb.php";
require "../database/productsdb.php";
require "../database/shippingdetailsdb.php";
require "../functions/adminCheck.php";

if (empty($_POST)) {
    header("Location: ../");
    exit();
}

$brandsDb = new BrandsDB();
$productsDb = new ProductsDB();

$errorList = [];

$editDetails = [
    "name" => filter_var($_POST["name"], FILTER_SANITIZE_STRING),
    "descriptionShort" => filter_var($_POST["descriptionShort"], FILTER_SANITIZE_STRING),
    "descriptionLong" => filter_var($_POST["descriptionLong"], FILTER_SANITIZE_STRING),
    "brand" => filter_var($_POST["brand"], FILTER_SANITIZE_STRING),
    "nicotine" => filter_var($_POST["nicotine"], FILTER_SANITIZE_STRING),
    "pouches" => filter_var($_POST["pouches"], FILTER_SANITIZE_STRING),
    "price" => filter_var($_POST["price"], FILTER_SANITIZE_STRING),
    "image" => filter_var($_POST["image"], FILTER_SANITIZE_STRING)
];

$validBrand = false;
$brands = $brandsDb->fetchAll();
foreach ($brands as $brand) {
    if ($editDetails["brand"] == $brand["id"]) {
        $validBrand = true;
        break;
    }
}

$product = $productsDb->fetchById($_POST["id"])[0];

if (!strlen($editDetails["name"])) {
    array_push($errorList, "Invalid name");
    $editDetails["name"] = $product["name"];
}
if (!strlen($editDetails["descriptionShort"])) {
    array_push($errorList, "Invalid short description");
    $editDetails["descriptionShort"] = $product["description_short"];
}
if (!strlen($editDetails["descriptionLong"])) {
    array_push($errorList, "Invalid long description");
    $editDetails["descriptionLong"] = $product["description_long"];
}
if (!$validBrand) {
    array_push($errorList, "Invalid brand");
    $editDetails["brand"] = $product["brand_id"];
}
if (empty($editDetails["nicotine"]) || ($editDetails["nicotine"] < 0 || $editDetails["nicotine"] > 200)) {
    array_push($errorList, "Invalid nicotine");
    $editDetails["nicotine"] = $product["nicotine"];
}
if (empty($editDetails["pouches"]) || ($editDetails["pouches"] <= 0 || $editDetails["pouches"] > 1000)) {
    array_push($errorList, "Invalid pouches");
    $editDetails["pouches"] = $product["pouches"];
}
if (empty($editDetails["price"]) || $editDetails["price"] < 0) {
    array_push($errorList, "Invalid price");
    $editDetails["price"] = $product["price"];
}
if (!strlen($editDetails["image"])) {
    array_push($errorList, "Invalid image URL");
    $editDetails["image"] = $product["image"];
}

if (empty($errorList)) {
    if ($editDetails["name"] != $product["name"]) $productsDb->updateById($_POST["id"], "name", $editDetails["name"]);
    if ($editDetails["descriptionShort"] != $product["description_short"]) $productsDb->updateById($_POST["id"], "description_short", $editDetails["descriptionShort"]);
    if ($editDetails["descriptionShort"] != $product["description_long"]) $productsDb->updateById($_POST["id"], "description_long", $editDetails["descriptionLong"]);
    if ($editDetails["brand"] != $product["brand_id"]) $productsDb->updateById($_POST["id"], "brand_id", $editDetails["brand"]);
    if ($editDetails["nicotine"] != $product["nicotine"]) $productsDb->updateById($_POST["id"], "nicotine", $editDetails["nicotine"]);
    if ($editDetails["pouches"] != $product["pouches"]) $productsDb->updateById($_POST["id"], "pouches", $editDetails["pouches"]);
    if ($editDetails["price"] != $product["price"]) $productsDb->updateById($_POST["id"], "price", $editDetails["price"]);
    if ($editDetails["image"] != $product["image"]) $productsDb->updateById($_POST["id"], "image", $editDetails["image"]);

    $_SESSION["errorList"] = [];
    $_SESSION["editDetails"] = [];
    header("Location: ../editProduct?success=1");
}
else {
    $_SESSION["errorList"] = $errorList;
    $_SESSION["editDetails"] = $editDetails;
    header("Location: ../editProduct?id=" . $_POST["id"]);
}

?>
