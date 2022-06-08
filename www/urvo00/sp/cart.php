<?php
if (session_status() !== PHP_SESSION_ACTIVE) session_start();
require __DIR__ . '/db/ProductsDB.php';
$ids = @$_SESSION['cart'];
if (is_array($ids) && count($ids)) {
    $question_marks = str_repeat('?,', count($ids) - 1) . '?';


    $productsDB = new ProductsDB();
    $products = $productsDB->fetchForCart($question_marks, $ids);
    $sum = $productsDB->fetchForCartSum($question_marks, $ids);
}
?>



<?php include __DIR__ . '/incl/head.php' ?>
<?php include __DIR__ . '/incl/navbar.php' ?>
<main class="container">
    <h1>Shopping cart</h1>
    Total products selected: <?= @count($products) ?>
    <br><br>
    <a href="index.php">Back to shopping</a>
    <br><br>
    <?php if (@$products) : ?>
        <div class="products">
            <?php foreach ($products as $row) : ?>
                <div class="card product" style="width: calc(100% / 3)">
                <div class="card-img-top" style="background-image: url(<?php echo $row['img']; ?>)"></div>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $row['name'] ?></h5>
                        <div class="card-subtitle"><?php echo $row['price'] ?></div>
                        <div class="card-text"><?php echo $row['description'] ?></div>
                        <form action="./utils/remove-item.php" method="POST">
                            <input class="d-none" name="id" value="<?php echo $row['product_id'] ?>">
                            <button type="submit" class="btn btn-danger">Remove</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else : ?>
        <h5>Empty</h5>
    <?php endif; ?>
</main>
<?php include __DIR__ . '/incl/foot.php'; ?>