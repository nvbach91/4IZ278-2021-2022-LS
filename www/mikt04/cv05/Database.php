<?php require './DatabaseOperations.php';?>
<?php require './config.php';?>
<?php

abstract class Database implements DatabaseOperations {
    protected $pdo;
    public function __construct() {
        $connectionString = "mysql:host=" . DATABASE_URL . ";dbname=" . DATABASE_NAME;
        $this->pdo = new PDO(
            $connectionString,
            DATABASE_USERNAME,
            DATABASE_PASSWORD
        );
        echo "Database ready";
    }
    public function __toString()
    {
        return DATABASE_NAME . DATABASE_URL;
    }

}

/*
$db = new Database();
$db->pdo->prepare();
*/

?>