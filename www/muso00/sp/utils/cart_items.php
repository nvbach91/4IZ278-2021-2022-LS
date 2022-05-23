<?php
// if session shopping cart set, then...
if (isset($_SESSION['shopping_cart'])) {
    // item array id(s),
    $itemArrayId = array_column($_SESSION['shopping_cart'], 'item_id');
    // if current item is not in cart
    if (!in_array($_GET['id'], $itemArrayId)) {
        // count number of items
        $count = count($_SESSION['shopping_cart']);
        // put item in array an array
        $itemArray = array(
            'item_id' => $id,
            'item_qty' => $qty,
            'item_price' => $price,
        );
        // save array in the session where index is the count.
        $_SESSION['shopping_cart'][$count] = $itemArray;
        // else... 
    } else {
        // echo error.
        echo 'Item already added';
    }
    // else (session not set)...
} else {
    // put item in the array
    $itemArray = array(
        'item_id' => $id,
        'item_qty' => $qty,
        'item_price' => $price,
    );
    // set up session variable shopping cart
    $_SESSION['shopping_cart'][0] = $itemArray;
}
