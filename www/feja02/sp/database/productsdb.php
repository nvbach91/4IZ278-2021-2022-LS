<?php

require_once __DIR__ "./database.php";

class ProductsDB implements Database {
    protected $tableName = "products";
    
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
        $statement = $this->pdo->prepare("INSERT INTO " . $this->tableName . " (name, description_short, description_long, brand_id, nicotine, pouches, price, image) " . " VALUES (
            '" . $args['name'] . "',
            '" . $args['description_short'] . "',
            '" . $args['description_long'] . "',
            '" . $args['brand_id'] . "',
            '" . $args['nicotine'] . "',
            '" . $args['pouches'] . "',
            '" . $args['price'] . "',
            '" . $args['image'] . "',
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