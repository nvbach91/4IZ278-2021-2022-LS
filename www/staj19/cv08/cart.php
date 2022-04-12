<?php

session_start();

if (!isset($_SESSION['user_id'])) {
  header('Location: login.php');
  exit();
}

require_once __DIR__ . '/classes/ProductsDB.php';

$ids = @$_SESSION['cart'];

$productsDB = new ProductsDB();

if (is_array($ids) && count($ids)) {
  $products = $productsDB->fetchCartProducts($ids);
}

?>

<?php require __DIR__ . '/head.php'; ?>

<main class="container" style="min-height: 75vh;">
  <h1>My shopping cart</h1>
  <br><br>
  <?php if (@$products) : ?>
    <div class="products">
      <?php foreach ($products as $product) : ?>
        <div class="card product" style="width: calc(100% / 3)">
          <div class="card-img-top" style="background-image: url(<?php echo $product['img']; ?>)"></div>
          <div class="card-body">
            <h5 class="card-title"><?php echo $product['name'] ?></h5>
            <div class="card-subtitle"><?php echo $product['price'] ?></div>
            <div class="card-text"><?php echo $product['description'] ?></div>
            <form action="removeItem.php" method="POST">
              <input class="d-none" name="id" value="<?php echo $product['id'] ?>">
              <button type="submit" class="btn btn-danger">Remove</button>
            </form>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  <?php else : ?>
    <h5>No products yet</h5>
  <?php endif; ?>
</main>

<?php require __DIR__ . '/foot.php'; ?>