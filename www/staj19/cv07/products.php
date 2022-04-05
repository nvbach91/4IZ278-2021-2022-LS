<?php

require_once __DIR__ . '/classes/ProductsDB.php';

$pagination = 4;

if (isset($_GET['offset'])) {
  $offset = (int)$_GET['offset'];
} else {
  $offset = 0;
}

$productsDB = new ProductsDB();
$products = $productsDB->fetchPagination($pagination, $offset);

$count = intval($productsDB->fetchCount());

?>

<div class="pagination">
  <?php for ($i = 1; $i <= ceil($count / $pagination); $i++) { ?>
    <a class="<?php echo ($offset / $pagination + 1) == $i ? "active" : ""; ?>" href="./index.php?offset=<?php echo ($i - 1) * $pagination; ?>">
      <?php echo $i; ?>
    </a>
  <?php }; ?>
</div>
<div class="row">
  <?php foreach ($products as $product) : ?>
    <div class="card product" style="width: calc(100% / 3)">
      <div class="card-img-top" style="background-image: url(<?php echo $product['img']; ?>)"></div>
      <div class="card-body">
        <h5 class="card-title"><?php echo $product['name'] ?></h5>
        <div class="card-subtitle"><?php echo $product['price'] ?></div>
        <div class="card-text"><?php echo $product['description'] ?></div>
        <div class="card-controls">
          <a class="btn btn-secondary card-link" href='./buy.php?id=<?php echo $product['id'] ?>'>Buy</a>
          <a class="btn btn-secondary card-link" href='./update.php?id=<?php echo $product['id'] ?>'>Edit</a>
          <a class="btn btn-secondary card-link" href='./delete.php?id=<?php echo $product['id'] ?>'>Delete</a>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
</div>
<div class="pagination">
  <?php for ($i = 1; $i <= ceil($count / $pagination); $i++) { ?>
    <a class="<?php echo $offset / $pagination + 1 == $i ? "active" : ""; ?>" href="./index.php?offset=<?php echo ($i - 1) * $pagination; ?>">
      <?php echo $i; ?>
    </a>
  <?php } ?>
</div>