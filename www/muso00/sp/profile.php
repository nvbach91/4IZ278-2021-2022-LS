<?php
$title = 'Profile';
$pageActive = 4;
session_start();
?>
<?php require __DIR__ . '/db/UsersDB.php'; ?>
<?php include __DIR__ . '/incl/head.php'; ?>
<?php include __DIR__ . '/incl/nav.php'; ?>
<?php require __DIR__ . '/utils/user_required.php'; ?>
<?php require __DIR__ . '/db/OrdersDB.php'; ?>
<?php

if (isset($_SESSION['fb_access_token'])) {
    exit('<div class="alert alert-info text-center" role="alert">You are logged through Facebook. <a href="./facebook/profile.php" class="stretched-link link-info">View profile</a></div>');
}

$ref = "";
$errors = [];
$id = $_SESSION['user_id'];

require __DIR__ . '/utils/fetch_user_info.php';

if (isset($_GET['ref'])) {
    $ref = $_GET['ref'];
}

if (!empty($_POST)) {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $city = $_POST['city'];
    $street = $_POST['street'];
    $postalCode = $_POST['postalCode'];


    require __DIR__ . '/utils/name_validation.php';

    if (!count($errors)) {
        require __DIR__ . '/utils/update_user_info.php';

        $_SESSION['user_first_name'] = $firstName;
        header('Location: ./profile.php?ref=updated');
    }
}

?>
<main>
    <?php if (isset($ref) && $ref === 'updated') : ?>
        <div class="alert alert-info text-center" role="alert">Profile page updated</div>
    <?php endif; ?>
    <h1 class="text-center">Profile page</h1>
    <div>
        <ul class="nav justify-content-center">
            <li class="nav-item"> <a class="nav-link" href="#account-info"><i class="bi bi-pencil-fill"></i> Edit account information</a></li>
            <li class="nav-item"> <a class="nav-link" href="#orders"><i class="bi bi-list"></i> Display orders</a></li>
            <li class="nav-item"> <a class="nav-link" href="./passwd.php"><i class="bi bi-arrow-repeat"></i> Change password</a></li>
        </ul>
    </div>
    <?php require __DIR__ . '/components/userFormDisplay.php'; ?>
    <?php require __DIR__ . '/components/orderDisplay.php'; ?>
</main>
<?php include __DIR__ . '/incl/foot.php'; ?>