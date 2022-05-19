<?php require_once __DIR__ . '/Database.php'; ?>
<?php 

class ProductsDB extends Database {
    protected $tableName = 'sp_products';

    public function fetchAll() {
        $stmt = $this->pdo->prepare("SELECT * FROM $this->tableName");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // read one
    public function fetchById($id){
        $stmt = $this->pdo->prepare("SELECT * FROM " . $this->tableName . " WHERE product_id = :id;");
        $stmt->execute(['id' => $id]);
        return $stmt;
    }

    public function fetchAllPagination($nItemsPerPage, $offset){
        $stmt = $this->pdo->prepare("SELECT * FROM $this->tableName ORDER BY product_id ASC LIMIT $nItemsPerPage OFFSET ?");
        $stmt->bindValue(1, $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt;
    }

    public function fetchByIdPagination($id, $nItemsPerPage, $offset){
        $stmt = $this->pdo->prepare("SELECT * FROM $this->tableName WHERE category_id = :id ORDER BY product_id ASC LIMIT :n_items OFFSET :offset");
        $stmt->bindValue(':id', $id, PDO::PARAM_STR);
        $stmt->bindValue(':n_items', $nItemsPerPage, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt;
    }
    
    // update/change
    public function updateById($id, $field, $newValue){
        $stmt = $this->pdo->prepare("UPDATE " . $this -> tableName . " SET " . $field . "= '" . $newValue . "' WHERE product_id = " . $id . ";");
        $stmt->execute();
    }

    // public function updateAllById($name, $price, $stock, $img, $info, $alcVol, $size, $origin, $productId){
    //     $stmt = $this->pdo->prepare("UPDATE $this -> tableName SET name = :name,
    //         price = :price,
    //         stock = :stock,
    //         img = :img,
    //         info = :info,
    //         alc_vol = :vol,
    //         bottle_size = :size,
    //         origin = :origin,
    //         date_modified = now()
    //         WHERE product_id = :id");
    //     $stmt->bindValue(':name', $name, PDO::PARAM_STR);
    //     $stmt->bindValue(':price', $price, PDO::PARAM_STR);
    //     $stmt->bindValue(':stock', $stock, PDO::PARAM_INT);
    //     $stmt->bindValue(':img', $img, PDO::PARAM_STR);
    //     $stmt->bindValue(':info', $info, PDO::PARAM_STR);
    //     $stmt->bindValue(':vol', $alcVol, PDO::PARAM_STR);
    //     $stmt->bindValue(':size', $size, PDO::PARAM_STR);
    //     $stmt->bindValue(':origin', $origin, PDO::PARAM_STR);
    //     $stmt->bindValue(':id', $productId, PDO::PARAM_INT);
    //     $stmt->execute();
    // }
    
    // create new
    public function create($args){}

    // delete existing
    public function deleteById($id){
        $stmt = $this->pdo->prepare("DELETE FROM " . $this->tableName . " WHERE product_id = ?;");
        $stmt->bindValue(1, $id, PDO::PARAM_STR);
        $stmt->execute();
    }

    public function getRowsNumber() {
        $sql = "SELECT COUNT(*) FROM $this->tableName;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function getRowsNumberById($categoryId) {
        $sql = "SELECT COUNT(*) FROM $this->tableName WHERE category_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $categoryId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchColumn();
    }
}

?>