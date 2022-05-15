<?php require __DIR__ . '/config.php'; ?>
<?php require __DIR__ . '/DatabaseOperations.php'; ?>

<?php

abstract class Database implements DatabaseOperations {
    protected $pdo;
    public function __construct(){
        $this->pdo= new PDO(
            'mysql:host=' . DB_HOST . ';dbname=' . DB_DATABASE . ';charset=utf8mb4',
            DB_USERNAME,
            DB_PASSWORD
        );
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    }
}