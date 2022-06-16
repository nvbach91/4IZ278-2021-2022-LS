<?php require './utils/pagination.php'; ?>

<div class="wrapper">
<div class="mb-2" style="width: 60%; margin:auto;">
            <ul class="pagination">
                <?php for ($i = 1; $i <= ceil($count / $nItemsPerPagination); $i++) { ?>
                    <li class="page-item <?php echo $offset / $nItemsPerPagination + 1 == $i ? "active" : ""; ?>"><a class="page-link" href="./products.php?offset=<?php echo ($i - 1) * $nItemsPerPagination; ?><?php echo isset($categories_id) ? "&category_id=$categories_id" : ""; ?>">
                            <?php echo $i; ?>
                        </a></li>
                <?php } ?>
            </ul>
    </div>
</div>
<div class="d-flex justify-content-center">
    <div class="row w-75 p-2">
        <?php foreach ($products as $product) : ?>
            <div class="col-4 mb-4 box-wrapper">
                <div class="card h-100 product">
                    <div class="col md-4 px-0 mx-auto mt-3">
                        <a href="./product_detail.php?id=<?php echo $product['product_id']; ?>"><img class="card-img-top product-image img-fluid" src="<?php echo $product['img_link']; ?>" alt="product-image"></a>
                    </div>
                    <div class="card-body">
                        <h4 class="card-title"><a href="./product_detail.php?id=<?php echo $product['product_id']; ?>"><?php echo trim(substr($product['name'], 0, 20)); ?></a></h4>
                        <p class="card-text text-black"><?php echo trim(substr($product['product_info'], 0, 50)); ?>...</p>
                        <div class="align-text-bottom">
                            <h5>$<?php echo number_format($product['price'], 2); ?></h5>
                        </div>
                        <a href="./product_detail.php?id=<?php echo $product['product_id']; ?>">More info</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
</div>

