<?php require_once '/config.php'; ?>
<?php require '/DatabaseOperations.php'; ?>
<?php

abstract class Database implements DatabaseOperations
{
    protected $pdo;
    public function __construct()
    {
        $connectionString = "mysql:host=" . DATABASE_URL . ";dbname=" . DATABASE_NAME;
        $this->pdo = new PDO(
            $connectionString,
            DATABASE_USERNAME,
            DATABASE_PASSWORD
        );
        echo "----- ", static::class, " was instantiated -----", PHP_EOL;
    }

    public function __toString() {
        return "config: " . "dbURL: " . DATABASE_URL . ", dbName: " . DATABASE_NAME . ", dbUsername: " . DATABASE_USERNAME;
    }
}

?>