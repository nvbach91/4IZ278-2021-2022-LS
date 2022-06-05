<?php

require_once __DIR__ . '/db.php';

class EventDB extends Database
{
  protected $tableName = 'sem_event';

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
    $result = $statement->fetchAll();
    return isset($result[0]) ? $result[0] : '';
  }

  public function fetchByOwner($owner)
  {
    $statement = $this->pdo->prepare("SELECT * FROM $this->tableName WHERE owner = :owner AND datetime > now()");
    $statement->execute(['owner' => $owner]);
    return $statement->fetchAll();
  }

  public function fetchByRegistredTo($user)
  {
    $statement = $this->pdo->prepare("SELECT * FROM $this->tableName WHERE id IN (SELECT event_id from sem_registred_to WHERE user_id = :user) AND datetime > NOW()");
    $statement->execute(['user' => $user]);
    return $statement->fetchAll();
  }

  public function fetchUsersWithEvents()
  {
    $statement = $this->pdo->prepare("SELECT email, id FROM sem_user WHERE id IN (SELECT DISTINCT owner FROM sem_event)");
    $statement->execute();
    return $statement->fetchAll();
  }

  public function fetchAllActive()
  {
    $statement = $this->pdo->prepare("SELECT * FROM $this->tableName WHERE datetime > now()");
    $statement->execute();
    return $statement->fetchAll();
  }

  public function fetchAllEnded()
  {
    $statement = $this->pdo->prepare("SELECT * FROM $this->tableName WHERE datetime < now()");
    $statement->execute();
    return $statement->fetchAll();
  }

  public function searchByName($name)
  {
    $statement = $this->pdo->prepare("SELECT * FROM $this->tableName WHERE name LIKE :name AND datetime > now()");
    $statement->execute(['name' => "%$name%"]);
    return $statement->fetchAll();
  }

  public function fetchCount()
  {
    $statement = $this->pdo->query("SELECT COUNT(id) FROM $this->tableName");
    return $statement->fetchColumn();
  }

  public function fetchPagination($limit, $offset)
  {
    $statement = $this->pdo->prepare("SELECT * FROM $this->tableName ORDER BY id ASC LIMIT ? OFFSET ?");
    $statement->bindValue(1, $limit, PDO::PARAM_INT);
    $statement->bindValue(2, $offset, PDO::PARAM_INT);
    $statement->execute();
    return $statement->fetchAll();
  }

  // public function fetchCartProducts($ids)
  // {
  //   $question = str_repeat('?,', count($ids) - 1) . '?';
  //   $statement = $this->pdo->prepare("SELECT * FROM $this->tableName WHERE id IN ($question) ORDER BY name");
  //   $statement->execute(array_values($ids));
  //   return $statement->fetchAll();
  // }

  public function insertRow($name, $datetime, $owner, $img, $description, $capacity, $location, $category)
  {
    $statement = $this->pdo->prepare("INSERT INTO
      $this->tableName (name, datetime, owner, img, description, capacity, location, category)
      VALUES (:name, :datetime, :owner, :img, :description, :capacity, :location, :category)");
    $statement->execute([
      'name' => $name,
      'datetime' => $datetime,
      'owner' => $owner,
      'img' => $img,
      'description' => $description,
      'capacity' => $capacity,
      'location' => $location,
      'category' => $category
    ]);
  }

  public function updateRow($name, $datetime, $owner, $img, $description, $capacity, $location, $category, $id)
  {
    $statement = $this->pdo->prepare("UPDATE $this->tableName
      SET name = :name, datetime = :datetime, owner = :owner, img = :img, description = :description,
        capacity = :capacity, location = :location, category = :category
      WHERE id = :id");
    $statement->execute([
      'name' => $name,
      'datetime' => $datetime,
      'owner' => $owner,
      'img' => $img,
      'description' => $description,
      'capacity' => $capacity,
      'location' => $location,
      'category' => $category,
      'id' => $id
    ]);
  }

  public function deleteRow($id)
  {
    $statement = $this->pdo->prepare("DELETE FROM $this->tableName WHERE id = :id");
    $statement->execute(['id' => $id]);
  }
}
