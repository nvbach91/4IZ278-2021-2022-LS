<?php include ROOT . '/views/layout/header.php'; ?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">
                    <h2>Catalog</h2>
                    <div class="panel-group category-products">
                        <?php foreach ($categories as $categoryItem) : ?>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"><a href="/~vase03/sp/category/<?php echo $categoryItem['id']; ?>"><?php echo htmlspecialchars($categoryItem['name']); ?></a></h4>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <div class="col-sm-9 padding-right">
                <div class="features_items">
                    <!--features_items-->
                    <h2 class="title text-center">Latest products</h2>
                    <?php foreach ($latestProducts as $product): ?>
                    <div class="col-sm-4">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="<?php echo Product::getImage($product['id']); ?>" alt="" />
                                    <h2><?php echo htmlspecialchars($product['price']);?>$</h2>
                                    <p>
                                        <a href="/~vase03/sp/product/<?php echo $product['id'];?>"><?php echo htmlspecialchars($product['name']);?></a>
                                    </p>
                                    <a href="#" quantity='1' data-id="<?php echo $product['id'];?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                </div>
                                <?php if ($product['is_new']):?>
                                    <img src="/~vase03/sp/template/images/home/new.png" class="new" alt="">
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach;?>
                </div>
                <!--features_items-->

                
                <!--/recommended_items-->

            </div>
        </div>
    </div>
</section>

<?php include ROOT . '/views/layout/footer.php'; ?>