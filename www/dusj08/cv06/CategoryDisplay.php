<?php require './CategoriesDB.php';?>
 <?php
 $categoriesDB = new CategoriesDB();
 $categories = $categoriesDB->fetchAll();
 ?>
 <div class="list-group">
     <?php foreach($categories as $category): ?>
     <a href="#" class="list-group-item"><?php echo '(', $category['category_id'], ') ', $category['name']; ?></a>
     <?php endforeach; ?>
 </div> 