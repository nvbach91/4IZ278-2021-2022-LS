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
                                    <h4 class="panel-title">
                                        <a href="/~vase03/sp/category/<?php echo $categoryItem['id']; ?>">
                                            <?php echo htmlspecialchars($categoryItem['name']); ?>
                                        </a>
                                    </h4>
                                </div>
                            </div>
                        <?php endforeach; ?>

                    </div>
                </div>
            </div>

            <div class="col-sm-9 padding-right">
                <div class="product-details">
                    <!--product-details-->
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="view-product">
                                <img src="<?php echo Product::getImage($product['id']); ?>" alt="" />
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div class="product-information">
                                <!--/product-information-->
                                <img src="/~vase03/sp/images/product-details/new.jpg" class="newarrival" alt="" />
                                <h2><?php echo htmlspecialchars($product['name']); ?></h2>
                                <p>Code: <?php echo htmlspecialchars($product['code']); ?></p>
                                <span>
                                    <span>US $<?php echo htmlspecialchars($product['price']); ?></span>
                                    <label>Quanntity:</label>
                                    <input type="text" id="quantity" value="3" />
                                    <button type="button" data-id="<?php echo $product['id'];?>" class="btn btn-fefault add-to-cart">
                                        <i class="fa fa-shopping-cart"></i>
                                        Add to cart
                                    </button>
                                </span>
                                <p><b>Availability:</b> In stock</p>
                                <p><b>Condition:</b> New</p>
                                <p><b>Manufacturer:</b> <?php echo htmlspecialchars($product['brand']); ?></p>
                            </div>
                            <!--/product-information-->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <h5>Description</h5>
                            <?php echo htmlspecialchars($product['description']); ?>
                        </div>
                    </div>
                </div>
                <!--/product-details-->

            </div>
        </div>
    </div>
</section>


<br />
<br />
<?php include ROOT . '/views/layout/footer-view.php'; ?>