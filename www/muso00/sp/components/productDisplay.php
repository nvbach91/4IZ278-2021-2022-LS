<?php
$productsDB = new ProductsDB();

if (isset($catId)) {
    $products = $productsDB->fetchByCatId($catId);
} else {
    $products = $productsDB->fetchAll();
}

?>
<section class="d-flex justify-content-center">
    <div class="row w-75 p-3">
        <?php foreach ($products as $product) : ?>
            <div class="col-4 mb-4 box-wrapper">
                <div class="card h-100 product">
                    <div class="col md-4 px-0 mx-auto mt-2"><a href="./product.php?id=<?php echo $product['product_id']; ?>"><img class="card-img-top product-image img-fluid" src="<?php echo $product['img']; ?>" alt="product-image"></a></div>
                    <div class="card-body">
                        <h4 class="card-title"><a href="./product.php?id=<?php echo $product['product_id']; ?>"><?php echo $product['name']; ?></a></h4>
                        <p class="card-text text-secondary"><?php echo trim(substr($product['info'],0, 100)); ?>...</p>
                        <h5>$<?php echo number_format($product['price'], 2); ?></h5>
                    </div>
                    <div class="card-footer text-center">
                        <a class="btn btn-outline-secondary" href="./product.php?id=<?php echo $product['product_id']; ?>">More info</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>