<?php

require_once __DIR__ . '/Database.php';


class EventsDB extends Database
{
  protected $tableName = 'event';

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

  public function fetchNameById($name)
  {
    $statement = $this->pdo->prepare("SELECT event_id FROM $this->tableName WHERE name = :name LIMIT 1");
    $statement->execute(['name' => $name]);
    return $statement->fetch();
  }

  public function fetchById($id)
  {
    $statement = $this->pdo->prepare("SELECT * FROM $this->tableName WHERE event_id = :event_id LIMIT 1");
    $statement->execute(['event_id' => $id]);
    return $statement->fetch();
  }

  public function fetchByCategoryId($id)
  {
    $statement = $this->pdo->prepare("SELECT * FROM $this->tableName WHERE category_id = :category_id");
    $statement->execute(['category_id' => $id]);
    return $statement->fetchAll();
  }

  public function fetchAllPagination($nItemsPerPagination, $offset){
    $statement = $this->pdo->prepare("SELECT * FROM $this->tableName ORDER BY start_date DESC LIMIT $offset, $nItemsPerPagination");
    $statement->execute();
    return $statement->fetchAll();
  }

  public function fetchOrderById($id, $nItemsPerPagination, $offset){
    $statement = $this->pdo->prepare("SELECT * FROM $this->tableName WHERE category_id = :category_id ORDER BY start_date DESC LIMIT $offset, $nItemsPerPagination");
    $statement->execute(['category_id' => $id]);
    $products = $statement->fetchAll();
    return $products;
  }

  public function fetchAllOrderedByDate(){
    $statement = $this->pdo->prepare("SELECT * FROM $this->tableName ORDER BY start_date DESC");
    $statement->execute();
    return $statement->fetchAll();
  }

  public function insertRow($name, $description, $date, $locationName, $locationAdress, $imageLink, $categoryId)
  {
    $statement = $this->pdo->prepare("INSERT INTO $this->tableName (`name`, `description`, `start_date`, `location_name`, `location_adress`, `image_url`, `category_id`) 
    VALUES (?, ?, ?, ?, ?, ?, ?)");
    $statement->execute([$name, $description, $date, $locationName, $locationAdress, $imageLink, $categoryId]);
  }

}

// (`name`, `description`, `start_date`, `location_name`, `location_adress`, `ticket_count`, `image_url`, `category_id`) 