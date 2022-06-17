<?php

class ProductsDB extends Database {

    protected $tableName = "products";

    public function countProducts($brand_id) {
        if ($brand_id == 0) $statement = $this->pdo->prepare("SELECT COUNT(id) FROM products");
        else $statement = $this->pdo->prepare("SELECT COUNT(id) FROM products WHERE brand_id = " . $brand_id . ";");
        $statement->execute();
        return $statement->fetchColumn();
    }

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

    public function fetchByBrand($brand_id, $page, $page_limit) {
        $startId = ($page - 1) * $page_limit;
        $sql = "SELECT * FROM " . $this->tableName . ($brand_id == 0 ? "" : " WHERE brand_id = ? ") ." LIMIT ? OFFSET ? ;";
        $statement = $this->pdo->prepare($sql);

        if ($brand_id != 0) {
            $statement->bindValue(1, $brand_id, PDO::PARAM_INT);
            $statement->bindValue(2, $page_limit, PDO::PARAM_INT);
            $statement->bindValue(3, $startId, PDO::PARAM_INT);
        }
        else {
            $statement->bindValue(1, $page_limit, PDO::PARAM_INT);
            $statement->bindValue(2, $startId, PDO::PARAM_INT);
        }
        
        $statement->execute();
        return $statement->fetchAll();
    }

    public function create($args) {
        $sql ="INSERT INTO " . $this->tableName . " (name, description_short, description_long, brand_id, nicotine, pouches, price, image) " . " VALUES (
            :name, 
            :descriptionShort, 
            :descriptionLong, 
            :brandId, 
            :nicotine, 
            :pouches, 
            :price, 
            :image);";
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
