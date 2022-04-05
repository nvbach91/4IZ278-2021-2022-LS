<?php

require_once __DIR__ . '/DatabaseOperations.php';
require_once __DIR__ . '/../cred.php';


abstract class Database implements DatabaseOperations
{
  protected $pdo;

  public function __construct()
  {
    $this->pdo = new PDO(
      'mysql:host=' . DATABASE_URL .
        ';dbname=' . DATABASE_NAME . ';charset=utf8mb4',
      DATABASE_USERNAME,
      DATABASE_PASSWORD
    );
    $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
  }
}
