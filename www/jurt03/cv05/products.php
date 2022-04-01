<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
</head>
<body>
    
<?php 
require './ProductsDB.php';
$products = new ProductsDB();
$products->create(['name' => 'Pomeranc', 'productID' => 1, 'price' => '39,90']);
$products->fetch(1);
$products->delete(1);
?>

</body>
</html>