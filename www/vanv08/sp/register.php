<?php
$title = 'Registration';
require  __DIR__ . '/db/UsersDB.php';
include __DIR__ . '/incl/head.php'; 
include __DIR__ . '/incl/nav.php';
?>

<?php

$errors = [];
$usersDB = new UsersDB();
if(!empty($_POST)){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $re_password = $_POST['re_password'];
    $hashedPassword= password_hash($password, PASSWORD_DEFAULT);
    $existingUser = $usersDB->fetchByEmail($email);
    
    


// INPUT VALIDATION

require __DIR__ . '/utils/validate_reg.php';



// check if user exists
$result = $usersDB->fetchByEmail($email);
if ($result->rowCount() == 0) {
    $existingUser = null;
} else {
    $existingUser = 'user found';
}

if (!count($errors)) {
    if (is_null($existingUser)) {
        $usersDB->create(['email' => $email, 'password' => $hashedPassword]);
        header("Location: login.php?ref=$ref&email=$email");
        exit();
    } else {
        array_push($errors, 'Existing email in DB!');
    }
}}


?>

<body class="d-flex flex-column min-vh-100">
    <div class="header">
        <h2>Register</h2>
        <?php if (!empty($errors)) : ?>
        <div class="alert alert-danger" role="alert">
            <?php foreach ($errors as $error) : ?>
            <div><?php echo $error; ?></div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
    <form method="post" action="register.php">
        <div class="mb-3">
            <label>Email</label>
            <input class="form-control" name="email" value="<?php echo isset($email) ? $email : '' ?>">
        </div>
        <div class="mb-3">
            <label>Password</label>
            <input class="form-control" name="password" type="password"
                value="<?php echo isset($password) ? $password : '' ?>">
        </div>
        <div class="mb-3">
            <label>Repeat password</label>
            <input class="form-control" name="re_password" type="password"
                value="<?php echo isset($re_password) ? $re_password : '' ?>">
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-secondary" name="register">Register</button>
        </div>
        <p>
            Already a member? <a href="login.php">Sign in</a>
        </p>
    </form>
</body>

</html>
<?php include __DIR__ . '/incl/footer.php' ?>