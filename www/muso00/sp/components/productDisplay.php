<?php
$productsDB = new ProductsDB();
$nItemsPerPagination = 3;

if (isset($_GET['offset'])) {
    $offset = (int)$_GET['offset'];
} else {
    $offset = 0;
}

if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    $productId = $_GET['id'];
    $res = $productsDB->deleteById($productId);
}

if (isset($catId)) {
    $products = $productsDB->fetchByIdPagination($catId, $nItemsPerPagination, $offset);
    $count = $productsDB->getRowsNumberById($catId);
} else {
    $products = $productsDB->fetchAllPagination($nItemsPerPagination, $offset);
    $count = $productsDB->getRowsNumber();
}

?>
<section class="d-flex justify-content-center">
    <div class="row w-75 p-3">
        <?php foreach ($products as $product) : ?>
            <div class="col-4 mb-4 box-wrapper">
                <div class="card h-100 product">
                    <div class="col md-4 px-0 mx-auto mt-3">
                        <a href="./product.php?id=<?php echo $product['product_id']; ?>"><img class="card-img-top product-image img-fluid" src="<?php echo $product['img']; ?>" alt="product-image"></a>
                    </div>
                    <div class="card-body">
                        <h4 class="card-title"><a href="./product.php?id=<?php echo $product['product_id']; ?>"><?php echo $product['name']; ?></a></h4>
                        <p class="card-text text-secondary"><?php echo trim(substr($product['info'], 0, 100)); ?>...</p>
                        <div class="align-text-bottom">
                            <h5 align-text-bottom>$<?php echo number_format($product['price'], 2); ?></h5>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <a class="btn btn-outline-secondary" href="./product.php?id=<?php echo $product['product_id']; ?>">More info</a>
                        <?php if (isset($_SESSION['user_privilege']) && $_SESSION['user_privilege'] > 2) : ?>
                            <a class="btn btn-warning btn-admin" href="./edit-product.php?id=<?php echo $product['product_id']; ?>"><i class="bi bi-pencil-fill"></i></a>
                            <a class="btn btn-danger btn-admin" href="./products.php?action=delete&id=<?php echo $product['product_id']; ?>"><i class="bi bi-x-lg"></i></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>
<section>
    <div class="container d-flex justify-content-center mb-4">
        <div class="row">
            <ul class="pagination">
                <?php for ($i = 1; $i <= ceil($count / $nItemsPerPagination); $i++) { ?>
                    <li class="page-item <?php echo $offset / $nItemsPerPagination + 1 == $i ? "active" : ""; ?>"><a class="page-link" href="./products.php?offset=<?php echo ($i - 1) * $nItemsPerPagination; ?><?php echo isset($catId) ? "&category_id=$catId" : ""; ?>">
                            <?php echo $i; ?>
                        </a></li>
                <?php } ?>
        </div>
    </div>
</section>