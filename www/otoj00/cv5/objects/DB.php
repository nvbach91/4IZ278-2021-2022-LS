<?php

require "db_config.php";
require "IDatabaseOperations.php";

abstract class DB implements IDatabaseOperations
{
    // Protected so child's can access these attributes
    protected $dbPath = 'otoj00';
    protected $dbExtension = '.db';
    protected $delimiter = ',';
    /**
     * @var mysqli
     */
    protected $connection;

    public function __construct($dbPath)
    {
        // static class is not instantiable can be accessed directly
        $this->dbPath = $dbPath;
        echo '-----', static::class, ' was instantiated-----', "<br>";
        $this->connection = new mysqli(
            DB_SERVER_URL,
            DB_USERNAME,
            DB_PASSWORD,
            DB_DATABASE
        );
        if ($this->connection->connect_error) {
            exit("Connection to DB failed: " . $this->connection->connect_error);
        }
    }

    public function __toString()
    {
        return "database config: dbPath: $this->dbPath, dbExtenstion: $this->dbExtension, delimiter: $this->delimiter";
    }

    protected function query($query_string)
    {
        $result = $this->connection->query($query_string);

        if ($result)
            return $result->fetch_assoc();

        return [];
    }

    public function configInfo()
    {
        echo $this;
    }
}