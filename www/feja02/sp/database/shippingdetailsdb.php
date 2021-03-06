<?php

class ShippingDetailsDB extends Database {

    protected $tableName = "shipping_details";

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
        $sql = "SELECT * FROM " . $this->tableName . " WHERE user_id = :id ORDER BY created_at DESC;";
        $statement = $this->pdo->prepare($sql);
        $statement->execute(["id" => $id]);
        return $statement->fetchAll();
    }

    public function fetchLastId() {
        return $this->pdo->lastInsertId();
    }

    public function create($args) {
        $sql = "INSERT INTO " . $this->tableName . " (user_id, first_name, last_name, email, phone, street, city, country, zip_code) " . " VALUES (
            :userId,
            :firstName,
            :lastName,
            :email,
            :phone,
            :street,
            :city,
            :country,
            :zip);";
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
