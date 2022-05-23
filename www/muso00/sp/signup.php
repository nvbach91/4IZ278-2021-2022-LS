<?php
$title = 'Sign up';
session_start(); ?>
<?php require __DIR__ . '/db/UsersDB.php'; ?>
<?php include __DIR__ . '/incl/head.php'; ?>
<?php include __DIR__ . '/incl/nav.php'; ?>
<?php require __DIR__ . '/utils/nonuser_required.php'; ?>
<?php require __DIR__ . '/utils/fb_signin.php'; ?>
<?php

$errors = [];
$ref = 'registration';
$passwdDesc =
    'Your password has to have 
at least one capital letter [A-Z], 
one digit [0-9] and be 
minimum 8 characters long.';

if (!empty($_POST)) {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];

    $hashedPasswd = password_hash($password, PASSWORD_DEFAULT);

    // form input validation
    require __DIR__ . '/utils/name_validation.php';

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, 'Invalid Email');
    }

    require __DIR__ . '/utils/passwd_req.php';
    require __DIR__ . '/utils/register_user.php';
}

?>
<main>
    <div class="mb-5">
        <h1 class="text-center">Registration</h1>
        <form action="signup.php" method="POST" class="form rounded shadow mx-auto p-5">
            <?php require __DIR__ . '/utils/form_error_container.php'; ?>
            <div>
                <label class="form-label">First name<span class="text-danger">*</span></label>
                <input class="form-control" value="<?php echo @$firstName; ?>" name="firstName">
                <label class="form-label">Last name<span class="text-danger">*</span></label>
                <input class="form-control" value="<?php echo @$lastName; ?>" name="lastName">
            </div>
            <div>
                <label class="form-label">Your email<span class="text-danger">*</span></label>
                <input class="form-control" value="<?php echo @$email; ?>" name="email" type="email">
            </div>
            <div class="form-passwd">
                <label class="form-label" title="<?php echo $passwdDesc; ?>">Password<span class="text-danger">*</span></label>
                <input class="form-control" name="password" value="<?php echo @$password; ?>" type="password">
                <label class="form-label">Confirm password<span class="text-danger">*</span></label>
                <input class="form-control" name="confirm" value="<?php echo @$confirm; ?>" type="password">
            </div>
            <button class="btn btn-outline-success rounded-pill btn-submit mx-auto mt-5 mb-2 p-2">Sign up</button>
            <div class="text-secondary text-center">Already have an account? <a href="./signin.php" class="link-secondary">Sign In</a></div>
        </form>
    </div>
</main>

<?php include __DIR__ . '/incl/foot.php'; ?>