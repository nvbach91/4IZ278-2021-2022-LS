<?php
    //CHANGE FOR PRODUCTION
    header("Access-Control-Allow-Origin: http://localhost:8080");
    header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
    header("Access-Control-Allow-Headers: Content-Type, Authorization");
    header('Content-Type: application/json; charset=utf-8');
    //=====================
    require_once("../php/configHelper.php");
    require("../php/requestHelper.php");
    require("../php/database.php");
    require("../php/authHelper.php");
    require_once("../php/phpHelper.php");

    RequestHelper::getInstance()->checkMethod("POST");

    $username = RequestHelper::getInstance()->getParam("username", true);
    $password = RequestHelper::getInstance()->getParam("password", true);

    $user = Database::getInstance()->assocQuery("SELECT idUser, username, password FROM Users WHERE Username = '{0}'", [$username]);

    if(count($user) == 0)
        RequestHelper::getInstance()->reject("USER_NOT_FOUND");

    //Bude vždy jediný, protože Username je unique
    $user = $user[0];
    $roles = Database::getInstance()->assocQuery("SELECT r.name FROM UserRoles ur LEFT JOIN Roles r ON(r.idRole = ur.idRole) WHERE idUser = '{0}'", [$user["idUser"]]);

    if(!password_verify($password, $user["password"])){
        RequestHelper::getInstance()->reject("IVALID_PASSWORD");
    }

    $exp = new DateTime();
    $exp->modify(ConfigHelper::getInstance()->getConfigValue("token_valid_time"));
    $exp = $exp->getTimestamp();

    $token = AuthHelper::getInstance()->generateToken([
        'idUser' => $user["idUser"],
        'username' => $user["username"],
        'roles' => assocArrayToArray($roles, "name"),
        'exp' => $exp
    ]);

    echo json_encode([
        'token' => $token
    ]);
?>