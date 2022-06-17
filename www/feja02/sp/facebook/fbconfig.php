<?php
session_start();
require_once( './vendor/autoload.php' );

$fb = new Facebook\Facebook([
    'app_id' => '',
    'app_secret' => '',
    'default_graph_version' => 'v2.5',
]);

$helper = $fb->getRedirectLoginHelper();

$permissions = ['email'];
$loginUrl = $helper->getLoginUrl('https://eso.vse.cz/~feja02/snusworld/facebook/callback.php', $permissions);
header("location: ".$loginUrl);

?>
