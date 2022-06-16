<?php
$categoriesDB = new CategoriesDB;
$categories = $categoriesDB->fetchAll();

if (isset($_GET['category_id'])) {
    $categories_id = $_GET['category_id'];
}
?>
<div class="col-lg-3 d-none d-lg-block">
    <a class="btn shadow-none d-flex align-items-center justify-content-between bg-black text-white w-100"
        data-toggle="collapse" href="#navbar-vertical" style="height: 65px; margin-top: -1px; padding: 0 30px;">
        <h2 class="m-0">Categories</h2>
        <i class="fa fa-angle-down text-dark"></i>
    </a>
    <nav class="collapse hide navbar navbar-vertical navbar-light align-items-start p-0 "
        id="navbar-vertical">
        <div class="navbar-nav w-50 overflow-hidden" style="height: 210px">
            <?php foreach ($categories as $category) : ?>
            <a href="?category_id=<?php echo $category['category_id']; ?>"
                class="btn btn-outline-primary <?php echo $categories_id == $category['category_id'] ? "active" : ""; ?>"><?php echo $category['name']; ?></a>
            <?php endforeach; ?>
        </div>
    </nav>
</div>