<?php
$title = 'Admin - Edit product';
session_start();
?>
<?php include __DIR__ . '/incl/head.php'; ?>
<?php include __DIR__ . '/incl/nav.php'; ?>
<?php require __DIR__ . '/db/ProductsDB.php'; ?>
<?php require __DIR__ . '/utils/admin_required.php'; ?>
<?php
$productsDB = new ProductsDB();
if (isset($_GET)) {
    $productId = $_GET['id'];

    
    $res = $productsDB->fetchById($productId);
    
    if (!$res) {
        exit(404);
    }

    $products = $res->fetchAll()[0];

    $name = $products['name'];
    $price = $products['price'];
    $stock = $products['stock'];
    $img = $products['img'];
    $description = $products['info'];
    $alcVol = $products['alc_vol'];
    $size = $products['bottle_size'];
    $origin = $products['origin'];
    $catId = $products['category_id'];
    $lastModified = $products['date_modified'];
}

if ('POST' == $_SERVER['REQUEST_METHOD']) {
    if($_SESSION[$productId . '_last_modified_at'] != $lastModified) {
        die('The product was modified by somebody else in the meantime!');
    }

    $name = $_POST['name'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $img = $_POST['img'];
    $description = $_POST['info'];
    $alcVol = $_POST['alc_vol'];
    $size = $_POST['bottle_size'];
    $origin = $_POST['origin'];
    $catId = $_POST['category_id'];

    $productsDB->updateById($productId, 'name', $name);
    $productsDB->updateById($productId, 'price', $price);
    $productsDB->updateById($productId, 'stock', $stock);
    $productsDB->updateById($productId, 'img', $img);
    $productsDB->updateById($productId, 'info', $description);
    $productsDB->updateById($productId, 'alc_vol', $alcVol);
    $productsDB->updateById($productId, 'bottle_size', $size);
    $productsDB->updateById($productId, 'origin', $origin);
    $productsDB->updateById($productId, 'date_modified', date('Y-m-d H:i:s', time()));
    $productsDB->updateById($productId, 'category_id', $catId);

    header('Location: ./products.php?action=updated');
}
$_SESSION[$productId . '_last_modified_at'] = $lastModified;
?>
<main>
    <h1 class="text-center">Edit product</h1>
    <div class="container shadow rounded mb-5 p-4 w-50 mx-auto">
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF'].'?id='.$productId; ?>" class="mt-4">
            <div class="row">
                <div class="col-3">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Product ID</span>
                        <input name="product_id" value="<?php echo $productId; ?>" type="text" class="form-control" placeholder="int(11)" aria-label="id" aria-describedby="basic-addon1" readonly>
                    </div>
                </div>
                <div class="col">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon2">Name</span>
                        <input name="name" value="<?php echo @$name; ?>" type="text" class="form-control" placeholder="varchar(255)" aria-label="id" aria-describedby="basic-addon2">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon3">Price</span>
                        <input name="price" value="<?php echo @$price; ?>" type="text" class="form-control" placeholder="varchar(255)" aria-label="id" aria-describedby="basic-addon3">
                    </div>
                </div>
                <div class="col-3">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon4">Stock</span>
                        <input name="stock" value="<?php echo @$stock; ?>" type="text" class="form-control" placeholder="int(11)" aria-label="id" aria-describedby="basic-addon4">
                    </div>
                </div>
                <div class="col">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon5">Image URL</span>
                        <input name="img" value="<?php echo @$img; ?>" type="text" class="form-control" placeholder="varchar(255)" aria-label="id" aria-describedby="basic-addon5">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon6">Description</span>
                        <input name="info" value="<?php echo @$description; ?>" type="text" class="form-control" placeholder="varchar(510)" aria-label="id" aria-describedby="basic-addon6">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon7">Alc. volume</span>
                        <input name="alc_vol" value="<?php echo @$alcVol; ?>" type="text" class="form-control" placeholder="varchar(255)" aria-label="id" aria-describedby="basic-addon7">
                    </div>
                </div>
                <div class="col">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon5">Bottle size</span>
                        <input name="bottle_size" value="<?php echo @$size; ?>" type="text" class="form-control" placeholder="varchar(255)" aria-label="id" aria-describedby="basic-addon5">
                    </div>
                </div>
                <div class="col">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon8">Origin</span>
                        <input name="origin" value="<?php echo @$origin; ?>" type="text" class="form-control" placeholder="varchar(255)" aria-label="id" aria-describedby="basic-addon8">
                    </div>
                </div>
                <div class="col">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon9">Category ID</span>
                        <input name="category_id" value="<?php echo @$catId; ?>" type="text" class="form-control" placeholder="int(11)" aria-label="id" aria-describedby="basic-addon9">
                    </div>
                </div>
            </div>
            <div class="row w-25 mx-auto">
                <button type="submit" class="btn btn-outline-secondary">Update</button>
            </div>
        </form>
    </div>
</main>

<?php include __DIR__ . '/incl/foot.php'; ?>