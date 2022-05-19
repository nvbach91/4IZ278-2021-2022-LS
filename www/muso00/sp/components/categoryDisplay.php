<?php
$categoriesDB = new CategoriesDB();
$categories = $categoriesDB->fetchAll();

if (isset($_GET['category_id'])) {
    $catId = $_GET['category_id'];
}

?>
<section>
    <div class="d-flex justify-content-center">
        <div class="btn-toolbar d-grid gap-2 d-md-block" role="toolbar" aria-label="Toolbar with button groups">
            <div class="btn-group mt-3" role="group" aria-label="First group">
                <a href="./products.php" class="btn btn-<?php echo isset($catId) ? "outline-" : "";?>dark mr-3">All</a>
            </div>
            <div class="btn-group mt-3" role="group" aria-label="Second group">
                <?php foreach ($categories as $category) : ?>
                    <a href="?category_id=<?php echo $category['category_id']; ?>" class="btn btn-outline-secondary <?php echo $catId == $category['category_id'] ? "active" : ""; ?>"><?php echo $category['name']; ?></a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>