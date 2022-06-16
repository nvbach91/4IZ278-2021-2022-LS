<?php
session_start();
require "database/database.php";

$numCart = 0;
if (!isset($_SESSION["cart"])) $_SESSION["cart"] = [];
foreach ($_SESSION["cart"] as $key => $data) $numCart += $data["quantity"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./resources/logo_transparent.png" type="image/x-icon"/>
    <link href="./css/main.css" rel="stylesheet">
    <link href="./bootstrap/bootstrap.css" rel="stylesheet">
    <script src="./bootstrap/bootstrap.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" ></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <title>SnusWorld</title>
</head>
<body class="d-flex flex-column min-vh-100">
    <nav class="navbar navbar-dark navbar-expand-lg sticky-top bg-primary">
        <div class="container-fluid w-75">
            <div class="justify-content-start">
                <a href="./" class="navbar-brand">
                    <img src="./resources/logo_transparent.png" alt="index" width=125>
                </a>
            </div>
            <div class="justify-content-center">
                <ul class="navbar-nav ml-auto topnav text-underline-hover h5">
                    <li class="nav-item">
                        <a class="nav-link btn" href="./?brand=1">Lundgrens</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn" href="./?brand=2">Ettan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn" href="./?brand=3">General</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn" href="./?brand=4">Göteborgs Rapé</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle btn" href="#" role="button" id="navbarDropdownBrands" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Other brands
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownBrands">
                            <a class="dropdown-item" href="./?brand=5">Oden</a>
                            <a class="dropdown-item" href="./?brand=6">Siberia</a>
                            <a class="dropdown-item" href="./?brand=7">Islay Whisky</a>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="justify-content-end">
                <ul class="navbar-nav ml-auto topnav text-underline-hover h5">
                    <?php if (empty($_SESSION["login_id"])): ?>
                        <li>
                            <a class="nav-link btn" href="login">Login</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle btn" href="#" role="button" id="navbarDropdownAccount" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Account
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownAccount">
                                <?php if (!empty($_SESSION["login_role"] && $_SESSION["login_role"] == 1)) echo '<a class="dropdown-item" href="./panel">Admin Panel</a>'; ?>
                                <a class="dropdown-item" href="./myorders">My Orders</a>
                                <a class="dropdown-item" href="./account">Account Settings</a>
                                <a class="dropdown-item" href="./functions/logout">Logout</a>
                            </div>
                        </li>
                    <?php endif; ?>
                    <li class="navbar-item">
                        <a class="nav-link btn" href="./cart">
                            <img src="./resources/cart32.png" alt="cart">
                            <span class="badge-dark"><?php echo $numCart; ?></span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>