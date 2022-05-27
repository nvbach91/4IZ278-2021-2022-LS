<?php
$title = 'Products';
$pageActive = 2;
session_start();
?>
<?php include __DIR__ . '/db/ProductsDB.php'; ?>
<?php include __DIR__ . '/db/CategoriesDB.php'; ?>
<?php include __DIR__ . '/incl/head.php'; ?>
<?php include __DIR__ . '/incl/nav.php'; ?>
<main>
    <?php require __DIR__ . '/components/categoryDisplay.php'; ?>
    <?php require __DIR__ . '/components/productDisplay.php'; ?>
</main>
<?php include __DIR__ . '/incl/foot.php'; ?>