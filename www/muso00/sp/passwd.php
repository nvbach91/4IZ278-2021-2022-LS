<?php
$title = 'Password change';
session_start();
?>
<?php require __DIR__ . '/db/UsersDB.php'; ?>
<?php include __DIR__ . '/incl/head.php'; ?>
<?php include __DIR__ . '/incl/nav.php'; ?>
<?php require __DIR__ . '/utils/user_required.php'; ?>
<?php
$errors = [];
$id = intval($_SESSION['user_id']);

$usersDB = new UsersDB();
$res = $usersDB->fetchById($_SESSION['user_id']);
$userInfo = $res->fetchAll()[0];

if (!empty($_POST)) {
    $originalPasswd = $_POST['originalPasswd'];
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];

    if (empty($originalPasswd) || empty($newPasswd) || empty($confirmPasswd)) {
        array_push($errors, 'Fill in all the fields');
    }

    require __DIR__ . '/utils/passwd_req.php';

    if (!count($errors)) {
        if (password_verify($originalPasswd, $userInfo['password'])) {
            $hashedPasswd = password_hash($newPasswd, PASSWORD_DEFAULT);
            $usersDB->updateById($id, 'password', $hashedPasswd);
            header('Location: ./profile.php');
        } else {
            array_push($errors, 'Wrong current password');
        }
    }
}

?>
<main>
    <h1 class="text-center">Password change</h1>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="form form-profile rounded shadow mx-auto p-5">
        <div><a type="button" class="btn-close float-end" aria-label="Close" href="./profile.php"></a></div>
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
                    <label class="form-label" for="password">New password</label>
                    <input class="form-control" value="<?php echo @$password; ?>" name="password" type="password">
                </div>
            </div>
            <div class="row align-items-start">
                <div class="col">
                    <label class="form-label" for="confirm">Confirm password</label>
                    <input class="form-control" value="<?php echo @$confirm; ?>" name="confirm" type="password">
                </div>
            </div>
            <div class="row justify-content-center">
                <button class="btn btn-secondary btn-profile mt-4">Save changes</button>
            </div>
        </div>
    </form>

</main>
<? include __DIR__ . '/incl/foot.php'; ?>