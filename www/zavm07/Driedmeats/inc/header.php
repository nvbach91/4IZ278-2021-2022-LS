<?php session_start()?>
<?php  require 'db/Database.php'?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <title>Driedmeats</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="./res/icons/favicon.ico" type="image/x-icon"/>
    <link rel="shortcut icon" href="./res/icons/favicon.ico" type="image/x-icon"/>
    <link href="./bootstrap/css/bootstrap.css" rel="stylesheet">
    <script src="./bootstrap/js/bootstrap.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</head>
<body class="d-flex flex-column min-vh-100" style="color: white">
<nav class="navbar navbar-dark navbar-expand-lg sticky-top bg-primary">
<div class="container-fluid">
    <a class="navbar-brand" href="index.php">
        <img src="res/logo.png" alt="index.php">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav h5 ms-lg-auto mb-lg-0 mb-2" style="">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="./index.php" role="button" data-bs-toggle="dropdown">Kategorie</a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item mb-1" href="./products.php?category=hovezi">Hovězí</a></li>
                <li><a class="dropdown-item mb-1" href="./products.php?category=veprove">Vepřové</a></li>
                <li><a class="dropdown-item mb-1" href="./products.php?category=kruti">Krůtí</a></li>
                <li><a class="dropdown-item mb-1" href="./products.php?category=zverinove">Zvěřinové</a></li>
            </ul>
        </li>
        <?php if (empty($_SESSION['lg_email'])): ?>
        <li class="nav-item">
            <a class="nav-link" href="login.php">Přihlásit se</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="signup.php">Registrace</a>
        </li>
        <?php endif;?>

        <?php if (!empty($_SESSION['lg_email'])): ?>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Účet</a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item mb-1" href="userOrders.php">Objednávky</a></li>
                    <li><a class="dropdown-item mb-1" href="changeUserInfo.php">Osobní údaje</a></li>
                    <li><a class="dropdown-item mb-1" href="changePassword.php">Změna hesla</a></li>

                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="functions/logout.php">Odhlásit se</a>
            </li>
        <?php endif;?>
        <?php if (!empty($_SESSION['lg_privileges'])&&$_SESSION['lg_privileges']==2):?>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Admin menu</a>
                <ul class="dropdown-menu">
                    <li ><a class="dropdown-item mb-1" href="createItem.php">Vytvořit produkt</a></li>
                    <li ><a class="dropdown-item mb-1" href="aggregation.php">Obrat</a></li>
                </ul>
            </li>
        <?php endif;?>
        <li class="nav-item">
            <a class="nav-link" href="cart.php"><img src="./res/icons/cart.svg" width="23" height="23"></a>
        </li>

    </ul>
    </div>
</div>
</nav>
