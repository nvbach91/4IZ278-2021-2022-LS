<?php 

require '../config/db-parameters.php';

$db = new PDO(
    'mysql:host=' . DATABASE_URL .';dbname=' . DATABASE_NAME .';charset=utf8mb4',
    DATABASE_USERNAME,
    DATABASE_PASSWORD
);

$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
?>