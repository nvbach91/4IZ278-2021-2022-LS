<?php

$db = new PDO(
  'mysql:host=localhost;dbname=staj19;charset=utf8mb4',
  'staj19',
  'maF9eiga3Eheigoi3a'
);

$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
