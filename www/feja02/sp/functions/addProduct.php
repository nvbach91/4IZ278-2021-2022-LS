<?php
session_start();

require "../database/database.php";
require "../database/brandsdb.php";
require "../database/productsdb.php";
require "../database/shippingdetailsdb.php";
require "../functions/adminCheck.php";

if (empty($_POST)) {
    header("Location: ../addProduct");
    exit();
}

$brandsDb = new BrandsDB();
$productsDb = new ProductsDB();

$errorList = [];
$editDetails = [
    "name" => filter_var($_POST["name"], FILTER_SANITIZE_STRING),
    "descriptionShort" => filter_var($_POST["descriptionShort"], FILTER_SANITIZE_STRING),
    "descriptionLong" => filter_var($_POST["descriptionLong"], FILTER_SANITIZE_STRING),
    "brandId" => filter_var($_POST["brandId"], FILTER_SANITIZE_STRING),
    "nicotine" => filter_var($_POST["nicotine"], FILTER_SANITIZE_STRING),
    "pouches" => filter_var($_POST["pouches"], FILTER_SANITIZE_STRING),
    "price" => filter_var($_POST["price"], FILTER_SANITIZE_STRING),
    "image" => filter_var($_POST["image"], FILTER_SANITIZE_STRING)
];

$validBrand = false;
$brands = $brandsDb->fetchAll();
foreach ($brands as $brand) {
    if ($editDetails["brandId"] == $brand["id"]) {
        $validBrand = true;
        break;
    }
}

if (!strlen($editDetails["name"])) {
    array_push($errorList, "Invalid name");
    $editDetails["name"] = "";
}
if (!strlen($editDetails["descriptionShort"])) {
    array_push($errorList, "Invalid short description");
    $editDetails["descriptionShort"] = "";
}
if (!strlen($editDetails["descriptionLong"])) {
    array_push($errorList, "Invalid long description");
    $editDetails["descriptionLong"] = "";
}
if (!$validBrand) {
    array_push($errorList, "Invalid brand");
    $editDetails["brandId"] = "";
}
if (empty($editDetails["nicotine"]) || ($editDetails["nicotine"] < 0 || $editDetails["nicotine"] > 200)) {
    array_push($errorList, "Invalid nicotine");
    $editDetails["nicotine"] = "";
}
if (empty($editDetails["pouches"]) || ($editDetails["pouches"] <= 0 || $editDetails["pouches"] > 1000)) {
    array_push($errorList, "Invalid pouches");
    $editDetails["pouches"] = "";
}
if (empty($editDetails["price"]) || $editDetails["price"] < 0) {
    array_push($errorList, "Invalid price");
    $editDetails["price"] = "";
}
if (!strlen($editDetails["image"])) {
    array_push($errorList, "Invalid image URL");
    $editDetails["image"] = "";
}

if (empty($errorList)) {
    $productsDb->create($editDetails);
    $_SESSION["errorList"] = [];
    $_SESSION["editDetails"] = [];
    header("Location: ../addProduct?success=1");
}
else {
    $_SESSION["errorList"] = $errorList;
    $_SESSION["editDetails"] = $editDetails;
    header("Location: ../addProduct");
}

?>
