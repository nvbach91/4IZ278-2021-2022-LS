<?php

require_once __DIR__ . '/Database.php';

class UsersDB extends Database
{
  protected $tableName = 'user';

  public function fetchAll()
  {
    $statement = $this->pdo->prepare("SELECT * FROM $this->tableName");
    $statement->execute();
    return $statement->fetchAll();
  }

  public function fetchById($id)
  {
    $statement = $this->pdo->prepare("SELECT * FROM $this->tableName WHERE user_id = :user_id LIMIT 1");
    $statement->execute(['user_id' => $id]);
    return $statement->fetch();
  }

  public function fetchByName($name)
  {
    $statement = $this->pdo->prepare("SELECT * FROM $this->tableName WHERE name LIKE :name LIMIT 1");
    $statement->execute(['name' => $name]);
    $res = $statement ->fetchAll();
    return isset($res[0]) ? $res[0] : '';
  }

  public function fetchByEmail($email)
  {
    $statement = $this->pdo->prepare("SELECT * FROM $this->tableName WHERE email = :email LIMIT 1");
    $statement->execute(['email' => $email]);
    return $statement->fetch();
  }

  public function fetchPassword($email)
  {
    $statement = $this->pdo->prepare("SELECT pwd_hash FROM $this->tableName WHERE email LIKE :email LIMIT 1");
    $statement->execute(['email' => $email]);
    $res = $statement ->fetch();
    return isset($res['pwd_hash']) ? $res['pwd_hash'] : '';
  }

  public function validateEmail($email)
  {
    $statement = $this->pdo->prepare("SELECT * FROM $this->tableName WHERE email like :email LIMIT 1");
    $statement->execute(['email' => $email]);
    $existingUser = $statement->fetchAll(0);
    if ($existingUser) {
        return TRUE;
    }
    return FALSE;
  }

  public function insertRow($name)
  {
    //$statement = $this->pdo->prepare("INSERT INTO $this->tableName (name) VALUES (:name)");
    //$statement->execute(['name' => $name]);
  }

  public function insertUser($firstName, $lastName, $email, $password, $date, $privilege)
  {
    $statement = $this->pdo->prepare("INSERT INTO $this->tableName (first_name, last_name, email, pwd_hash, created, privilege) 
    VALUES (?, ?, ?, ?, ?, ?)");
    $statement->execute([$firstName, $lastName, $email, $password, $date, $privilege]);
  }
  
    /*
  public function insertUser($firstName, $lastName, $email, $password)
  {
    $rnd = '2018-12-05 12:39:16';
    $statement = $this->pdo->prepare("INSERT INTO $this->tableName (first_name, last_name, email, pwd_hash, created) 
    VALUES (:first_name, :last-name, :email, :pwd_hash, :created)");
    $statement->execute(['first-name' => $firstName, 'last-name' => $lastName, 'email' => $email, 'pwd_hash' => $password, 'created' => $rnd]);
  }
  */
  



}