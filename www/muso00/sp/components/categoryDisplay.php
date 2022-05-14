<?php
$categoriesDB = new CategoriesDB();
$categories = $categoriesDB->fetchAll();

if (!empty($_GET)) {
    $catId = $_GET['category_id'];
}

?>
<section>
    <!--div class="fs-5 text-center mt-3"-->
    <div class="d-flex justify-content-center">
        <div class="btn-toolbar d-grid gap-2 d-md-block" role="toolbar" aria-label="Toolbar with button groups">
            <div class="btn-group mt-3" role="group" aria-label="First group">
                <a href="./products.php" class="btn btn-dark mr-3">All</a>
            </div>
            <div class="btn-group mt-3" role="group" aria-label="Second group">
                <?php foreach ($categories as $category) : ?>
                    <a class="btn btn-outline-secondary" href="?category_id=<?php echo $category['category_id']; ?>"><?php echo $category['name']; ?></a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <!--/div-->
</section>