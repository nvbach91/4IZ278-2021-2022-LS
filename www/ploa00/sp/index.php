<?php
if (session_status() !== PHP_SESSION_ACTIVE) session_start();

$pageName = 'BookInPrague | Main Page';

if (isset($_SESSION['user'])) {
  $user = $_SESSION['user'];
}

require_once __DIR__ . '/db/property-db.php';
$propertyDB = new PropertyDB();
$properties = $propertyDB->fetchAll();

require_once __DIR__ . '/db/categories-db.php';
$categoryDB = new CategoryDB();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  $categories = $categoryDB->fetchAll();
}

?>

<?php require __DIR__ . '/incl/head.php' ?>

<main>
  <p class="m-5" style="font-size: 1.5em;">
    Vítejte u Book<b>In</b>Prague!
    Sdílejte své nabídky na pronájem nebo hledejte bydlení pro sebe!
  </p>
  <a href="property-list.php" class="btn btn-primary m-3">Seznam ubytování</a>
  <?php if (!empty($categories) && count($categories) >= 1) : ?>
    <?php foreach ($categories as $oneCategory) : ?>
      <div class="wrapper-columns">
        <div class="card" style="width: 100%;">
          <img class="card-img-top-main" src="
      <?php echo isset($oneCategory['category_photo']) ? $oneCategory['category_photo']
        : 'No Image' ?>
    " alt="Image">
          <div class="card-body">
            <h5 class="card-title"><?php echo $oneCategory['category_name'] ?></h5>
            <a href="property-list.php?category=<?php echo $oneCategory['category_id'] ?>&category-button=" class="btn btn-primary">Hledát</a>
          </div>
        </div>
      </div>
    <?php endforeach ?>
  <?php else : ?>
    <p>Žadné druhy ještě tady nejsou.</p>
  <?php endif ?>
</main>


<?php require __DIR__ . '/incl/foot.php' ?>