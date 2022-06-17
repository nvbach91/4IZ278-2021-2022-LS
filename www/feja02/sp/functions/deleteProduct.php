<?php
session_start();

require "../database/database.php";
require "../database/productsdb.php";
require "../functions/adminCheck.php";

if (empty($_GET["id"])) {
    header("Location: ../");
    exit();
}

$productsDb = new ProductsDB();
$productsDb->deleteById($_GET["id"]);
header("Location: ../deleteProduct?success=1");
?>
