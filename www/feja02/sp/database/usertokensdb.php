<?php

class UserTokensDB extends Database {
    
    protected $tableName = "user_tokens";

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

    public function fetchByUserId($id) {
        $sql = "SELECT * FROM " . $this->tableName . " WHERE user_id = :id and expire > NOW();";
        $statement = $this->pdo->prepare($sql);
        $statement->execute([":id" => $id]);
        return $statement->fetchAll();
    }

    public function fetchByToken($token) {
        $sql = "SELECT * FROM " . $this->tableName . " WHERE token = :token and expire > NOW();";
        $statement = $this->pdo->prepare($sql);
        $statement->execute([":token" => $token]);
        return $statement->fetchAll();
    }

    public function create($args) {
        $sql = "INSERT INTO " . $this->tableName . " (user_id, token, expire) " . " VALUES (:user_id, :token, :expire);";
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
