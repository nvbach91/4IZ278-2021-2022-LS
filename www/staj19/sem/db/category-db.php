<?php

require_once __DIR__ . '/db.php';

class CategoryDB extends Database
{
  protected $tableName = 'sem_category';

  public function fetchAll()
  {
    $statement = $this->pdo->prepare("SELECT * FROM $this->tableName");
    $statement->execute();
    return $statement->fetchAll();
  }

  public function fetchById($id)
  {
    $statement = $this->pdo->prepare("SELECT * FROM $this->tableName WHERE id = :id LIMIT 1");
    $statement->execute(['id' => $id]);
    $result = $statement->fetchAll();
    return isset($result[0]) ? $result[0] : '';
  }

  public function fetchByName($name)
  {
    $statement = $this->pdo->prepare("SELECT * FROM $this->tableName WHERE name LIKE :name LIMIT 1");
    $statement->execute(['name' => $name]);
    $result = $statement->fetchAll();
    return isset($result[0]) ? $result[0] : '';
  }
}
