<?php

require __DIR__ . '/utils/logged.php';

$pageName = 'BookInPrague | Create Property';

require_once __DIR__ . '/db/categories-db.php';
$categoryDB = new CategoryDB();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $categories = $categoryDB->fetchAll();
}

if (!empty($_POST)) {

    $category = $_POST['category'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $owner = $_POST['owner'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $photo = $_POST['photo'];
    $address = $_POST['address'];

    $description = ($description == '') ? null : $description;

    require __DIR__ . '/utils/validation.php';
    $validate = new Validate();

    $err['email'] = $validate->email($email);
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
        $properytyDB->insert($user['user_id'], $categoryInDB['category_id'], $description, $price, $owner, $phone, $email, $photo, $address);

        header('Location: property-list.php');
        exit();
    }
}

?>

<?php require __DIR__ . '/incl/head.php' ?>

<main>
    <h1>Přidát nabídku</h1>

    <?php require __DIR__ . '/utils/form.php' ?>
</main>

<?php require __DIR__ . '/incl/foot.php' ?>