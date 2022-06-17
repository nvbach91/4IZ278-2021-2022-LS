<?php
require_once __DIR__ . '/includes/requestUser.php';

if(!$_SESSION['user_isAdmin']){
    header('Location: animals.php');
}
?>