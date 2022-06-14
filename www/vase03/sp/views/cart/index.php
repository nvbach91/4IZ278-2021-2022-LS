<?php include ROOT . '/views/layout/header.php'; ?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">
                    <h2>Catalog</h2>
                    <div class="panel-group category-products">
                        <?php foreach ($categories as $categoryItem): ?>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a href="/~vase03/sp/category/<?php echo $categoryItem['id'];?>">
                                            <?php echo htmlspecialchars($categoryItem['name']);?>
                                        </a>
                                    </h4>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <div class="col-sm-9 padding-right">
                <div class="features_items">
                    <h2 class="title text-center">Cart</h2>
                    
                    <?php if ($productsInCart): ?>
                        <p>You have selected the following products:</p>
                        <table class="table-bordered table-striped table">
                            <tr>
                                <th>Code</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Delete</th>
                            </tr>
                            <?php foreach ($products as $product): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($product['code']);?></td>
                                    <td>
                                        <a href="/~vase03/sp/product/<?php echo $product['id'];?>">
                                            <?php echo htmlspecialchars($product['name']);?>
                                        </a>
                                    </td>
                                    <td><?php echo htmlspecialchars($product['price']);?></td>
                                    <td><?php echo $productsInCart[$product['id']];?></td>                        
                                    <td>
                                        <a class="btn btn-default checkout" href="/~vase03/sp/cart/delete/<?php echo $product['id'];?>">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </td>                        
                                </tr>
                            <?php endforeach; ?>
                                <tr>
                                    <td colspan="4">Total price, $:</td>
                                    <td><?php echo htmlspecialchars($totalPrice);?></td>
                                </tr>
                            
                        </table>
                        
                        <a class="btn btn-default checkout" href="/~vase03/sp/cart/checkout"><i class="fa fa-shopping-cart"></i> Checkout</a>
                    <?php else: ?>
                        <p>Cart is empty</p>
                        
                        <a class="btn btn-default checkout" href="/~vase03/sp/"><i class="fa fa-shopping-cart"></i> Back to shopping</a>
                    <?php endif; ?>

                </div>

                
                
            </div>
        </div>
    </div>
</section>

<?php include ROOT . '/views/layout/footer.php'; ?>