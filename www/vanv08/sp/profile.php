<?php 
$title = 'Profile';
session_start();
session_regenerate_id(true);
$errors = [];

include __DIR__ . '/incl/head.php';
include __DIR__ . '/incl/nav.php';

$u_email = $_SESSION['user_email'];
$u_id = $_SESSION['user_id'];

// protect acccess
if (!$u_email || !$u_id){
    header("location: login.php");
    exit();
}
//  req
require  __DIR__ . '/db/UsersDB.php'; 
include __DIR__ . '/incl/head.php';

// fetch info
require __DIR__ . '/utils/login_user_info.php';

// update changes

if (!empty($_POST)) {
    $first_name = ucfirst($_POST['first_name']);
    $last_name = ucfirst($_POST['last_name']);
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $city = $_POST['city'];
    $street = $_POST['street'];
    $postal = $_POST['postal'];

    if (!count($errors)) {
        $usersDB->updateAllbyId($first_name, $last_name, $phone, $street, $city, $postal, $_SESSION['user_id']);

        
    }
    // Validate input
    require __DIR__ . '/utils/validate_profile.php';
}

?>

<div class="header">
        <h2>Profile</h2>
        <?php if (!empty($errors)) : ?>
        <div class="alert alert-danger" role="alert">
            <?php foreach ($errors as $error) : ?>
            <div><?php echo $error; ?></div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
    <div class="mb-3">
        <label class="form-label">Email</label> <br>
        <input class="form-control" value="<?php echo @$email; ?>" name="email" readonly>
    </div>
    <div class="mb-3">
        <label class="form-label">First Name</label> <br>
        <input class="form-control" value="<?php echo @$first_name; ?>" name="first_name">
    </div>
    <div class="mb-3">
        <label class="form-label">Last Name</label><br>
        <input class="form-control " value="<?php echo @$last_name; ?>" name="last_name">
    </div>
    <div class="mb-3">
        <label class="form-label">Phone</label><br>
        <input class="form-control" value="<?php echo @$phone; ?>" name="phone">
    </div>
    <div class="mb-3">
        <label class="form-label">City</label><br>
        <input class="form-control " value="<?php echo @$city; ?>" name="city">
    </div>
    <div class="mb-3">
        <label class="form-label">Street</label><br>
        <input class="form-control " value="<?php echo @$street; ?>" name="street">
    </div>
    <div class="mb-3">
        <label class="form-label">Postal code</label><br>
        <input class="form-control " value="<?php echo @$postal; ?>" name="postal">
    </div>
    <div class="mb-3">
        <button type="submit" class="btn btn-secondary" name="save_changes">Save changes</button>
    </div>
</form>