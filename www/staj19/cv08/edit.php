<?php

if (session_status() !== PHP_SESSION_ACTIVE) session_start();

require __DIR__ . '/userRequired.php';
require __DIR__ . '/managerRequired.php';

require_once __DIR__ . '/classes/ProductsDB.php';
$productsDB = new ProductsDB();
$id = $_GET['id'];
$product = $productsDB->fetchById($id);

if (!$product) {
  exit('Unable to find product!');
}

if (!empty($_POST)) {
  $ProductName = $_POST['ProductName'];
  $description = $_POST['description'];
  $img = $_POST['img'];
  $price = $_POST['price'];

  if (strlen($ProductName) < 3) {
    $err['Name is too short'];
  }

  if (strlen($description) < 3) {
    $err['Description is too short'];
  }

  if (strlen($img) < 3) {
    $err['Image address is too short'];
  }

  if (strlen($price) < 3) {
    $err['Price is too short'];
  }

  if (!isset($err)) {
    $productsDB->updateProduct($ProductName, $description, $img, $price, $id);
    header('Location: index.php');
  }
}

?>

<?php require __DIR__ . '/head.php' ?>
<main class="container">

  <h1>Update product</h1>

  <form class="form-signin" method="POST">
    <div class="form-label-group">
      <label for="ProductName">Product name</label>
      <input name="ProductName" class="form-control" placeholder="Name" required autofocus value="<?php echo isset($ProductName) ? $ProductName : $product['name']; ?>">
      <?php if (isset($err) && isset($err['ProductName'])) : ?>
        <small><?php echo $err['ProductName']; ?></small>
      <?php endif; ?>
    </div>

    <div class="form-label-group">
      <label for="price">Price</label>
      <input name="price" class="form-control" placeholder="Price" required value="<?php echo isset($price) ? $price : $product['price']; ?>">
      <?php if (isset($err) && isset($err['price'])) : ?>
        <small><?php echo $err['price']; ?></small>
      <?php endif; ?>
    </div>

    <div class="form-label-group">
      <label for="img">Image</label>
      <input name="img" class="form-control" placeholder="Image" required value="<?php echo isset($img) ? $img : $product['img']; ?>">
      <?php if (isset($err) && isset($err['img'])) : ?>
        <small><?php echo $err['img']; ?></small>
      <?php endif; ?>
    </div>

    <div class="form-label-group">
      <label for="description">Description</label>
      <input name="description" class="form-control" placeholder="Description" required value="<?php echo isset($description) ? $description : $product['description']; ?>">
      <?php if (isset($err) && isset($err['description'])) : ?>
        <small><?php echo $err['description']; ?></small>
      <?php endif; ?>
    </div>

    <input type="hidden" name="id" value="<?php echo $product['id']; ?>'">
    <br>
    <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Save</button> or <a href="index.php">Cancel</a>
  </form>
  <div style="margin-bottom: 600px"></div>
</main>
<?php require __DIR__ . '/foot.php' ?>