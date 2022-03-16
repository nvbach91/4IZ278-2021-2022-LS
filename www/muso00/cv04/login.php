<?php require './utils/utils.php' ?>
<?php
$root = './';
$errors = [];
$isLoggedIn = false;

if (!empty($_GET)) {
    $email = $_GET['email'];
    $ref = $_GET['ref'];
}

if (!empty($_POST)) {
    $email = $_POST['email'];
    $password = $_POST['password'];


    if (strlen($email) < 0) {
        array_push($errors, '*Fill in the email');
    }

    if (strlen($password) < 0) {
        array_push($errors, '*Fill in the password');
    }
    
    $users = fetchUsers();
    if (!count($errors)) {
        $authentication = authenticate($email, $password);
        if (is_string($authentication)) {
            array_push($errors, $authentication);
        } else {
            $isLoggedIn = $authentication;
        }
    }

    if ($isLoggedIn) {
        header("Location: ./profile.php?login=true&email=$email");
        exit();
    }
}
?>
<?php require './includes/head.php' ?>
<?php if (!$isLoggedIn) : ?>
    <?php if (isset($ref) && $ref === 'registration') : ?>
        <div class="success-msg">Congratulations! Registration was successful.</div>
    <?php endif; ?>
<?php endif; ?>
<h1>Login</h1>
<main>
    <div class="error-container">
        <?php foreach ($errors as $error) : ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endforeach; ?>
    </div>
    <form action="./login.php" method="POST" class="login">
        <div>
            <label>Username<span class="mandatory">*</span></label>
            <input placeholder="email" name="email" type="email" value="<?php echo @$email; ?>">
        </div>
        <div>
            <label>Password<span class="mandatory">*</span></label>
            <input placeholder="password" name="password" type="password">
        </div>
        <button class="button">Log in</button>
        <div><a href="./registration.php" class="register">Register</a></div>
    </form>
</main>

<?php require './includes/foot.php' ?>