<?php session_start() ?>
<?php require '../db/Database.php' ?>
<?php require '../functions/userRequired.php' ?>


<?php

if(empty($_POST)){
    header('Location: ../changePassword.php');
    exit();
}

$currentPassword = $_POST['currentPassword'];
$newPassword = $_POST['newPassword'];
$newPassword2 = $_POST['newPassword2'];

$usersDB =  new UsersDB();
$user = $usersDB->fetchById($_SESSION['lg_email'])[0];

if (!password_verify($currentPassword,$user['password'])){
    header('Location: ../changePassword.php?err=1');
    exit();
}

if(strlen($newPassword)< 8){
    header('Location: ../changePassword.php?err=2');
    exit();
}

if ($newPassword!=$newPassword2){
    header('Location: ../changePassword.php?err=3');
    exit();
}

$hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
if($usersDB->updateById($user['user_id'],'password',$hashedPassword)){
    header('Location: ../changePassword.php?success=1');
    exit();
}

header('Location: ../changePassword.php?err=4');





?>
