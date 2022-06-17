<?php
include "include/header.php";
require "database/brandsdb.php";
require "database/productsdb.php";
require "functions/adminCheck.php";

$brandsDb = new BrandsDB();
$productsDb = new ProductsDB();
$product = [];
$brands = $brandsDb->fetchAll();

if (!empty($_GET["id"])) {
    if (count($productsDb->fetchById($_GET["id"]))) {
        $product = $productsDb->fetchById($_GET["id"])[0];
    }
}

if (!count($product) && empty($_GET["success"])) {
    header("Location: ./");
    exit();
}

$editDetails = [];
if (!empty($_SESSION["editDetails"])) $editDetails = $_SESSION["editDetails"];

$errorList = [];
if (!empty($_SESSION["errorList"])) $errorList = $_SESSION["errorList"];
?>

<h1 class="text-center text-black mt-5">Edit Product</h1>
<div class="d-flex w-50 mx-auto text-black flex-column flex-wrap mt-4 mb-5">
    <div class="row justify-content-center text-center">
        <?php if (empty($_GET["success"])): ?>
            <div class="col-md-8">
                <div class="card my-5">
                    <form method="POST" action="./functions/editProduct">
                        <input type="hidden" name="id" value="<?php echo $product["id"]; ?>">
                        <?php if (!empty($errorList)): ?>
                        <div class="m-3 alert alert-danger text-start">
                            <?php foreach ($errorList as $error): ?>
                                <h6><?php echo $error; ?></h6>
                            <?php endforeach; ?>
                        </div>
                        <?php endif; ?>
                        <div class="m-3 text-start">
                            <label class="control-label text-start" for="name"><h6>Product name:</h6></label>
                            <input class="form-control" name="name" id="name" type="text" value="<?php echo (count($editDetails) ? $editDetails["name"] : $product["name"]); ?>" placeholder="Product name">
                        </div>
                        <div class="m-3 text-start">
                            <label class="control-label text-start" for="descriptionShort"><h6>Short description:</h6></label>
                            <input class="form-control" name="descriptionShort" id="descriptionShort" type="text" value="<?php echo (count($editDetails) ? $editDetails["descriptionShort"] : $product["description_short"]); ?>" placeholder="Short description">
                        </div>
                        <div class="m-3 text-start">
                            <label class="control-label text-start" for="descriptionLong"><h6>Long description:</h6></label>
                            <textarea class="form-control" name="descriptionLong" id="descriptionLong" placeholder="Long description" rows="10"><?php echo (count($editDetails) ? $editDetails["descriptionLong"] : $product["description_long"]); ?></textarea>
                        </div>
                        <div class="m-3 text-start">
                            <label class="control-label text-start" for="brand"><h6>Brand:</h6></label>
                            <select class="form-control" name="brand" id="brand">
                                <?php foreach ($brands as $brand):?>
                                    <option value="<?php echo $brand["id"]; ?>" <?php echo ($product["brand_id"] == $brand["id"] ? 'selected="selected"': ""); ?>><?php echo $brand["name"]; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="m-3 text-start">
                            <label class="control-label text-start" for="nicotine"><h6>Nicotine:</h6></label>
                            <input class="form-control" name="nicotine" id="nicotine" type="text" value="<?php echo (count($editDetails) ? $editDetails["nicotine"] : $product["nicotine"]); ?>" placeholder="Nicotine">
                        </div>
                        <div class="m-3 text-start">
                            <label class="control-label text-start" for="pouches"><h6>Pouches:</h6></label>
                            <input class="form-control" name="pouches" id="pouches" type="text" value="<?php echo (count($editDetails) ? $editDetails["pouches"] : $product["pouches"]); ?>" placeholder="Pouches">
                        </div>
                        <div class="m-3 text-start">
                            <label class="control-label text-start" for="price"><h6>Price:</h6></label>
                            <input class="form-control" name="price" id="price" type="text" value="<?php echo (count($editDetails) ? $editDetails["price"] : $product["price"]); ?>" placeholder="Price">
                        </div>
                        <div class="m-3 text-start">
                            <label class="control-label text-start" for="image"><h6>Image URL:</h6></label>
                            <input class="form-control" name="image" id="image" type="text" value="<?php echo (count($editDetails) ? $editDetails["image"] : $product["image"]); ?>" placeholder="Image URL">
                        </div>
                        <a class="btn btn-secondary btn-rounded btn-lg mx-5 mb-3" href="./product?id=<?php echo $product["id"]; ?>">Cancel</a>
                        <button class="btn btn-success btn-rounded btn-lg mx-5 mb-3" type="submit" name="submit">Save</button>
                    </form>
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
