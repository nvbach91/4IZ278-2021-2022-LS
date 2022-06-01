<?php require __DIR__.'/../db/UsersDB.php' ?>

<?php
if (!isset($_SESSION['lg_email'])) {
    header('Location: ../login.php');
    exit();
}

$usersDB =  new UsersDB();
$current_user = $usersDB->fetchById($_SESSION['lg_email']);

if (!$current_user) {
    session_destroy();
    header('Location: ../index.php');
    exit();
}


