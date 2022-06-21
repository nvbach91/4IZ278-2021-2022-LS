<?php

require_once __DIR__ . '/db.php';

class UserDB extends DB
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
        $result = $statement->fetchAll();
        return isset($result[0]) ? $result[0] : '';
    }

    public function fetchNameById($id)
    {
        $statement = $this->pdo->prepare("SELECT name FROM $this->tableName WHERE user_id = :user_id LIMIT 1");
        $statement->execute(['user_id' => $id]);
        return $statement->fetchAll();
    }

    public function fetchByEmail($email)
    {
        $statement = $this->pdo->prepare("SELECT * FROM $this->tableName WHERE email like :email LIMIT 1");
        $statement->execute(['email' => $email]);
        $result = $statement->fetchAll();
        return isset($result[0]) ? $result[0] : '';
    }

    public function fetchPassword($email)
    {
        $statement = $this->pdo->prepare("SELECT pwd_hash FROM $this->tableName WHERE email LIKE :email LIMIT 1");
        $statement->execute(['email' => $email]);
        $res = $statement->fetch();
        return isset($res['pwd_hash']) ? $res['pwd_hash'] : '';
    }

    public function insert($name, $surname, $email, $password, $phone)
    {
        $statement = $this->pdo->prepare("INSERT INTO $this->tableName (name, surname, email, password, phone) VALUES (:name, :surname, :email, :password, :phone)");
        $statement->execute(['name' => $name, 'surname' => $surname, 'email' => $email, 'password' => $password, 'phone' => $phone]);
        return $this->fetchByEmail($email);
    }

    public function update($name, $surname, $email, $password, $phone, $id)
    {
        $statement = $this->pdo->prepare("UPDATE $this->tableName SET name = :name, surname = :surname, email = :email, password = :password, phone = :phone WHERE user_id = :user_id");
        $statement->execute([
            'name' => $name,
            'surname' => $surname,
            'email' => $email,
            'password' => $password,
            'phone' => $phone,
            'user_id' => $id
        ]);
    }

    public function delete($id)
    {

        $statement = $this->pdo->prepare("DELETE FROM $this->tableName WHERE user_id = :user_id");
        $statement->execute([
            'user_id' => $id
        ]);
    }
}
