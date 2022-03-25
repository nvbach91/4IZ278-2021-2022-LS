<?php require './productsDB.php' ?>

<?php 
$productsDB = new ProductsDB();
$products = $productsDB->fetchById(1);

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
    <?php foreach($products as $product): ?>
        <div>
            <?php echo "------------"; ?>
            <br>
            <?php echo "Product id: " . $product['product_id']; ?>
            <br>
            <?php echo "Product name: " . $product['name']; ?>
            <br>
            <?php echo "Listed price: " . $product['price']; ?>
            <br>
        </div>
    <?php endforeach; ?>
</body>
</html>