<?php $title = 'Products';
session_start(); ?>
<?php include __DIR__ . '/db/ProductsDB.php'; ?>
<?php include __DIR__ . '/db/CategoriesDB.php'; ?>
<?php include __DIR__ . '/incl/head.php'; ?>
<?php include __DIR__ . '/incl/nav.php'; ?>
<?php require __DIR__ . '/components/categoryDisplay.php'; ?>
<?php require __DIR__ . '/components/productDisplay.php'; ?>
<?php include __DIR__ . '/incl/foot.php'; ?>