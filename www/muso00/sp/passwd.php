<?php
$title = 'Password change';
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
$passwdReq = '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,32}$/';
$id = intval($_SESSION['user_id']);

$usersDB = new UsersDB();
$result = $usersDB->fetchById($_SESSION['user_id']);
$userInfo = $result->fetchAll()[0];

if (!empty($_POST)) {
    $originalPasswd = $_POST['originalPasswd'];
    $newPasswd = $_POST['newPasswd'];
    $confirmPasswd = $_POST['confirmPasswd'];

    if (empty($originalPasswd) || empty($newPasswd) || empty($confirmPasswd)) {
        array_push($errors, 'Fill in old the fields');
    }

    if (!preg_match($passwdReq, $newPasswd)) {
        array_push($errors, 'Invalid Password');
    }

    if ($newPasswd !== $confirmPasswd) {
        array_push($errors, 'The passwords do not match');
    }

    if (!count($errors)) {
        if (password_verify($originalPasswd, $userInfo['password'])) {
        $hashedPasswd = password_hash($newPasswd, PASSWORD_DEFAULT);
        $usersDB->updateById($id, 'password', $hashedPasswd);
        header('Location: ./profile.php');} else {
            array_push($errors, 'Wrong current password');
        }
    }
}

?>
<main>
    <h1 class="text-center">Password change</h1>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="form form-profile rounded shadow mx-auto p-5">
    <div class="align-items-end justify-content-end"><a type="button" class="btn-close justify-content-end" aria-label="Close" href="./profile.php"></a></div>
        <?php if (!empty($errors)) : ?>
            <div class="alert alert-danger" role="alert">
                <?php foreach ($errors as $error) : ?>
                    <div><?php echo $error; ?></div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <div class="container">
            <div class="row align-items-start">
                <div class="col">
                    <label class="form-label" for="originalPasswd">Current password</label>
                    <input class="form-control" value="<?php echo @$originalPasswd; ?>" name="originalPasswd" type="password">
                </div>
            </div>
            <div class="row align-items-start">
                <div class="col">
                    <label class="form-label" for="newPasswd">New password</label>
                    <input class="form-control" value="<?php echo @$newPasswd; ?>" name="newPasswd" type="password">
                </div>
            </div>
            <div class="row align-items-start">
                <div class="col">
                    <label class="form-label" for="confirmPasswd">Old password</label>
                    <input class="form-control" value="<?php echo @$confirmPasswd; ?>" name="confirmPasswd" type="password">
                </div>
            </div>
            <div class="row justify-content-center">
                <button class="btn btn-secondary btn-profile mt-4">Save changes</button>
            </div>
        </div>
    </form>

</main>
<? include __DIR__ . '/incl/foot.php'; ?>