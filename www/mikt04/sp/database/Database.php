<?php require_once __DIR__ . '/DatabaseOperations.php'; ?>
<?php require_once __DIR__ . '/../config/config.php'; ?>

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
        //echo "Database ready";
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, true);
    }
    public function __toString()
    {
        return DATABASE_NAME . DATABASE_URL;
    }

}
?>