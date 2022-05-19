<?php
$title = 'product';
$pageActive = 2;
session_start(); ?>
<?php require __DIR__ . '/db/ProductsDB.php'; ?>
<?php include __DIR__ . '/incl/head.php'; ?>
<?php include __DIR__ . '/incl/nav.php'; ?>
<?php

if (!empty($_GET)) {
    $id = $_GET['id'];

    $productsDB = new ProductsDB();
    $res = $productsDB->fetchById($id);
    $product = $res->fetchAll()[0];
    $stock = $product['stock'];
    $price = $product['price'];
} else {
    exit('<div class="alert alert-warning text-center" role="alert">You have not chosen a product. <a href="./products.php" class="stretched-link link-warning">Start shopping</a></div>');
}

if (!empty($_POST)) {
    $qty = $_POST['qty'];

    if (isset($_SESSION['shopping_cart'])) {

        $itemArrayId = array_column($_SESSION['shopping_cart'], 'item_id');
        if (!in_array($_GET['id'], $itemArrayId)) {
            $count = count($_SESSION['shopping_cart']);
            $itemArray = array(
                'item_id' => $id,
                'item_qty' => $qty,
                'item_price' => $price,
            );
            $_SESSION['shopping_cart'][$count] = $itemArray; 
        } else {
            echo 'Item already added';
        }
    } else {

        $itemArray = array(
            'item_id' => $id,
            'item_qty' => $qty,
            'item_price' => $price,
        );
        $_SESSION['shopping_cart'][0] = $itemArray;
    }

    header("Location: ?id=$id");
    exit();

}

?>
<main>
    <div class="container w-75">
        <div class="row">
            <div class="col-5 fs-3 p-2"><a href="./products.php" class="btn btn-outline-secondary mt-5"><i class="bi bi-arrow-left"></i> Back</a></div>
            <div class="col-6">
                <h1 class="text-left">Product detail</h1>
            </div>
        </div>
    </div>
    <div class="container shadow rounded mb-5 w-75 p-4">
        <div class="row itm-title">
            <h2 class="m-3 mb-4"><?php echo $product['name']; ?></h2>
        </div>
        <div class="row">
            <div class="col-5 text-center">
                <img src="<?php echo $product['img']; ?>" alt="product_img" class="itm-img">
            </div>
            <div class="col-6">
                <div class="row mt-5 mb-4">
                    <div class="col"><span class="bold">Alcohol Vol:</span> <?php echo $product['alc_vol']; ?>% ABV</div>
                    <div class="col"><span class="bold">Country:</span> <?php echo $product['origin']; ?></div>
                </div>
                <div class="row mb-4">
                    <?php echo $product['info']; ?>
                </div>
                <div class="row text-end">
                    <form method="POST">
                        <div class="row">
                            <label class="col fs-4 align-middle text-start">$<?php echo $price; ?></label>
                            <div class="col">
                                <input class="align-items-end" type="number" name="qty" min="1" max="<?php echo $stock; ?>" value="1" <?php if ($stock == 0) {
                                                                                                                                            echo 'disabled';
                                                                                                                                        } ?>>
                                <button class="btn btn-outline-success me-2">Add to Cart</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="row">
                    <?php
                    if ($stock == 0) {
                        echo '<small class="text-danger">Out of stock</small>';
                    } else if ($stock < 6) {
                        echo "<small class='text-success'>In stock ($stock pcs)</small>";
                    } else {
                        echo '<small class="text-success">In stock (> 5)</small>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</main>
<?php include __DIR__ . '/incl/foot.php'; ?>