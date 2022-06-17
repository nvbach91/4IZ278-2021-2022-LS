<?php

class UsersDB extends Database {
    
    protected $tableName = "users";

    public function fetchAll() {
        $sql = "SELECT * FROM " . $this->tableName;
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function fetchById($id) {
        $sql = "SELECT * FROM " . $this->tableName . " WHERE id = :id;";
        $statement = $this->pdo->prepare($sql);
        $statement->execute(["id" => $id]);
        return $statement->fetchAll();
    }

    public function fetchByEmail($email) {
        $sql = "SELECT * FROM " . $this->tableName . " WHERE email = :email;";
        $statement = $this->pdo->prepare($sql);
        $statement->execute([":email" => $email]);
        return $statement->fetchAll();
    }

    public function create($args) {
        $sql = "INSERT INTO " . $this->tableName . " (email, password, role) " . " VALUES (:email, :password, 0);";
        $statement = $this->pdo->prepare($sql);
        $statement->execute($args);
    }

    public function deleteById($id) {
        $sql = "DELETE FROM " . $this->tableName . " WHERE id = :id;";
        $statement = $this->pdo->prepare($sql);
        $statement->execute(["id" => $id]);
    }

    public function updateById($id, $field, $value) {
        $sql = "UPDATE " . $this->tableName . " SET " . $field . " = :value WHERE id = :id;";
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            ":value" => $value,
            ":id" => $id
        ]);
    }
}

?>
