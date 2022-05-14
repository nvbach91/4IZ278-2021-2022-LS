<?php
$title = 'Profile';
session_start();
?>
<?php require __DIR__ . '/db/UsersDB.php'; ?>
<?php include __DIR__ . '/incl/head.php'; ?>
<?php include __DIR__ . '/incl/nav.php'; ?>
<?php
if (!isset($_SESSION['user_id'])) {
    exit('<div class="alert alert-warning text-center" role="alert">You are not signed in. <a href="./signin.php" class="stretched-link link-warning">Sign In</a></div>');
}
$errors = [];
$id = intval($_SESSION['user_id']);
$ref = ""; //FIXME:

$usersDB = new UsersDB();

$res = $usersDB->fetchById($id);
$userInfo = $res->fetchAll()[0];

$firstName = $userInfo['first_name'];
$lastName = $userInfo['last_name'];
$phone = $userInfo['phone'];
$email = $userInfo['email'];
$city = $userInfo['city'];
$street = $userInfo['street'];
$postalCode = $userInfo['postal_code'];

if (!empty($_GET)) {
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


    if (strlen($firstName) < 2) {
        array_push($errors, 'First name is too short');
    }

    if (strlen($lastName) < 2) {
        array_push($errors, 'Last name is too short');
    }

    if (!count($errors)) {
        $usersDB->updateById($id, 'first_name', $firstName);
        $usersDB->updateById($id, 'last_name', $lastName);
        $usersDB->updateById($id, 'phone', $phone);
        $usersDB->updateById($id, 'street', $street);
        $usersDB->updateById($id, 'city', $city);
        $usersDB->updateById($id, 'postal_code', $postalCode);
    
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
            <li class="nav-item"> <a class="nav-link" href="#account-info">Edit account information</a></li>
            <li class="nav-item"> <a class="nav-link" href="#orders">Display orders</a></li>
            <li class="nav-item"> <a class="nav-link" href="./passwd.php">Change password</a></li>
        </ul>
    </div>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="form-profile mb-5 form rounded shadow mx-auto p-5">
        <?php if (!empty($errors)) : ?>
            <div class="alert alert-danger" role="alert">
                <?php foreach ($errors as $error) : ?>
                    <div><?php echo $error; ?></div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <div class="container">
            <h4 id="account-info">Account information</h4>
            <div class="row align-items-start">
                <div class="col">
                    <label class="form-label" for="email">Email address</label>
                    <input class="form-control" value="<?php echo @$email; ?>" name="email" readonly>
                </div>
            </div>
            <div class="row align-items-start">
                <div class="col">
                    <label class="form-label" for="firstName">First Name</label>
                    <input class="form-control" value="<?php echo @$firstName; ?>" name="firstName">
                </div>
                <div class="col">
                    <label class="form-label" for="lastName">Last Name</label>
                    <input class="form-control" value="<?php echo @$lastName; ?>" name="lastName">
                </div>
            </div>
            <div class="row align-items-start">
                <div class="col">
                    <label class="form-label" for="phone">Phone number</label>
                    <input class="form-control" value="<?php echo @$phone; ?>" name="phone" placeholder="Example: +420 123 456 789">
                </div>
            </div>
            <h4 id="account-info" class="mt-5">Delivery details</h4>
            <div class="row align-items-start">
                <div class="col">
                    <label class="form-label" for="city">City</label>
                    <input class="form-control" value="<?php echo @$city; ?>" name="city" placeholder="Example: Syracuse">
                </div>
            </div>
            <div class="row align-items-start">
                <div class="col">
                    <label class="form-label" for="street">Street</label>
                    <input class="form-control" value="<?php echo @$street; ?>" name="street" placeholder="Example: Saint Marys Avenue 1065">
                </div>
                <div class="col">
                    <label class="form-label" for="postalCode">Postal code</label>
                    <input class="form-control" value="<?php echo @$postalCode; ?>" name="postalCode" placeholder="Example: 13202">
                </div>
            </div>
            <div class="row justify-content-center">
                <button class="btn btn-secondary btn-profile mt-4">Save changes</button>
            </div>
        </div>
    </form>
    <div class="mb-5 form rounded shadow mx-auto p-5">
        <h4 id="orders">Order summary</h4>
    </div>

</main>
<?php include __DIR__ . '/incl/foot.php'; ?>