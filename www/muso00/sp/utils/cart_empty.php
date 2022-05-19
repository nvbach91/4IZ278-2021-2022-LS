<?php
if (!isset($_SESSION['shopping_cart'])) {
    exit('<div class="alert alert-warning text-center" role="alert">Your cart is empty. <a href="./products.php" class="stretched-link link-warning">Start shopping</a></div>');
}