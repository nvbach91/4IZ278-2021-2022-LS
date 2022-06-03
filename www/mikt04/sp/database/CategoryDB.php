<?php

require_once __DIR__ . '/Database.php';

class CategoryDB extends Database
{
  protected $tableName = 'category';

  public function fetchAll()
  {
    $statement = $this->pdo->prepare("SELECT category_id, name FROM $this->tableName");
    $statement->execute();
    return $statement->fetchAll();
  }

  public function fetchName()
  {
    $statement = $this->pdo->prepare("SELECT name FROM $this->tableName");
    $statement->execute();
    $res = $statement->fetchAll();
    return $res;
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

  public function insertRow($name)
  {
    $statement = $this->pdo->prepare("INSERT INTO $this->tableName (name) VALUES (:name)");
    $statement->execute(['name' => $name]);
  }

}