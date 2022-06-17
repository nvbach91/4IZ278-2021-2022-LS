<?php

require_once __DIR__ . '/db.php';

class RedisteredToDB extends Database
{
  protected $tableName = 'sem_registred_to';

  public function fetchAll()
  {
    $statement = $this->pdo->prepare("SELECT * FROM $this->tableName");
    $statement->execute();
    return $statement->fetchAll();
  }

  public function fetchById($id)
  {
    $statement = $this->pdo->prepare("SELECT * FROM $this->tableName WHERE user_id = :id");
    $statement->execute(['id' => $id]);
    return $statement->fetchAll();
  }

  public function fetchByAll($user, $event)
  {
    $statement = $this->pdo->prepare("SELECT * FROM $this->tableName WHERE user_id = :user AND event_id = :event LIMIT 1");
    $statement->execute([
      'user' => $user,
      'event' => $event
    ]);
    $result = $statement->fetchAll();
    return isset($result[0]) ? $result[0] : '';
  }

  public function getCount($event)
  {
    $statement = $this->pdo->prepare("SELECT COUNT(user_id) FROM $this->tableName WHERE event_id = :id");
    $statement->execute(['id' => $event]);
    $result = $statement->fetchAll();
    return isset($result[0]) ? $result[0] : '';
  }

  public function insertRow($user, $event)
  {
    $statement = $this->pdo->prepare("INSERT INTO $this->tableName (user_id, event_id) VALUES (:user, :event)");
    $statement->execute([
      'user' => $user,
      'event' => $event
    ]);
  }

  public function deleteRow($user, $event)
  {
    $statement = $this->pdo->prepare("DELETE FROM $this->tableName WHERE user_id = :user AND event_id = :event");
    $statement->execute([
      'user' => $user,
      'event' => $event
    ]);
  }
}
