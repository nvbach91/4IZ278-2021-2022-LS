<?php

require_once __DIR__ . '/DB.php';

class SlidesDB extends Database
{
  protected $tableName = 'slides';

  public function fetchAll()
  {
    $statement = $this->pdo->prepare("SELECT * FROM $this->tableName");
    $statement->execute();
    return $statement->fetchAll();
  }
}
