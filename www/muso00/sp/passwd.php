<?php
$title = 'Password change';
session_start();
?>
<?php require __DIR__ . '/db/UsersDB.php'; ?>
<?php include __DIR__ . '/incl/head.php'; ?>
<?php include __DIR__ . '/incl/nav.php'; ?>
<?php require __DIR__ . '/utils/user_required.php';
?>
<?php
$errors = [];
$id = intval($_SESSION['user_id']);
$value = 'password';

$usersDB = new UsersDB();
$res = $usersDB->fetchById($_SESSION['user_id']);
$userInfo = $res->fetchAll()[0];

if (!empty($_POST)) {
    $originalPasswd = $_POST['originalPasswd'];
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];

    if (empty($originalPasswd) || empty($password) || empty($confirm)) {
        array_push($errors, 'Fill in all the fields');
    }

    require __DIR__ . '/utils/passwd_req.php';

    if (!count($errors)) {
        if (password_verify($originalPasswd, $userInfo['password'])) {
            $hashedPasswd = password_hash($password, PASSWORD_DEFAULT);
            $usersDB->updateById('password', $hashedPasswd, $id);
            header('Location: ./profile.php');
        } else {
            array_push($errors, 'Invalid current password');
        }
    }
}

?>
<main>
    <h1 class="text-center">Password change</h1>
    <div class="form form-profile rounded shadow mx-auto p-5">
        <div><a class="btn-close float-end" aria-label="Close" href="./profile.php"></a></div>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <?php require __DIR__ . '/utils/form_error_container.php'; ?>
            <div class="container">
                <div class="row align-items-start">
                    <div class="col">
                        <label class="form-label">Current password</label>
                        <input class="form-control" value="<?php echo @$originalPasswd; ?>" name="originalPasswd" type="password">
                    </div>
                </div>
                <div class="row align-items-start">
                    <div class="col">
                        <label class="form-label">New password</label>
                        <input class="form-control" value="<?php echo @$password; ?>" name="password" type="password">
                    </div>
                </div>
                <div class="row align-items-start">
                    <div class="col">
                        <label class="form-label">Confirm password</label>
                        <input class="form-control" value="<?php echo @$confirm; ?>" name="confirm" type="password">
                    </div>
                </div>
                <div class="row justify-content-center">
                    <button class="btn btn-secondary btn-profile mt-4">Save changes</button>
                </div>
            </div>
        </form>
    </div>
</main>
<? include __DIR__ . '/incl/foot.php'; ?>