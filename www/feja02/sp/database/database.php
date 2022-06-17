<?php

require_once "config.php";
require_once "databaseoperations.php";

abstract class Database implements DatabaseOperations {

    protected $pdo;

    public function __construct() {
        $connectionString = "mysql:host=" . DB_URL .";dbname=" . DB_NAME . ";charset=utf8mb4";
        $this->pdo = new PDO(
            $connectionString,
            DB_USERNAME,
            DB_PASSWORD
        );
    }

    public function fetchAll(){}

    public function fetchById($id){}

    public function updateById($id, $field, $value){}

    public function create($args){}

    public function deleteById($id){}
    
}

?>
