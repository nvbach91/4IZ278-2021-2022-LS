<?php
session_start();

require "../database/database.php";
require "../database/usersdb.php";

if (!empty($_POST)) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $usersDb = new UsersDB();
    $user = $usersDb->fetchByEmail($email)[0];
    if (is_array($user)) {
        if (password_verify($password, $user["password"])) {
            $_SESSION["login_id"] = $user["id"];
            $_SESSION["login_email"] = $user["email"];
            $_SESSION["login_role"] = $user["role"];
            header("Location: ../");
            exit();
        }
    }
}
header("Location: ../login?error=1");
?>
