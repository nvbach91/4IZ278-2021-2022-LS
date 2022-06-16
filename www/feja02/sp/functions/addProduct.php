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
    "name" => $_POST["name"],
    "descriptionShort" => $_POST["descriptionShort"],
    "descriptionLong" => $_POST["descriptionLong"],
    "brandId" => $_POST["brandId"],
    "nicotine" => $_POST["nicotine"],
    "pouches" => $_POST["pouches"],
    "price" => $_POST["price"],
    "image" => $_POST["image"]
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
