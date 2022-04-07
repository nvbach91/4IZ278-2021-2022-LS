<?php require __DIR__ . '/config.php'; ?>
<?php
$connectionString = "mysql:host=" . DATABASE_URL . ";dbname=" . DATABASE_NAME;
$db = new PDO($connectionString, DATABASE_USERNAME, DATABASE_PASSWORD);

$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
?> 