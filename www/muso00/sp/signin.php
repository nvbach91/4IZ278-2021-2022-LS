<?php
$title = 'Sign in';
session_start();
?>
<?php require __DIR__ . '/db/UsersDB.php'; ?>
<?php include __DIR__ . '/incl/head.php'; ?>
<?php include __DIR__ . '/incl/nav.php'; ?>
<?php require __DIR__ . '/utils/nonuser_required.php'; ?>
<?php require __DIR__ . '/utils/fb_signin.php'; ?>
<?php
$errors = [];

if (!empty($_GET)) {
    $email = $_GET['email'];
    $ref = $_GET['ref'];
}

if (!empty($_POST)) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        array_push($errors, 'Fill in the username and password');
    }

    require __DIR__ . '/utils/login_user.php';
}
?>
<?php if (isset($ref) && $ref === 'registration') : ?>
    <div class="alert alert-success text-center" role="alert">Congratulations, registration was successful!</div>
<?php endif; ?>
<h1 class="text-center">Login</h1>
<main>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="form rounded shadow mx-auto p-5">
        <?php require __DIR__ . '/utils/form_error_container.php'; ?>
        <div>
            <label class="form-label">Username</label>
            <input class="form-control" placeholder="email" name="email" type="email" value="<?php echo @$email; ?>" <?php if (isset($ref)) {
                                                                                                                            echo "readonly";
                                                                                                                        }; ?>>
        </div>
        <div>
            <label class="form-label">Password</label>
            <input class="form-control" placeholder="password" name="password" type="password">
        </div>
        <button class="btn btn-outline-success rounded-pill btn-submit mx-auto mt-5 mb-2 p-2">Sign in</button>
        <div class="text-secondary text-center">Don't have an account yet? <a href="./signup.php" class="link-secondary">Sign up</a></div>
    </form>
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col h4 text-center mb-3 text-secondary">
                OR
            </div>
        </div>
        <div class="row form mx-auto">
            <div class="col text-center p-4">
                <a href="./facebook/index.php" class="btn btn-outline-primary rounded-pill p-2"><i class="bi bi-facebook"></i>&nbsp;Login with Facebook</a>
            </div>
        </div>
    </div>
</main>
<?php include __DIR__ . '/incl/foot.php'; ?>