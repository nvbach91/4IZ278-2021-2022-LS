<?php require './ProductsDB.php' ?>
<?php
    $productsDB = new ProductsDB();
    $products = $productsDB -> fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
</head>
<body>
    <?php foreach($products as $product):?>
        <div>
            <?php echo $product['name'];?>
            <br>
            <?php echo $product['price'];?>
    </div>
    <?php endforeach ; ?>
</body>
</html>