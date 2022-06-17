<?php

require_once __DIR__ . "/../database/usersdb.php";

$usersDb = new UsersDB();

if (!empty($_SESSION["login_id"])) {
    if ($_SESSION["login_oauth"] != 1) {
        if(!count($usersDb->fetchById($_SESSION["login_id"]))) {
            session_destroy();
        header("Location: ./");
        exit();
        }
    }
}
else {
    header("Location: ./");
    exit();
}
?>
