<?php
session_start();

require "../database/database.php";
require "../database/ordersdb.php";
require "../database/ordereditemsdb.php";
require "../database/shippingdetailsdb.php";
require "../functions/userCheck.php";

if (empty($_SESSION["cart"])) header("Location: ../");
if (empty($_POST)) header("Location: ../");

$errorList = [];

$userId = $_SESSION["login_id"];
$firstName = filter_var($_POST["firstName"], FILTER_SANITIZE_STRING);
$lastName = filter_var($_POST["lastName"], FILTER_SANITIZE_STRING);
$email = filter_var($_POST["email"], FILTER_SANITIZE_STRING);
$phone = filter_var($_POST["phone"], FILTER_SANITIZE_STRING);
$country = filter_var($_POST["country"], FILTER_SANITIZE_STRING);
$street = filter_var($_POST["street"], FILTER_SANITIZE_STRING);
$city = filter_var($_POST["city"], FILTER_SANITIZE_STRING);
$zip = filter_var($_POST["zip"], FILTER_SANITIZE_STRING);

if (empty($firstName) || !preg_match("/^[a-zA-z]*$/", $firstName)) array_push($errorList, "Invalid first name");
if (empty($lastName) || !preg_match("/^[a-zA-z]*$/", $lastName)) array_push($errorList, "Invalid last name");
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) array_push($errorList, "Invalid e-mail");
if (!preg_match('/^[0-9+]{9,13}\z/', $phone)) array_push($errorList, "Invalid phone");
if (strlen($country) < 4) array_push($errorList, "Invalid country");
if (!strlen($street)) array_push($errorList, "Invalid street");
if (!strlen($city)) array_push($errorList, "Invalid city");
if (!strlen($zip)) array_push($errorList, "Invalid zip");

$shippingDetails = [
    "userId" => $_SESSION["login_id"],
    "firstName" => $firstName,
    "lastName" => $lastName,
    "email" => $email,
    "phone" => $phone,
    "country" => $country,
    "street" => $street,
    "city" => $city,
    "zip" => $zip
];

if (empty($errorList)) {
    $ordersDb = new OrdersDB();
    $shippingDb = new ShippingDetailsDB();
    $orderedItemsDb = new OrderItemsDB();
    
    $total = $_SESSION["cartTotal"];
    $shippingDb->create($shippingDetails);
    $ordersDb->create(["user_id" => $_SESSION["login_id"], "shipping_id" => $shippingDb->fetchLastId(), "total" => $total]);
    $orderId = $ordersDb->fetchLastId();

    foreach($_SESSION["cart"] as $key => $data) {
        $orderedItemsDb->create([
            "order_id" => $orderId,
            "product_id" => $data["id"],
            "quantity" => $data["quantity"],
            "total" => $data["price"] * $data["quantity"]
        ]);
    }

    mail($email, "SnusWorld - Order placed", "Thank you for your order!");
    $_SESSION["errorList"] = null;
    $_SESSION["errorDetails"] = null;
    $_SESSION["cart"] = [];
    header("Location: ../order?id=" . $orderId);
}
else {
    $_SESSION["errorList"] = $errorList;
    $_SESSION["errorDetails"] = $shippingDetails;
    header("Location: ../checkout");
}
?>
