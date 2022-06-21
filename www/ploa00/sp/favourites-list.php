<?php
if (session_status() !== PHP_SESSION_ACTIVE) session_start();

$pageName = 'BookInPrague | Favourites List';

if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
}


require_once __DIR__ . '/db/favourites-db.php';
$favouritesDB = new FavouritesDB;
$favourite = $favouritesDB->fetchByUser($user['user_id']);


require_once __DIR__ . '/db/property-db.php';
$propertyDB = new PropertyDB();

if (isset($favourite) || $user['user_id'] === $favourite['fk_user_id']) {
    $properties = $propertyDB->fetchByFavourites($user['user_id']);
}

if (isset($_POST['delete-button'])) {
    $favouritesDB->delete($favourite['favourite_id']);
    header('Location: favourites-list.php');
}

?>

<?php require __DIR__ . '/incl/head.php'; ?>

<main>
    <h1>Zajímavé ubytování</h1>
    <div class="mx-auto container">
        <div class="row row-cols-4">
            <?php if (!empty($properties) && count($properties) >= 1) : ?>
                <?php foreach ($properties as $property) : ?>
                    <div class="col">
                        <div class="card" style="width: 100%;">
                            <img class="card-img-top" src="
      <?php echo isset($property['photo']) ? $property['photo']
                        : 'No Image' ?>
    " alt="Image">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $property['address'] ?></h5>
                                <?php if (isset($property['description'])) : ?>
                                    <p class="card-text text-truncate"><?php echo $property['description'] ?></p>
                                <?php endif ?>
                                <form method="POST">
                                    <a href="property-info.php?property_id=<?php echo $property['property_id'] ?>" class="btn btn-primary">Více info</a>
                                    <button class="btn btn-primary ms-3" type="submit" name="delete-button">Odebrát</button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            <?php else : ?>
                <p>Žadné ubýtování ještě tady není.</p>
                <p>Přidej svoje!</p>
            <?php endif ?>
        </div>
    </div>
</main>

<?php require __DIR__ . '/incl/foot.php'; ?>