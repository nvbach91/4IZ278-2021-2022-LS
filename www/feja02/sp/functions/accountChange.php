<?php
session_start();

require "../database/database.php";
require "../database/usersdb.php";

if (empty($_SESSION["login_id"])) header("Location: ../");
if (empty($_POST)) header("Location: ../account");

$email = $_POST["email"];
$emailConfirm = $_POST["emailConfirm"];
$emailStatus = 0;
$password = $_POST["password"];
$passwordConfirm = $_POST["passwordConfirm"];
$passwordStatus = 0;

$usersDb = new UsersDB();

if (strlen($email) || strlen($emailConfirm)) {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $emailStatus = 2;
    elseif ($email == $emailConfirm) {
        $emailStatus = 1;
        $usersDb->updateById($_SESSION["login_id"], "email", $email);
        $_SESSION["login_email"] = $email;
    }
    else $emailStatus = 3;
}

if ($passwordStatus == 0 && (strlen($password) || strlen($passwordConfirm))) {
    if (strlen($password) < 8) $passwordStatus = 2;
    elseif ($password == $passwordConfirm) {
        $passwordStatus = 1;
        $usersDb->updateById($_SESSION["login_id"], "password", password_hash($password, PASSWORD_DEFAULT));
    }
    else $passwordStatus = 3;
}

header("Location: ../account?email=" . $emailStatus . "&pass=" . $passwordStatus);
?>
