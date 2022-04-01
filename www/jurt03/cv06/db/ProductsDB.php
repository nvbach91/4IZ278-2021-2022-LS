<?php require_once __DIR__ . '/Database.php'; ?>
<?php

class ProductsDB extends Database{
    protected $tableName = 'products';
    public function fetchAll(){
        $sql = 'SELECT * FROM ' . $this->tableName;
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        $allResults = $statement->fetchAll();
        return $allResults;
    }
}