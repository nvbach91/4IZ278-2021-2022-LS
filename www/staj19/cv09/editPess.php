<?php require "./db.php" ?>

<?php

session_start();

if (!$_SESSION['userId']) {
  exit;
}

if ($_SESSION['userPrivilege'] < 2) {
  exit('Your privilege is too low');
}




$stmt = $db->prepare('SELECT * FROM products WHERE id = :id');
$stmt->execute([
  'id' => $_GET['id']
]);
$product = $stmt->fetch();

if (!$product) {
  exit('Unable to find product!');
}

$pessimisticLockTime = 30;


if ($product['edit_at']) {
  if ($product['edit_by'] != $_SESSION['userId']) {
    if (time() - strtotime($product['edit_at']) < 30 * 60) {
      exit("Some else is still editing this record");
    }
  }
}


$stmt = $db->prepare(
  "UPDATE products SET
  edit_by = :userId,
  edit_at = now()
  WHERE id = :productId;"
);
$stmt->execute([
  'userId' => $_SESSION['userId'],
  'productId' => $_GET['id'],
]);





if ('POST' == $_SERVER['REQUEST_METHOD']) {
  $stmt = $db->prepare(
    'UPDATE products
    SET name = :name,
    description = :description,
    img = :img,
    price = :price,
    edit_by = :userId,
    edit_at = :editAt
    WHERE id = :id'
  );
  $stmt->execute([
    'name' => $_POST['name'],
    'description' => $_POST['description'],
    'img' => $_POST['img'],
    'price' => (float) $_POST['price'],
    'userId' => null,
    'editAt' => null,
    'id' => $_POST['id']
  ]);


  exit('Success!');
}

?>

<?php require __DIR__ . '/head.php' ?>

<main class="container" style="min-height: 80vh;">
  <h1>Edit pessimistic</h1>
  <form class="container" method="POST">
    <div class="form-label-group">
      <label for="name">Product name</label>
      <input name="name" class="form-control" placeholder="Name" required autofocus value="<?php echo $product['name']; ?>">
    </div>

    <div class="form-label-group">
      <label for="price">Price</label>
      <input name="price" class="form-control" placeholder="Price" required value="<?php echo $product['price']; ?>">
    </div>

    <div class="form-label-group">
      <label for="description">Description</label>
      <input name="description" class="form-control" placeholder="Description" required value="<?php echo $product['description']; ?>">
    </div>

    <div class="form-label-group">
      <label for="img">Image</label>
      <input name="img" class="form-control" placeholder="Image" required value="<?php echo $product['img']; ?>">
    </div>

    <input type="hidden" name="dateModified" value="<?php echo $product['last_updated_at']; ?>">
    <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
    <br>
    <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Save</button> or <a href="index.php">Cancel</a>
  </form>
</main>

<?php require __DIR__ . '/foot.php' ?>