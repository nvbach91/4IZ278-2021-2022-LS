<?php require __DIR__ . '/db/UsersDB.php'; ?>
<?php require __DIR__ . '/utils/utils.php'; ?>
<?php $title = 'Sign up'; ?>
<?php
session_start();

$errors = [];
$passwdReq = '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,32}$/';
$ref = 'registration';

if (!empty($_POST)) {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];

    $hashedPasswd = password_hash($password, PASSWORD_DEFAULT);

    // form input validation
    if (strlen($firstName) < 2) {
        array_push($errors, 'First name is too short');
    }

    if (strlen($lastName) < 2) {
        array_push($errors, 'Last name is too short');
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, 'Invalid Email');
    }

    if (!preg_match($passwdReq, $password)) {
        array_push($errors, 'Invalid Password');
    }

    if ($password !== $confirm) {
        array_push($errors, 'The passwords do not match');
    }

    $usersDB = new UsersDB();
    $res = $usersDB->fetchByEmail($email);

    if ($res->rowCount() == 0) {
        $existingUser = null;
    } else {
        $existingUser = $res->fetchAll()[0];
    }

    if (!count($errors)) {
        if (is_null($existingUser)) {
            $users = $usersDB->create(['email' => $email, 'firstName' => $firstName, 'lastName' => $lastName, 'password' => $hashedPasswd]);
            header("Location: signin.php?ref=$ref&email=$email");
            exit();
        } else {
            array_push($errors, 'User with this email already registered!');
        }
    }
}

?>

<?php include __DIR__ . '/incl/head.php'; ?>
<?php include __DIR__ . '/incl/nav.php'; ?>
<main>
    <div class="sign-container">
        <h1 class="text-center">Registration</h1>
        <form action="signup.php" method="POST" class="form rounded shadow mx-auto p-5">
            <?php if (!empty($errors)) : ?>
                <div class="alert alert-danger" role="alert">
                    <?php foreach ($errors as $error) : ?>
                        <div><?php echo $error; ?></div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <div>
                <label class="form-label" for="firstName">First name<span class="text-danger">*</span></label>
                <input class="form-control" value="<?php echo @$firstName;?>" name="firstName">
                <label class="form-label" for="lastName">Last name<span class="text-danger">*</span></label>
                <input class="form-control" value="<?php echo @$lastName;?>" name="lastName">
            </div>
            <div>
                <label class="form-label" for="email">Your email<span class="text-danger">*</span></label>
                <input class="form-control" value="<?php echo @$email;?>" name="email" type="email">
            </div>
            <div class="form-passwd">
                <label class="form-label">Password<span class="text-danger">*</span></label>
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