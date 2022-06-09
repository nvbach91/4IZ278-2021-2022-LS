<?php require __DIR__.'/../db/UsersDB.php' ?>

<?php
if (!isset($_SESSION['lg_email'])) {
    header('Location: ../login.php');
    exit();
}

$usersDB =  new UsersDB();
$current_user = $usersDB->fetchById($_SESSION['lg_email'])[0];

if (!$current_user) {
    session_destroy();
    header('Location: ../index.php');
    exit();
}

if ($current_user['privileges']!=2) {
    var_dump($current_user);
    $_SESSION['lg_privileges'] = 1;
    header('Location: ../index.php');
    exit();
}
