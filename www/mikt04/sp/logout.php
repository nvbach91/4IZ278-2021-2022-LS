<?php

include './include/nav.php';

session_destroy();

if (isset($_COOKIE['email'])) {
    unset($_COOKIE['email']); 
    setcookie('remember_user', null, -1, '/');
}

header('Location: ./index.php');

?>