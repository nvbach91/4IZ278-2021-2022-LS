<?php
$title = 'Homepage';
session_start();
require  __DIR__ . '/db/UsersDB.php';
require  __DIR__ . '/db/CategoriesDB.php';
require  __DIR__ . '/db/ProductsDB.php';
include __DIR__ . '/incl/head.php'; 
include __DIR__ . '/incl/nav.php';
include __DIR__ . '/components/display_categories.php';
include __DIR__ . '/components/display_products.php';
?>

<<body class="d-flex flex-column min-vh-100">
<?echo $_SESSION['user_level']?>;
    
    





        
</body>
<?php include __DIR__ . '/incl/footer.php' ?>
