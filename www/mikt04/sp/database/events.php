<?php require_once __DIR__ . '/CategoryDB.php';?>
<?php
    $CategoryDB = new CategoryDB();
    $categories = $CategoryDB->fetchAll();
?>

<div class="filter">
    <?php foreach($categories as $category):?>
        <div class="filter-item">
            <?php echo $category['name'];?>
        </div>
    <?php endforeach ;?>
</div>