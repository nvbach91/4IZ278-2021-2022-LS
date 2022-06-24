<?php

if (session_status() !== PHP_SESSION_ACTIVE) session_start();

$pageName = 'BookInPrague | Property Information';

if (isset($_SESSION['user'])) {
  $user = $_SESSION['user'];
}


$propertyId = $_GET['property_id'];

require_once __DIR__ . '/db/property-db.php';
$propertyDB = new PropertyDB();
$property = $propertyDB->fetchById($propertyId);

if (empty($property)) {
  header('Location: property-list.php');
  exit();
}

require_once __DIR__ . '/db/user-db.php';
$userDB = new UserDB();
$owner = $userDB->fetchById($property['fk_user_id']);

if (isset($user)) {
  $userEmail = $userDB->fetchById($user['user_id']);
}

require_once __DIR__ . '/db/categories-db.php';
$categoryDB = new CategoryDB();
$category = $categoryDB->fetchById($property['fk_category_id']);

require_once __DIR__ . '/db/favourites-db.php';
$favouritesDB = new FavouritesDB();

require_once __DIR__ . '/db/comments-db.php';
$commentsDB = new CommentsDB();
$comments = $commentsDB->fetchAll();
$commentCount = 0;
$ratings = [];
$ratingsSum = 0;


foreach ($comments as $comment) {
  if ($property['property_id'] === $comment['fk_property_id']) {

    $ratings[] = $comment['rating'];
    $commentCount = $commentCount + 1;
  }
}

$ratingsSum = array_sum($ratings);
$average = $ratingsSum / $commentCount;
$formattedAverage = number_format((float)$average, 2, '.', '');

if (isset($_POST['favourites-button'])) {
  $favouritesDB->insert($user['user_id'], $property['property_id']);
}

if (isset($_POST['delete-button'])) {
  $propertyDB->delete($propertyId);
  header('Location: property-list.php');
}
?>

<?php require __DIR__ . '/incl/head.php'; ?>

<main class="mx-auto">
  <h1><?php echo $category['category_name'] ?></h1>

  <div class="mx-auto container">
    <div class="p-3 row row-cols-2">
      <div class="wrapper">
        <?php if (isset($owner['name'])) : ?>
          <div>Majitel:
            <p class="single-item"><?php echo $owner['name'] ?></p>

          </div>
        <?php endif ?>
        <?php if (isset($property['description'])) : ?>
          <div>Popis:<br>
            <p class="single-item"><?php echo $property['description'] ?></p>
          </div>
        <?php endif ?>
        <?php if (isset($property['price'])) : ?>
          <div>Cena za noc:
            <p class="single-item"><?php echo $property['price'] ?></p>
          </div>
        <?php endif ?>
        <?php if (isset($property['phone'])) : ?>
          <div>Phone:
            <p class="single-item"><?php echo $property['phone'] ?></p>
          </div>
        <?php endif ?>
        <?php if (isset($property['email'])) : ?>
          <div>Email:
            <p class="single-item"><?php echo $property['email'] ?></p>
          </div>
        <?php endif ?>
        <?php if (isset($property['address'])) : ?>
          <div>Address:
            <p class="single-item"><?php echo $property['address'] ?></p>
          </div>
        <?php endif ?>
        <div>Průměr hodnocení:
          <p class="single-item"><?php echo  $formattedAverage; ?></p>
        </div>
      </div>
      <div class="col">
        <img src="<?php echo isset($property['photo']) ? $property['photo']
                    : 'https://media.istockphoto.com/photos/dancing-friends-picture-id501387734?k=20&m=501387734&s=612x612&w=0&h=1mli5b7kpDg428fFZfsDPJ9dyVHsWsGK-EVYZUGWHpI=' ?>
        " alt="image">
      </div>
    </div>
    <?php if (isset($user) && ($user['user_id'] === $property['fk_user_id'])) : ?>
      <form method="POST">
        <a class="btn btn-primary ms-3" href="edit-property.php?property_id=<?php echo $propertyId ?>">Upravít nabídku</a>
        <button class="btn btn-primary ms-3" type="submit" name="delete-button">Smazát nabídku</button>
      </form>
    <?php elseif (isset($user) && $userEmail['email'] === 'admin@admin.com') : ?>
      <form method="POST">
        <button class="btn btn-primary ms-3" type="submit" name="delete-button">Smazát nabídku</button>
      </form>
    <?php endif ?>
    <?php if (isset($user)) : ?>
      <form method="POST">
        <button class="btn btn-primary m-3" type="submit" name="favourites-button">Přidát do zajímavých</button>
        <a href="comment-form.php" class="btn btn-primary m-3">Přidat kommentář</a>
      </form>
    <?php endif ?>
    <a href="property-list.php" class="btn btn-primary m-3">Zpatky</a>
    <?php if (!empty($comments)) : ?>
      <?php require __DIR__ . '/comments.php' ?>
    <?php endif ?>
  </div>
</main>

<?php require __DIR__ . '/incl/foot.php'; ?>