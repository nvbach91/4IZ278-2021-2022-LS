<?php
require "utils/access.php";
require "utils/validation.php";

$login_success = false;


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Card Tournament Signup</title>
    <link rel="stylesheet" href="https://bootswatch.com/4/flatly/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
</head>
<body>

<h1 class="text-center">Login to Card Tournament</h1>
<hr>

<div class="row justify-content-center">
<?php
if (!empty($_POST)) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $validation_failed = false;
    $validation_failed += !validate_email() + !validate_password();

    $all_users = fetchUsers();

    if (!$validation_failed) {
        $auth_ret = authenticate($email, $password);
        if (!$auth_ret) {
            echo "Email and password does not match, Failed to Sign In<br>";
        } else {
            $login_success = true;
            echo "Logged in successfully<br>";
        }
    } else {
        echo "Credentials are not valid<br>";
    }
}
?>
</div>
<br>

<?php if (!$login_success) : ?>
    <div class="row justify-content-center">
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
            <div class="form-group">
                <label>Email</label>
                <input class="form-control" name="email" type="email" value="<?php echo @$email; ?>">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input class="form-control" name="password" type="password" value="<?php echo @$password; ?>">
            </div>
            <button class="btn btn-primary">Sign In</button>
        </form>
    </div>

<?php endif; ?>
</body>