<?php

require_once __DIR__ "./config.php";
require_once __DIR__ "./database_operations.php";

abstract class Database implements DatabaseOperations {
    
    protected $pdo;

    public function __construct() {
        $connectionString = "mysql:host=" . DB_URL .";dbname=" . DB_NAME;
        $this->pdo = new PDO(
            $connectionString,
            DB_USERNAME,
            DB_PASSWORD
        );
    }
}

?>