<?php
$productsDB = new ProductsDB();
$nItemsPerPagination = 3;

// if the get offset is set
if (isset($_GET['offset'])) {
    // save the offset in a var
    $offset = (int)$_GET['offset'];
    // else...
} else {
    // set offset 0
    $offset = 0;
}


if (isset($catId)) {
    $products = $productsDB->fetchByIdPagination($catId, $nItemsPerPagination, $offset);
    $count = $productsDB->getRowsNumberById($catId);
} else {
    $products = $productsDB->fetchAllPagination($nItemsPerPagination, $offset);
    $count = $productsDB->getRowsNumber();
}
