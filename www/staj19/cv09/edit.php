<?php require "./db.php" ?>

<?php

session_start();

if (!$_SESSION['userId']) {
  exit;
}

if ($_SESSION['userPrivilege'] < 2) {
  exit('Your privilege is too low');
}



if ('POST' == $_SERVER['REQUEST_METHOD']) {
  $stmt = $db->prepare('SELECT last_updated_at FROM products WHERE id = :id LIMIT 1');
  $stmt->execute(['id' => $_POST['id']]);
  $lastUpdatedAt = $stmt->fetchAll()[0];

  $dateModified = $lastUpdatedAt['last_updated_at'];

  if ($dateModified != $_POST['dateModified']) {
    exit("The product was updated by someone else in the meantime!");
  } else {
    $stmt = $db->prepare(
      "UPDATE products SET
      name = :name,
      description = :description,
      price = :price,
      img = :img,
      last_updated_at = now()
      WHERE id = :id"
    );
    $stmt->execute([
      'name' => $_POST['name'],
      'description' => $_POST['description'],
      'img' => $_POST['img'],
      'price' => (float) $_POST['price'],
      'id' => $_POST['id']
    ]);

    exit('Success!');
  }
} else if ('GET' == $_SERVER['REQUEST_METHOD']) {
  $productId = $_GET['id'];

  $statement = $db->prepare("SELECT * FROM products WHERE id = :id LIMIT 1");
  $statement->execute([
    'id' => $productId
  ]);
  $product = $statement->fetchAll()[0];
}

?>

<?php require __DIR__ . '/head.php' ?>

<main class="container" style="min-height: 80vh;">
  <h1>Edit optimistic</h1>
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