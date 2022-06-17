<?php
include "include/header.php";
require "database/productsdb.php";
require "functions/adminCheck.php";

$productsDb = new ProductsDB();
$product = [];

if (!empty($_GET["id"])) {
    if (count($productsDb->fetchById($_GET["id"]))) {
        $product = $productsDb->fetchById($_GET["id"])[0];
    }
}

if (!count($product) && empty($_GET["success"])) {
    header("Location: ./");
    exit();
}
?>

<h1 class="text-center text-black mt-5">Delete Product</h1>
<div class="d-flex w-50 mx-auto text-black flex-column flex-wrap mt-4 mb-5">
    <div class="row justify-content-center text-center">
        <?php if (empty($_GET["success"])): ?>
            <div class="col-md-4">
                <div class="card my-5">
                    <img class="card-img-top" src="<?php echo $product["image"]; ?>" alt="<?php echo $product["name"]; ?>">
                    <div class="card-body" style="height: 160px;">
                        <h5 class="card-title"><?php echo $product["name"]; ?></h5>
                        <p class="card-text"><?php echo $product["description_short"]; ?></p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Nicotine: <?php echo $product["nicotine"]; ?>mg/g</li>
                        <li class="list-group-item">Pouches: <?php echo $product["pouches"]; ?></li>
                        <li class="list-group-item">Price: $<?php echo $product["price"]; ?></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card my-5">
                    <h5 class="my-4">Are you sure you want to delete this product?</h5>
                    <a class="btn btn-danger btn-rounded btn-lg mx-5 mb-3" href="./functions/deleteProduct?id=<?php echo $product["id"]; ?>">Delete</a>
                    <a class="btn btn-secondary btn-rounded btn-lg mx-5 mb-3" href="./product?id=<?php echo $product["id"]; ?>">Cancel</a>
                    <p>* This process is ireversible</p>
                </div>
            </div>
        <?php else: ?>
            <div class="col-md-4">
                <div class="m-3 alert alert-success">
                    <h6>Product successfully deleted!</h6>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php include "include/footer.php"; ?>
