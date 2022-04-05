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

  public function fetchById($id)
  {
    $statement = $this->pdo->prepare("SELECT * FROM $this->tableName WHERE id = :id");
    $statement->execute(['id' => $id]);
    return $statement->fetchAll();
  }

  public function fetchCount()
  {
    $statement = $this->pdo->query("SELECT COUNT(id) FROM $this->tableName");
    return $statement->fetchColumn();
  }

  public function fetchPagination($pagination, $offset)
  {
    $statement = $this->pdo->prepare("SELECT * FROM $this->tableName ORDER BY id DESC LIMIT $pagination OFFSET ?");
    $statement->bindValue(1, $offset, PDO::PARAM_INT);
    $statement->execute();
    return $statement->fetchAll();
  }

  public function fetchCartProducts($ids)
  {
    $question = str_repeat('?,', count($ids) - 1) . '?';
    $statement = $this->pdo->prepare("SELECT * FROM $this->tableName WHERE id IN ($question) ORDER BY name");
    $statement->execute(array_values($ids));
    return $statement->fetchAll();
  }
}
