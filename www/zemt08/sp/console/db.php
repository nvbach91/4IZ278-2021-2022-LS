<?php include("config.php"); ?>
<?php

$connectionString = "mysql:host=" . DATABASE_URL . ";dbname=" . DATABASE_NAME;
$con = new PDO($connectionString, DATABASE_USERNAME, DATABASE_PASSWORD);

$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$con->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
