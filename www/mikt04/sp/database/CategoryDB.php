<?php

require_once __DIR__ . '/Database.php';

class CategoryDB extends Database
{
  protected $tableName = 'category';

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
    return $statement->fetchAll();
  }

  public function fetchByName($name)
  {
    $statement = $this->pdo->prepare("SELECT * FROM $this->tableName WHERE name LIKE :name LIMIT 1");
    $statement->execute(['name' => $name]);
    $res = $statement ->fetchAll();
    return isset($res[0]) ? $res[0] : '';
  }
}