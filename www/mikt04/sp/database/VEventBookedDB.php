<?php

require_once __DIR__ . '/Database.php';

class VEventBookedDB extends Database
{
  protected $tableName = 'v_event_booked';

  public function fetchAll()
  {
    $statement = $this->pdo->prepare("SELECT * FROM $this->tableName");
    $statement->execute();
    return $statement->fetchAll();
  }

  public function fetchAllOrderByDate()
  {
    $statement = $this->pdo->prepare("SELECT * FROM $this->tableName ORDER BY start_date DESC");
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

  public function fetchByEventId($id)
  {
    $statement = $this->pdo->prepare("SELECT * FROM $this->tableName WHERE event_id = :event_id LIMIT 1");
    $statement->execute(['event_id' => $id]);
    return $statement->fetch();
  }


  public function fetchByName($name)
  {
    $statement = $this->pdo->prepare("SELECT * FROM $this->tableName WHERE name LIKE :name LIMIT 1");
    $statement->execute(['name' => $name]);
    $res = $statement ->fetchAll();
    return isset($res[0]) ? $res[0] : '';
  }

}