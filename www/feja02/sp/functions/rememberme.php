<?php

require_once __DIR__ . "/../database/usersdb.php";
require_once __DIR__ . "/../database/usertokensdb.php";

if (empty($_SESSION["login_id"])) {
    if (isset($_COOKIE["token"])) {
        $usersDb = new UsersDB();
        $tokensDb = new UserTokensDB();
        
        $token = $_COOKIE["token"];
        if (is_array($tokensDb->fetchByToken($token))) {
            $row = $tokensDb->fetchByToken($token)[0];
            if ($token == $row["token"]) {
                $user = $usersDb->fetchById($row["user_id"])[0];
                $_SESSION["login_id"] = $user["id"];
                $_SESSION["login_email"] = $user["email"];
                $_SESSION["login_role"] = $user["role"];
                $_SESSION["login_oauth"] = 0;
            }
        }
    }
}

?>