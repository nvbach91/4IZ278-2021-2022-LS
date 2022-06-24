<?php

require __DIR__ . '/utils/logged.php';

$pageName = 'BookInPrague | Edit Property';

require_once __DIR__ . '/db/categories-db.php';
$categoryDB = new CategoryDB();
$categories = $categoryDB->fetchAll();

require_once __DIR__ . '/db/property-db.php';
$propertyDB = new PropertyDB();

$propertyId = $_GET['property_id'];
$property = $propertyDB->fetchById($propertyId);

if (empty($property) || $property['fk_user_id'] !== $user['user_id']) {
    header('Location: property-list.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $categoryDB = $categoryDB->fetchById($property['fk_category_id']);

    $category = isset($categoryDB['category_name']) ? $categoryDB['category_name'] : '';
    $description = isset($property['description']) ? $property['description'] : '';
    $price = isset($property['price']) ? $property['price'] : '';
    $owner = isset($property['owner']) ? $property['owner'] : '';
    $phone = isset($property['phone']) ? $property['phone'] : '';
    $email = isset($property['email']) ? $property['email'] : '';
    $photo = isset($property['photo']) ? $property['photo'] : '';
    $address = isset($property['address']) ? $property['address'] : '';
}


if (!empty($_POST)) {
    $property = $propertyDB->fetchById($propertyId);

    $category = $_POST['category'];
    $description = htmlspecialchars($_POST['description']);
    $price = htmlspecialchars($_POST['price']);
    $owner = htmlspecialchars($_POST['owner']);
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $photo = $_POST['photo'];
    $address = htmlspecialchars($_POST['address']);

    $description = ($description == '') ? null : $description;

    require __DIR__ . '/utils/validation.php';
    $validate = new Validate();

    $err['email'] = $validate->email($email);
    $err['phone'] = $validate->phone($phone);
    $err['category'] = $validate->category($category);
    $err['photo'] = $validate->image($photo);
    $err['owner'] = $validate->name($owner);

    $err = array_filter($err, function ($value) {
        return !is_null($value) && $value !== '';
    });

    if (empty($err)) {

        $categoryInDB = $categoryDB->fetchByName($category);
        $categoryInDB = $categoryInDB == '' ? null : $categoryInDB;

        require_once __DIR__ . '/db/property-db.php';
        $properytyDB = new PropertyDB();
        $properytyDB->update($user['user_id'], $categoryInDB['category_id'], $description, $price, $owner, $phone, $email, $photo, $address, $propertyId);

        header("Location: property-info.php?id=$eventId");
        exit();
    }
}

?>

<?php require __DIR__ . '/incl/head.php' ?>

<main>
    <h1>Upravít nabídku</h1>

    <?php require __DIR__ . '/utils/form.php' ?>
</main>


<?php require __DIR__ . '/incl/foot.php' ?>