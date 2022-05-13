<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

//Autoload
define('ROOT', dirname(__FILE__));
require_once(ROOT . '/components/Autoload.php');

//Run router
$router = new Router();
$router->run();
