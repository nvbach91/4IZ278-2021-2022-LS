<?php

require_once __DIR__ . '/DB.php';

class ProductsDB extends Database
{
  protected $tableName = 'products';

  public function fetchAll()
  {
    $statement = $this->pdo->prepare("SELECT * FROM $this->tableName");
    $statement->execute();
    return $statement->fetchAll();
  }
}
