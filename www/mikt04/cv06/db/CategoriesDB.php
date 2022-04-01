<?php require_once __DIR__ . '/Database.php';

class CategoriesDB extends Database
{
  protected $tableName = 'categories';

  public function fetchAll()
  {
    $statement = $this->pdo->prepare("SELECT * FROM $this->tableName");
    $statement->execute();
    return $statement->fetchAll();
  }
}