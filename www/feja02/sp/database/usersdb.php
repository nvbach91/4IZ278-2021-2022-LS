<?php

require_once __DIR__ "./database.php";

class UsersDB implements Database {
    protected $tableName = "users";
    
    public function fetchAll() {
        $statement = $this->pdo->prepare("SELECT * FROM " . $this->tableName);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function fetchById($id) {
        $statement = $this->pdo->prepare("SELECT * FROM " . $this->tableName . " WHERE id = " . $id . ";");
        $statement->execute();
        return $statement->fetch();
    }

    public function create($args) {
        $statement = $this->pdo->prepare("INSERT INTO " . $this->tableName . " (name, email, phone, password, born, country, state, city, postal_code, address, role) " . " VALUES (
            '" . $args['name'] . "',
            '" . $args['email'] . "',
            '" . $args['phone'] . "',
            '" . $args['password'] . "',
            '" . $args['born'] . "',
            '" . $args['country'] . "',
            '" . $args['state'] . "',
            '" . $args['city'] . "',
            '" . $args['postal_code'] . "',
            '" . $args['address'] . "',
            '" . $args['role'] . "',
            '" . date("Y-m-d h:i:s") . "')");
        $statement->execute();
    }

    public function deleteById($id) {
        $statement = $this->pdo->prepare("DELETE * FROM " . $this->tableName . " WHERE id = " . $id . ";");
        $statement->execute();
    }

    public function updateById($id, $field, $value) {
        $statement = $this->pdo->prepare("UPDATE " . $this->tableName . "SET " . $field . " = '" . $value . "' WHERE id = " . $id . ";");
        $statement->execute();
    }
}

?>