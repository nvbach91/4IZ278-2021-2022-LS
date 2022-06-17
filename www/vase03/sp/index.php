<?php

//Front Controller

//Settings
error_reporting(E_ALL);
ini_set("memory_limit","1024M");
ini_set('display_errors', 1);

session_start();

//Connect files
define('ROOT', dirname(__FILE__));
require_once(ROOT . '/components/Autoload.php');
//require_once(ROOT . '/components/Router.php');
//require_once(ROOT . '/components/Db.php');
//Connect DB

//Call Router
$router = new Router();
$router->run();
