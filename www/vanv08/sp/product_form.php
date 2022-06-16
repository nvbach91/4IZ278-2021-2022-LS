<?php
$title = 'Sell product';
session_start();
require __DIR__ . '/db/UsersDB.php';
require __DIR__ . '/db/ProductsDB.php';
include __DIR__ . '/incl/head.php';
include __DIR__ . '/incl/nav.php';
$user_id = $_SESSION['user_id'];
?>
<?php
// init
$errors = [];
$usersDB = new UsersDB();
$productsDB = new ProductsDB();
// $productsDB->create(['name' => 'Nikes', 'price' => 49.99, 'product_info' => 'Dummy text',  'img_link' => 'vse.cz', 'category_id' => 4, $user_id]);



if (!empty($_POST)) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $product_info = $_POST['product_info'];
    $img_link = $_POST['img_link'];
    $category_id = $_POST['category_id'];



    // VALIDATE INPUT

    require __DIR__ . '/utils/validate_product.php';
    // CREATE IF NP

    if (!count($errors)) {
        $productsDB->create(['name' => $name, 'price' => $price, 'product_info' => $product_info,  'img_link' => $img_link, 'category_id' => $category_id, 'user_id' => $user_id]);
        header("Location: profile.php?ref=success");
        exit();
    } else {
        array_push($errors, 'Please try again ...');
    }
}

?>

<body>
    <div class="header">
        <h2>Add product to sell</h2>
        <?php if (!empty($errors)) : ?>
        <div class="alert alert-danger" role="alert">
            <?php foreach ($errors as $error) : ?>
            <div><?php echo $error; ?></div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
    <form method="post" action="product_form.php">
        </div>
        <div class="mb-3">
            <label>Name of the product</label>
            <input class="form-control" name="name" value="<?php echo isset($name) ? $name : '' ?>">
        </div>
        <div class="mb-3">
            <label>Price</label>
            <input class="form-control" name="price" type="price" value="<?php echo isset($price) ? $price : '' ?>">
        </div>
        <div class="mb-3">
            <label>Product description</label>
            <input class="form-control" name="product_info" type="product_info	"
                value="<?php echo isset($product_info) ? $product_info     : '' ?>">
        </div>
        <div class="mb-3">
            <label>Product image link</label>
            <input class="form-control" name="img_link" type="img_link	"
                value="<?php echo isset($img_link) ? $img_link     : '' ?>">
        </div>
        <select class="form-select mb-4" aria-label="Default select example" name="category_id">
            <option value="1">Shoes</option>
            <option value="2">T-shirts</option>
            <option value="3">Hoodies</option>
            <option value="4">Other</option>
        </select>
        <div class="mb-3">
            <button type="submit" class="btn btn-secondary" name="submit">Submit</button>
        </div>
    </form>
</body>