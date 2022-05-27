<?php
if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    $productId = intval($_GET['id']);
    $res = $productsDB->deleteById($productId);
}
