<?php 
require_once './database/CategoryDB.php';

$categoryDB = new CategoryDB();
$categories = $categoryDB->fetchAll();
$address = '';


?>


<div class="filter-container">
    <a class="filter-item" href="./index.php">
        VŠE
    </a>
    <?php foreach($categories as $category):?>
        <a class="filter-item" href="?category_id=<?php echo $category['category_id']?>">
            <?php echo $category['name'];?>
        </a>
    <?php endforeach ;?>
</div>
