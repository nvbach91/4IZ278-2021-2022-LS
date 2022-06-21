<?php

require_once __DIR__ . '/db.php';

class CategoryDB extends DB
{
  protected $tableName = 'categories';

  public function fetchAll()
  {
    $statement = $this->pdo->prepare("SELECT * FROM $this->tableName");
    $statement->execute();
    return $statement->fetchAll();
  }

  public function fetchById($id)
  {
    $statement = $this->pdo->prepare("SELECT * FROM $this->tableName WHERE category_id = :category_id LIMIT 1");
    $statement->execute(['category_id' => $id]);
    $result = $statement->fetchAll();
    return isset($result[0]) ? $result[0] : '';
  }

  public function fetchByName($name)
  {
    $statement = $this->pdo->prepare("SELECT * FROM $this->tableName WHERE category_name LIKE :category_name LIMIT 1");
    $statement->execute(['category_name' => $name]);
    $result = $statement->fetchAll();
    return isset($result[0]) ? $result[0] : '';
  }

}
