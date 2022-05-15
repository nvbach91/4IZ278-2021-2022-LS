<?php

require_once __DIR__ . '/db.php';

class UsersDB extends Database
{
  protected $tableName = 'sem_user';

  public function fetchAll()
  {
    $statement = $this->pdo->prepare("SELECT * FROM $this->tableName");
    $statement->execute();
    return $statement->fetchAll();
  }

  public function fetchById($id)
  {
    $statement = $this->pdo->prepare("SELECT * FROM $this->tableName WHERE id = :id LIMIT 1");
    $statement->execute(['id' => $id]);
    $result = $statement->fetchAll();
    return isset($result[0]) ? $result[0] : '';
  }

  public function fetchByEmail($email)
  {
    $statement = $this->pdo->prepare("SELECT * FROM $this->tableName WHERE email like :email LIMIT 1");
    $statement->execute(['email' => $email]);
    $result = $statement->fetchAll();
    return isset($result[0]) ? $result[0] : '';
  }

  public function insertRow($email, $name, $password)
  {
    $statement = $this->pdo->prepare("INSERT INTO $this->tableName (email, name, password) VALUES (:email, :name, :password)");
    $statement->execute(['email' => $email, 'name' => $name, 'password' => $password]);
  }

  public function updateRow($email, $name, $privilege, $password, $id)
  {
    $statement = $this->pdo->prepare("UPDATE $this->tableName SET email = :email, name = :name, privilege = :privilege, password = :password WHERE id = :id");
    $statement->execute([
      'name' => $name,
      'email' => $email,
      'privilege' => $privilege,
      'password' => $password,
      'id' => $id
    ]);
  }

  public function deleteRow($id)
  {
    $statement = $this->pdo->prepare("DELETE FROM $this->tableName WHERE id = :id");
    $statement->execute([
      'id' => $id
    ]);
  }
}
