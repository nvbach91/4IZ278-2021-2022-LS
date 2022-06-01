<?php require 'DatabaseOperations.php'?>
<?php require 'config.php'?>
<?php

abstract class Database implements DatabaseOperations {
    protected $pdo;
    public function __construct(){
        $connectionString = "mysql:host=" . DATABASE_URL . ";dbname=" . DATABASE_NAME;
        $this->pdo = new PDO(
            $connectionString,
            DATABASE_USER_NAME,
            DATABASE_PASSWORD
        );
    }

    public function fetchAll(){
    }

    public function fetchById($id){
    }

    public function updateById($id, $field, $value){
    }

    public function create($args){
    }

    public function deleteById($id){
    }
}