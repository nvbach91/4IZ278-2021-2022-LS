<?php

require_once __DIR__ . '/Database.php';

class UserTicketDB extends Database
{
  protected $tableName = 'user_ticket';

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
    $statement = $this->pdo->prepare("SELECT * FROM $this->tableName WHERE user_ticket_id = :user_ticket_id LIMIT 1");
    $statement->execute(['user_ticket_id' => $id]);
    return $statement->fetchAll();
  }

  public function insertRow($ticketId, $userId, $code)
  {
    try {
      $this->pdo->beginTransaction();
      $statement = $this->pdo->prepare("INSERT INTO $this->tableName (`ticket_id`, `user_id`, `code`) 
      VALUES (?, ?, ?)");
      if(!$statement->execute([$ticketId, $userId, $code])) throw new Exception('insertRow failed');
      $statement = null;
      $this->pdo->commit();
    } catch (Exception $e) {
      $this->pdo->rollback();
      return false;
    }
    return true;
  }

    /*
  public function fetchAllByUserId($id)
  {
    $statement = $this->pdo->prepare("SELECT user_ticket.user_ticket_id, user_ticket.ticket_id, user_ticket.user_id, user_ticket.code, ticket.event_id FROM $this->tableName INNER JOIN ticket
    ON user_ticket.ticket_id = ticket.ticket_id WHERE user_ticket.user_id = :user_id;");
    $statement->execute(['user_id' => $id]);
    return $statement->fetchAll();
  }
  */

}