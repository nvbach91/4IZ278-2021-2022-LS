<?php
session_start();

if (!empty($_POST)) {
    $deleteId = 0;
    if (isset($_POST["deleteId"])) {
        $deleteId = $_POST["deleteId"];
    }
    foreach ($_SESSION["cart"] as $key => $data) {
        if ($data["id"] == $deleteId) {
            unset($_SESSION["cart"][$key]);
            break;
        }
        else {
            if (isset($_POST["quantityId" . $data["id"]])) {
                $_SESSION["cart"][$key]["quantity"] = $_POST["quantityId" . $data["id"]];
            }
        }
    }
}

header("Location: ../cart");
?>
