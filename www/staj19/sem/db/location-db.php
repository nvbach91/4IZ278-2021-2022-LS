<?php

require_once __DIR__ . '/db.php';

class LocationDB extends Database
{
  protected $tableName = 'sem_location';

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

  public function fetchByAll($city, $street, $zip)
  {
    $statement = $this->pdo->prepare("SELECT * FROM $this->tableName
      WHERE city LIKE :city AND street LIKE :street AND zip LIKE :zip LIMIT 1");
    $statement->execute([
      'city' => $city,
      'street' => $street,
      'zip' => $zip
    ]);
    $result = $statement->fetchAll();
    return isset($result[0]) ? $result[0] : '';
  }

  public function insertRow($city, $street, $zip)
  {
    $statement = $this->pdo->prepare("INSERT INTO
      $this->tableName (city, street, zip)
      VALUES (:city, :street, :zip)");
    $statement->execute([
      'city' => $city,
      'street' => $street,
      'zip' => $zip
    ]);
  }

  public function checkAndInsertRow($city, $street, $zip)
  {
    $address = $this->fetchByAll($city, $street, $zip);
    if (!empty($address)) {
      return $address;
    }

    $this->insertRow($city, $street, $zip);
    return $this->fetchByAll($city, $street, $zip);
  }
}
