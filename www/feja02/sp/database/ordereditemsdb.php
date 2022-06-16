<?php

class OrderItemsDB extends Database {
    
    protected $tableName = "ordered_items";

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

    public function fetchByOrderId($id) {
        $sql = "SELECT * FROM " . $this->tableName . " WHERE order_id = :id;";
        $statement = $this->pdo->prepare($sql);
        $statement->execute(["id" => $id]);
        return $statement->fetchAll();
    }

    public function create($args) {
        $sql = "INSERT INTO " . $this->tableName . " (order_id, product_id, quantity, total) " . " VALUES (
            :order_id,
            :product_id,
            :quantity,
            :total);";
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
