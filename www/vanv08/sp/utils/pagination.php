<?php
$productsDB = new productsDB();
$nItemsPerPagination = 6;


// if the get offset is set
if (isset($_GET['offset'])) {
    // save the offset in a var
    $offset = (int)$_GET['offset'];
    // else...
} else {
    // set offset 0
    $offset = 0;
}


if (isset($categories_id)) {
    $products = $productsDB->fetchByIdPagination($categories_id, $nItemsPerPagination, $offset);
    $count = $productsDB->getRowsNumberById($categories_id);
} else {
    $products = $productsDB->fetchAllPagination($nItemsPerPagination, $offset);
    $count = $productsDB->getRowsNumber();
}