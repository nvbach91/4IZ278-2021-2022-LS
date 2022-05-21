<?php

require_once __DIR__ . '/Database.php';

class TicketDB extends Database
{
  protected $tableName = 'ticket';

  public function fetchAll()
  {
    $statement = $this->pdo->prepare("SELECT `ticket_id`, `event_id`, `price` FROM $this->tableName");
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
    $statement = $this->pdo->prepare("SELECT * FROM $this->tableName WHERE ticket_id = :ticket_id_id LIMIT 1");
    $statement->execute(['event_id' => $id]);
    return $statement->fetchAll();
  }

  public function insertRow($eventId, $price)
  {
    $statement = $this->pdo->prepare("INSERT INTO $this->tableName (`event_id`, `price`) 
    VALUES (?, ?)");
    $statement->execute([$eventId, $price]);
  }

}