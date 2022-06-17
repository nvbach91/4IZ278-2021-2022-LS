<?php
require_once __DIR__ . "/../database/database.php";
require_once __DIR__ . "/../database/usersdb.php";

if (empty($_SESSION["login_id"])) {
    header("Location: ./login");
    exit();
}

$usersDb = new UsersDB();
$user = $usersDb->fetchById($_SESSION["login_id"])[0];
if (!is_array($user)) { //Pokud byl ucet odstranen
    session_destroy();
    header("Location: ./");
    exit();
}
elseif ($user["role"] != 1) {
    header("Location: ./");
    exit();
}
?>
