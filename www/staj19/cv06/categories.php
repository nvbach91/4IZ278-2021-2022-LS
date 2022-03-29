<?php

require __DIR__ . '/classes/CategoriesDB.php';

$CategoriesDB = new CategoriesDB();
$categories = $CategoriesDB->fetchAll();

?>

<div class="col-lg-3">
  <div class="list-group">
    <?php foreach ($categories as $category) : ?>
      <a href="#" class="list-group-item"><?php echo '(' . $category['number'] . ') ' . $category['name']; ?></a>
    <?php endforeach; ?>
  </div>
</div>