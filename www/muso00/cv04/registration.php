<?php require './utils/utils.php'; ?>
<?php
$root = './';
$errors = [];
$passwdReq = '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,32}$/';

if (!empty($_POST)) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];

    if (strlen($name) < 3) {
        array_push($errors, '*The name is too short');
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, '*Invalid Email');
    }

    if (!preg_match($passwdReq, $password)) {
        array_push($errors, '*Invalid Password');
    }

    if ($password !== $confirm) {
        array_push($errors, '*The passwords does not match');
    }

    if (fetchUser($email)) {
        array_push($errors, "A user with this email ($email) is already registered! Choose different email.");
    }

    if (!count($errors)) {
        registerNewUser($name, $email, $password);
        header("Location: login.php?ref=registration&email=$email");
        exit();
    }
}

?>
<?php include './includes/head.php'; ?>
<h1>Registration</h1>
<main>
    <form action="registration.php" method="POST">
        <div class="error-container">
            <?php foreach ($errors as $error) : ?>
                <div class="error"><?php echo $error; ?></div>
            <?php endforeach; ?>
        </div>
        <div>
            <label for="name">Name<span class="mandatory">*</span></label>
            <input value="<?php echo isset($name) ? $name : '' ?>" name="name">
            <small class="description">Example: John</small>
        </div>
        <div>
            <label for="email">Your email<span class="mandatory">*</span></label>
            <input value="<?php echo isset($email) ? $email : '' ?>" name="email" type="email">
            <small class="description">Example: example@example.com</small>
        </div>
        <div>
            <label>Password<span class="mandatory">*</span></label>
            <input name="password" value="<?php echo @$password; ?>" type="password">
            <label>Confirm password<span class="mandatory">*</span></label>
            <input name="confirm" value="<?php echo @$confirm; ?>" type="password">
            <small class="description">Password has to be between 8-32 characters long. Use the combination of digits, lower-case, upper-case characters.</small>
        </div>
        <button class="button">Sign up</button>
    </form>
</main>

<?php include './includes/foot.php'; ?>