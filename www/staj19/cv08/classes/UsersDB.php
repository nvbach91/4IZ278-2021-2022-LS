<?php

require_once __DIR__ . '/DB.php';

class UsersDB extends Database
{
  protected $tableName = 'shopUsers';

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
    return $statement->fetchAll()[0];
  }

  public function fetchByEmail($email)
  {
    $statement = $this->pdo->prepare("SELECT * FROM $this->tableName WHERE email like :email LIMIT 1");
    $statement->execute(['email' => $email]);
    return $statement->fetchAll()[0];
  }

  public function insertUser($email, $name, $password)
  {
    $statement = $this->pdo->prepare("INSERT INTO $this->tableName (email, name, password) VALUES (:email, :name, :password)");
    $statement->execute(['email' => $email, 'name' => $name, 'password' => $password]);
  }

  public function updateUser($email, $name, $id)
  {
    $statement = $this->pdo->prepare("UPDATE $this->tableName SET email = :email, name = :name WHERE id = :id");
    $statement->execute([
      'name' => $name,
      'email' => $email,
      'id' => $id
    ]);
  }

  public function updateUserPrivilege($email, $name, $privilege, $id)
  {
    $statement = $this->pdo->prepare("UPDATE $this->tableName SET email = :email, name = :name, privilege = :privilege WHERE id = :id");
    $statement->execute([
      'name' => $name,
      'email' => $email,
      'privilege' => $privilege,
      'id' => $id
    ]);
  }
}
