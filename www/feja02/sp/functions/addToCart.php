<?php
session_start();

if (!empty($_POST)) {
    $productId = $_POST["id"];
    $productquantity = $_POST["quantity"];
    $productPrice = $_POST["price"];
    $productUrl = $_POST["url"];

    if (!isset($_SESSION["cart"])) {
        $_SESSION["cart"] = [];
    }
    $productExists = false;
    foreach ($_SESSION["cart"] as $key => $data) {
        if ($data["id"] == $productId) {
            $productExists = true;
            if ($_SESSION["cart"][$key]["quantity"] + $productquantity > 100)
                $_SESSION["cart"][$key]["quantity"] = 100;
            else $_SESSION["cart"][$key]["quantity"] += $productquantity;
        }
    }

    if (!$productExists) {
        $cartItem = ["id" => $productId, "price" => $productPrice, "quantity" => $productquantity];
        $_SESSION["cart"][] = $cartItem;
    }
}

header("Location: ../" . $productUrl);

?>
