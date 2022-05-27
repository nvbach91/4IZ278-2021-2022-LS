<?php
if ($_GET['action'] == 'deleteAll') {
    require './utils/clear_cart.php';
    header('Location: cart.php');
    exit();
}