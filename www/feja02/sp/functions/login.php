<?php
session_start();

require "../database/database.php";
require "../database/usersdb.php";
require "../database/usertokensdb.php";

if (!empty($_POST)) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $usersDb = new UsersDB();
    $tokensDb = new UserTokensDB();
    $user = $usersDb->fetchByEmail($email)[0];
    if (is_array($user)) {
        if (password_verify($password, $user["password"])) {
            if($_POST["remember"] == 1 || $_POST["remember"] == "on") {
                $token = bin2hex(random_bytes(32));
                $expire = date('Y-m-d H:i:s', strtotime('+ 30 days'));
                setcookie("token", $token, strtotime($expire), "/");
                $tokensDb->create([
                    "user_id" => 1,
                    "token" => $token,
                    "expire" => $expire
                ]);

            }
            $_SESSION["login_id"] = $user["id"];
            $_SESSION["login_email"] = $user["email"];
            $_SESSION["login_oauth"] = 0;
            $_SESSION["login_role"] = $user["role"];
            header("Location: ../");
            exit();
        }
    }
}
header("Location: ../login?error=1");
?>
