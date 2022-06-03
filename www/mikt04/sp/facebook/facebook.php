<?php

require_once __DIR__ . '/vendor/autoload.php';

$fb = new \Facebook\Facebook([
  'app_id' => '450172370246543',
  'app_secret' => '4e792298a0c2d4b199c89d824cc2bb00',
  'default_graph_version' => 'v2.10',
  //'default_access_token' => '{access-token}', // optional
]);
?>