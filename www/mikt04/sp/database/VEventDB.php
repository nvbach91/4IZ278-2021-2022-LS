<?php

require_once __DIR__ . '/Database.php';

class VEventDB extends Database
{
  protected $tableName = 'v_event';

  public function fetchAll()
  {
    $statement = $this->pdo->prepare("SELECT * FROM $this->tableName");
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
    $statement = $this->pdo->prepare("SELECT * FROM $this->tableName WHERE v_event_id = :v_event_id LIMIT 1");
    $statement->execute(['v_event_id' => $id]);
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