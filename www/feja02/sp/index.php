<?php
include "include/header.php";
require "database/productsdb.php";
require "database/brandsdb.php";

$productsDb = new ProductsDB();
$brandsDb = new BrandsDB();
$productsPerPage = 6;

if (!empty($_GET["brand"])) {
    $brandId = $_GET["brand"];
    $brand = $brandsDb->fetchById($brandId)[0];
}
else $brandId = 0;

if (!empty($_GET["page"])) $page = $_GET["page"];
else $page = 1;

$products = $productsDb->fetchByBrand($brandId, $page, $productsPerPage);
$productsCount = $productsDb->countProducts($brandId);
$paginationLink = "./?brand=" . $brandId . "&page=";
$numPages = ceil($productsDb->countProducts($brandId) / $productsPerPage);
if (!$numPages) $numPages++; //For pagination and redirection
$index = 0; //Index for card counting

if ($page > $numPages) header("Location: /");

?>

<div class="d-flex w-50 mx-auto text-black flex-column flex-wrap mt-4 mb-5">
    <?php if ($brandId != 0): ?>
    <div class="text-block text-black" id="brandInfo">
        <h1><?php echo $brand["name"]; ?></h1>
        <p><?php echo $brand["description"]; ?></p>
    </div><hr/>
    <?php endif; ?>
    <div class="justify-content-center">
        <?php foreach ($products as $product): ?>
            <?php if ($index % 3 == 0) echo '<div class="row">'; ?>
            <div class="col-sm-4">
                <div class="card mx-3 my-2" style="width: 300px; height: 600px;">
                    <a class="card-link text-reset text-decoration-none" href="./product?id=<?php echo $product["id"]; ?>" style="height: 600px;">
                        <img class="card-img-top" src="<?php echo $product["image"]; ?>" alt="<?php echo $product["name"]; ?>" width="200" height="300">
                        <div class="card-body" style="height: 160px;">
                            <h5 class="card-title"><?php echo $product["name"]; ?></h5>
                            <p class="card-text"><?php echo $product["description_short"]; ?></p>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Nicotine: <?php echo $product["nicotine"]; ?>mg/g</li>
                            <li class="list-group-item">Pouches: <?php echo $product["pouches"]; ?></li>
                            <li class="list-group-item">Price: $<?php echo $product["price"]; ?></li>
                        </ul>
                    </a>
                </div>
            </div>
            <?php if ($index % 3 == 2 || $index == count($products) - 1) echo '</div>'; $index++; ?>
        <?php endforeach; ?>
    </div>
    <div>
        <ul class="pagination justify-content-center mt-3">
            <li class="page-item">
                <a class="page-link <?php echo ($page == 1 ? "disabled" : ""); ?>" href="<?php echo $paginationLink . ($page - 1); ?>">
                    Previous
                </a>
            </li>
            <?php for ($i = 1; $i <= $numPages; $i++): ?>
                <li class="page-item">
                    <a class="page-link <?php echo ($i == $page ? "disabled" : ""); ?>" href="<?php echo $paginationLink . $i; ?>">
                        <?php echo $i; ?>
                    </a>
                </li>
            <?php endfor; ?>
            <li class="page-item">
                <a class="page-link <?php echo ($page == $numPages ? "disabled" : ""); ?>" href="<?php echo $paginationLink . ($page + 1); ?>">
                    Next
                </a>
            </li>
        </ul>
    </div>
</div>

<?php include "./include/footer.php"; ?>
