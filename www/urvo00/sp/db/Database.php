<?php require __DIR__ . '../conf/config.php' ?>
<?php require __DIR__ . './DatabaseOperations.php';  ?>
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
        $this -> pdo ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this -> pdo ->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    }
    public function __toString()
    {
        return "config: ". DATABASE_URL . " " . DATABASE_NAME . " " . DATABASE_USERNAME;
    }

}
?>