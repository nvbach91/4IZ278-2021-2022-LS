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
    require __DIR__ . '/utils/fetch_product_info.php';
    $productArray = array(
        'first_name' => $name,
        'price' => $price,
        'stock' => $stock,
        'img' => $img,
        'info' => $description,
        'alc_vol' => $alcVol,
        'bottle_size' => $size,
        'origin' => $origin,
        'category_id' => $catId,
    );
}

if ('POST' == $_SERVER['REQUEST_METHOD']) {
    if ($_SESSION[$productId . '_last_modified_at'] != $lastModified) {
        exit('<div class="alert alert-danger text-center" role="alert">The product was edited by somebody else in the meantime. <a href="./products.php" class="stretched-link link-danger">Go to products</a></div>');
    }
    require __DIR__ . '/utils/edit.php';
    $changedProductArray = array(
        'first_name' => $name,
        'price' => $price,
        'stock' => $stock,
        'img' => $img,
        'info' => $description,
        'alc_vol' => $alcVol,
        'bottle_size' => $size,
        'origin' => $origin,
        'category_id' => $catId,
    );
    $arrayDif = array_diff($changedProductArray, $productArray);
    print_r($arrayDif);
    $record = [];
    array_push($record, $lastModified, $arrayDif);
    print_r($record);
    //$logRecord = implode(';', ,$arrayDif);
    // $itemRecords= [];
    // array_push($itemRecords, $lastModified);
    // foreach ($arrayDif as $values => $keys) {
    //     array_push($itemRecords, $keys);
    // }
    // $itemRecord = implode(';', $itemRecords);
    // file_put_contents(dirname(__DIR__).'/sp_changed/admin/edit-item-log.db', $itemRecord . PHP_EOL, FILE_APPEND);
    
    //header('Location: ./products.php?action=updated');

}
$_SESSION[$productId . '_last_modified_at'] = $lastModified;
?>
<main>
    <h1 class="text-center">Edit product</h1>
    <div class="container shadow rounded mb-5 p-4 w-50 mx-auto">
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF'] . '?id=' . $productId; ?>" class="mt-4">
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
                        <span class="input-group-text" id="basic-addon8">Bottle size</span>
                        <input name="bottle_size" value="<?php echo @$size; ?>" type="text" class="form-control" placeholder="varchar(255)" aria-label="id" aria-describedby="basic-addon8">
                    </div>
                </div>
                <div class="col">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon9">Origin</span>
                        <input name="origin" value="<?php echo @$origin; ?>" type="text" class="form-control" placeholder="varchar(255)" aria-label="id" aria-describedby="basic-addon9">
                    </div>
                </div>
                <div class="col">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon10">Category ID</span>
                        <input name="category_id" value="<?php echo @$catId; ?>" type="text" class="form-control" placeholder="int(11)" aria-label="id" aria-describedby="basic-addon10">
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