<?php

require_once __DIR__ . '/db.php';

class FavouritesDB extends DB
{
  protected $tableName = 'favourites';

  public function fetchAll()
  {
    $statement = $this->pdo->prepare("SELECT * FROM $this->tableName");
    $statement->execute();
    return $statement->fetchAll();
  }

  public function fetchById($id)
  {
    $statement = $this->pdo->prepare("SELECT * FROM $this->tableName WHERE favourite_id = :favourite_id LIMIT 1");
    $statement->execute(['favourite_id' => $id]);
    $result = $statement->fetchAll();
    return isset($result[0]) ? $result[0] : '';
  }

  public function fetchByUser($user)
  {
    $statement = $this->pdo->prepare("SELECT * FROM $this->tableName WHERE fk_user_id = :user LIMIT 1");
    $statement->execute(['user' => $user]);
    $result = $statement->fetchAll();
    return isset($result[0]) ? $result[0] : '';
  }

  public function insert($user, $property)
  {
    $statement = $this->pdo->prepare("INSERT INTO $this->tableName (fk_user_id, fk_property_id) VALUES (:fk_user_id, :fk_property_id)");
    $statement->execute([
      'fk_user_id' => $user,
      'fk_property_id' => $property
    ]);
  }

  public function delete($id)
  {
    $statement = $this->pdo->prepare("DELETE FROM $this->tableName WHERE favourite_id = :favourite_id");
    $statement->execute(['favourite_id' => $id]);
  }
}
