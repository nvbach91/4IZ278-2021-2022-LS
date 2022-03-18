<?php include './header.php' ?>
<?php require './utils.php' ?>


<?php
$errors = [];
$userLoggedIn = false;;
if ($_GET) {
    $email = $_GET['email'];
    $ref = $_GET['ref'];
}

if (!empty($_POST)) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, 'Invalid email');
    }

    if (strlen($password) < 3) {
        array_push($errors, 'Fill in your password');
    }

    $users = getUsers();
    if (!count($errors)) {
        $auth = authenticate($email, $password);
        if (is_string($auth)) {
            array_push($errors, $auth);
        } else {
            $userLoggedIn = true;
        }
    }
}
?>
<main>
    <h1>Login form</h1>
    <?php if (isset($ref) && $ref === 'register') : ?>
    <div class="registration-status">
      <p>Registration was successful</p>
    </div>
    <?php endif; ?>
    <?php if (!$userLoggedIn) : ?>
        <?php foreach ($errors as $error) : ?>
            <div class="error"><?php echo $error; ?> </div>
        <?php endforeach; ?>
        <form action="./login.php" method="POST">
            <label>Your email</label>
            <input placeholder="email" name="email" type="email" value="<?php echo @$email; ?>">
            <label>Your password</label>
            <input placeholder="password" name="password" type="password" value="<?php echo @$password; ?>">
            <button>Submit</button>
        </form>

    <?php else : ?>
        <p>Successfully logged in</p>
    <?php endif; ?>
</main>

<?php include './footer.php'; ?>