<?php
if ($_GET['action'] == 'delete') {
    foreach ($_SESSION['shopping_cart'] as $keys => $values) {
        if ($values['item_id'] == $_GET['id']) {
            unset($_SESSION['shopping_cart'][$keys]);
            if (sumArrayVars($_SESSION['shopping_cart'], 'item_qty') == 0) {
                require './utils/clear_cart.php';
            }
            header('Location: cart.php');
        }
    }
}