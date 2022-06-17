<?php
include "include/header.php";
require "database/productsdb.php";

$productsDb = new ProductsDB();

if (!empty($_GET["id"])) $productId = $_GET["id"];
else header('Location: ./');

$product = $productsDb->fetchById($productId)[0];
if (!is_array($product)) header('Location: ./'); //Invalid ID check
?>

<div class="d-flex w-50 mx-auto text-black flex-column flex-wrap mt-4 mb-5">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <h3 class="card-title"><?php echo $product["name"]; ?></h3>
                </div>
                <?php if (isset($_SESSION["login_role"]) && $_SESSION["login_role"] == 1): ?>
                <div class="col justify-content-end text-end">
                    <a class="btn btn-secondary btn-rounded" href="./editProduct?id=<?php echo $product["id"]; ?>">Edit</a>
                    <a class="btn btn-danger btn-rounded" href="./deleteProduct?id=<?php echo $product["id"]; ?>">Delete</a>
                </div>
                <?php endif; ?>
            </div>
            <div class="row">
                <div class="col-lg-5 col-md-5 col-dm-6">
                    <div class="white-box text-center"><img class="img-responsive" src="<?php echo $product["image"]; ?>" width="300"></div>
                </div>
                <div class="col-lg-7 col-md-7 col-sm-6 justify-content-center text-center">
                    <div class="table-responsive mx-3 my-5">
                        <table class="table table-striped table-product">
                            <tbody>
                                <tr>
                                    <td>Nicotine:</td>
                                    <td><?php echo $product["nicotine"]; ?></td>
                                </tr>
                                <tr>
                                    <td>Pouches:</td>
                                    <td><?php echo $product["pouches"]; ?></td>
                                </tr>
                                <tr>
                                    <td>Price:</td>
                                    <td>$<?php echo $product["price"]; ?>/can</td>
                                </tr>
                            </tbody>
                        </table> 
                    </div>
                    <form method="post" action="./functions/addToCart">
                        <input type="hidden" name="id" value="<?php echo $product["id"]; ?>">
                        <input type="hidden" name="url" value="<?php echo "product?id=" . $product["id"]; ?>">
                        <input type="hidden" name="price" value=<?php echo $product["price"]; ?>>
                        <input type="number"  min="1" max="100" class="form-control-custom" name="quantity" value="1">
                        <button class="btn btn-primary btn-rounded btn-lg mx-3" type="submit">Buy now</button>
                    </form>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <h3 class="box-title mt-3">Snus description</h3>
                    <p><?php echo $product["description_long"]; ?></p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "include/footer.php"; ?>
