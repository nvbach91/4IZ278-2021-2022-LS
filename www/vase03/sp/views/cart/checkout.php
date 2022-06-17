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
                <div class="features_items">
                    <h2 class="title text-center">Cart</h2>


                    <?php if ($result): ?>

                        <p>Order is processed. We will call you back.</p>

                    <?php else: ?>

                        <p>Selected products: <?php echo $totalQuantity; ?>, for the amount: <?php echo $totalPrice; ?>, $.</p><br/>

                        <div class="col-sm-4">
                            <?php if (isset($errors) && is_array($errors)): ?>
                                <ul>
                                    <?php foreach ($errors as $error): ?>
                                        <li> - <?php echo $error; ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>

                            <p>To place an order, fill out the form. Our manager will contact you.</p>

                            <div class="login-form">
                                <form action="#" method="post">

                                    <p>Your name</p>
                                    <input type="text" name="userName" placeholder="" value="<?php echo htmlspecialchars($userName); ?>"/>

                                    <p>Phone</p>
                                    <input type="text" name="userPhone" placeholder="" value="<?php echo htmlspecialchars($userPhone); ?>"/>

                                    <p>E-mail</p>
                                    <input type="text" name="userEmail" placeholder="" value="<?php echo htmlspecialchars($userEmail); ?>"/>

                                    <p>Country</p>
                                    <input type="text" name="userCountry" placeholder="" value="<?php echo htmlspecialchars($userCountry); ?>"/>

                                    <p>City</p>
                                    <input type="text" name="userCity" placeholder="" value="<?php echo htmlspecialchars($userCity); ?>"/>
                                    
                                    <p>Province</p>
                                    <input type="text" name="userProvince" placeholder="" value="<?php echo htmlspecialchars($userProvince); ?>"/>

                                    <p>Comment</p>
                                    <input type="text" name="userComment" placeholder="Сообщение" value="<?php echo htmlspecialchars($userComment); ?>"/>

                                    <br/>
                                    <br/>
                                    <input type="submit" name="submit" class="btn btn-default" value="Checkout" />
                                </form>
                            </div>
                        </div>

                    <?php endif; ?>

                </div>

            </div>
        </div>
    </div>
</section>

<?php include ROOT . '/views/layout/footer.php'; ?>