<?php
if (!empty($_POST)) {
    $newQty = $_POST['newQty'];

    if ($_GET['action'] == 'update') {
        foreach ($_SESSION['shopping_cart'] as $keys => $values) {
            if ($values['item_id'] == $_GET['id']) {
                $_SESSION['shopping_cart'][$keys]['item_qty'] = $newQty;
                header('Location: cart.php');
                exit();
            }
        }
    }
}