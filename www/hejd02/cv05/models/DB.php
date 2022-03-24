<?php require './config/config.php'; ?>
<?php require './interfaces/DatabaseOperations.php'; ?>
<?php

abstract class DB implements DatabaseOperations
{
    protected $pdo;
    protected $dbPath = '/app/db/';
    protected $dbExtension = '.db';
    protected $delimiter = ';';

    public function __construct()
    {

        $connectionString = "mysql:host=" . DB_URL . ";dbname=" . DB_DATABASE;
        $this->pdo = new PDO(
            $connectionString,
            DB_NAME,
            DB_PWD
        );
        echo '-----', static::class, ' was instantiated-----', PHP_EOL;

    }

    public function __toString() {
        return "<br>"."database config: dbPath: $this->dbPath, dbExtenstion: $this->dbExtension, delimiter: $this->delimiter"."<br>";
    }
    public function configInfo() {
        echo $this;
    }

}
?>
