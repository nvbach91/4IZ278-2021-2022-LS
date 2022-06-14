<?php
require_once __DIR__ . '/requireUser.php';

if(!$_SESSION['user_isAdmin']){
    header('Location: animals.php');
}
?>