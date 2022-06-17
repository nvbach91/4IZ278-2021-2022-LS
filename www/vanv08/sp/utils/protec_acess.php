<?php
session_start();
session_regenerate_id(true);
$errors = [];
define('FP_GRAPH_VERSION', 'v6.0');
define('FP_GRAPH_DOMAIN', 'https://graph.facebook.com/');
define('FP_APP_STATE', 'eciphp');
?>

<?
$u_email = $_SESSION['user_email'];
$u_id = $_SESSION['user_id'];
$auth = $_SESSION['user_level'];

// protect acccess
if (!$u_email || !$u_id){
    header("location: login.php");
    exit();
}
?>