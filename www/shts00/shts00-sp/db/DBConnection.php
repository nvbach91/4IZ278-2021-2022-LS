<?php require_once __DIR__ . '/config.php'; ?>

<?php

abstract class DBConnection {

    protected $pdo;

    public function __construct() {
        $connectionString = "mysql:host=" . DATABASE_URL . ";dbname=" . DATABASE_NAME;
        $this -> pdo = new PDO($connectionString, DATABASE_USERNAME, DATABASE_PASSWORD);

        $this -> pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this -> pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    }
}
?>