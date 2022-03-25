<?php require './config.php' ?>
<?php require './DatabaseOperations.php';  ?>
<?php

abstract class Database implements DatabaseOperations {
    protected $pdo;
    public function __construct() {
        $connectionString = "mysql:host=". DATABASE_URL . ";dbname=". DATABASE_NAME;
        $this -> pdo = new PDO(
                $connectionString,
                DATABASE_USERNAME,
                DATABASE_PASSWORD
        );
        echo static::class . " instantiated";
    }
    public function __toString()
    {
        return "config: ". DATABASE_URL . " " . DATABASE_NAME . " " . DATABASE_USERNAME;
    }

}

//$db = new Database(/*...*/);
//$db -> $pdo -> prepare();
?>