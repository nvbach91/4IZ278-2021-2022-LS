<?php
if (session_status() !== PHP_SESSION_ACTIVE) session_start();

$pageName = 'BookInPrague | Property List';

if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
}

require_once __DIR__ . '/db/property-db.php';
$propertyDB = new PropertyDB();

require_once __DIR__ . '/db/categories-db.php';
$categoryDB = new CategoryDB();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $categories = $categoryDB->fetchAll();
}

$nItemsPerPagination = 4;

$count = $propertyDB->fetchCount();

if (isset($_GET['offset'])) {
    $offset = (int)$_GET['offset'];
} else {
    $offset = 0;
}


if (empty($_GET) || isset($_GET['offset'])) {
    $properties = $propertyDB->fetchPagination($nItemsPerPagination, $offset);
} else {
    if (isset($_GET['category'])) {
        $properties = $propertyDB->searchByCategory($_GET['category']);
    } elseif (isset($_GET['filter'])) {
        if ($_GET['filter'] === 'created') {
            $properties = $propertyDB->fetchByCreator($user['user_id']);
        }
    }
    $showAllUsers = true;
}

?>

<?php require __DIR__ . '/incl/head.php'; ?>

<main>
    <h1>Seznam ubytování
        <?php if (isset($user)) : ?>
            <a class="ms-3" style="font-size: 1rem;" href="create-property.php">Přidát nabídku</a>
        <?php endif ?>
        <?php if (isset($showAllUsers) || isset($user)) : ?>
            <?php if (isset($showAllUsers)) : ?>
                <a class="ms-3" style="font-size: 1rem;" href="property-list.php">Všechny nabídky</a>
            <?php endif ?>
            <?php if (isset($user)) : ?>
                <?php if (!isset($_GET['filter']) || (isset($_GET['filter']) && $_GET['filter'] !== 'created')) : ?>
                    <a class="ms-3" style="font-size: 1rem;" href="property-list.php?filter=created">Moje nabídky</a>
                <?php endif ?>
            <?php endif ?>
        <?php endif ?>
    </h1>
    <form method="GET">
        <label class="form-label" for="category">Vyberte podle druhu ubytování</label>
        <select class="form-select<?php echo (isset($err) && isset($err['category'])) ? ' border border-danger' : '' ?>" name="category">
            <option></option>
            <?php foreach ($categories as $oneCategory) : ?>
                <option <?php echo isset($category) && $oneCategory['category_name'] == $category ? 'selected="true"' : '' ?> value="<?php echo $oneCategory['category_id'] ?>">
                    <?php echo $oneCategory['category_name'] ?>
                </option>
            <?php endforeach ?>
        </select>
        <button class="btn btn-primary ms-3" type="submit" name="category-button">Vybrat</button>
    </form>

    <div class="mx-auto container">
        <div class="wrapper-columns">
            <?php if (!empty($properties) && count($properties) >= 1) : ?>
                <?php foreach ($properties as $property) : ?>
                    <div class="col">
                        <div class="card" style="width: 100%;">
                            <img class="card-img-top-main" src="
                            <?php echo isset($property['photo']) ? $property['photo']
                                : 'No Image' ?>
                            " alt="Image">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $property['address'] ?></h5>
                                <?php if (isset($property['description'])) : ?>
                                    <p class="card-text text-truncate"><?php echo $property['description'] ?></p>
                                <?php endif ?>
                                <a href="property-info.php?property_id=<?php echo $property['property_id'] ?>" class="btn btn-primary">Více info</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            <?php else : ?>
                <p>Žadné ubýtování ještě tady není.</p>
                <p>Přidej svoje!</p>
            <?php endif ?>
        </div>
        <?php if ($count > $nItemsPerPagination && (isset($_GET['offset']) || empty($_GET))) : ?>
            <div class="pagination m-3">
                <?php for ($i = 1; $i <= ceil($count / $nItemsPerPagination); $i++) : ?>
                    <li class="page-item<?php echo $offset / $nItemsPerPagination + 1 == $i ? " active" : ""; ?>"><a class="page-link" href="property-list.php?offset=<?php echo ($i - 1) * $nItemsPerPagination; ?>">
                            <?php echo $i; ?>
                        </a>
                    </li>
                <?php endfor ?>
            </div>
        <?php endif ?>
    </div>
</main>

<?php require __DIR__ . '/incl/foot.php'; ?>