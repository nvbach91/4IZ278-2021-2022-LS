<?php require_once __DIR__ . '/Database.php'; ?>
<?php

class ProductsDB extends Database
{
    protected $tableName = 'sp_products';

    public function fetchAll()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM $this->tableName");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function fetchById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM " . $this->tableName . " WHERE product_id = :id;");
        $stmt->execute(['id' => $id]);
        return $stmt;
    }

    public function fetchAllPagination($nItemsPerPage, $offset)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM $this->tableName ORDER BY product_id ASC LIMIT :n_items OFFSET :offset");
        $stmt->bindValue(':n_items', $nItemsPerPage, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt;
    }

    public function fetchByIdPagination($id, $nItemsPerPage, $offset)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM $this->tableName WHERE category_id = :id ORDER BY product_id ASC LIMIT :n_items OFFSET :offset");
        $stmt->bindValue(':id', $id, PDO::PARAM_STR);
        $stmt->bindValue(':n_items', $nItemsPerPage, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt;
    }

    // update/change
    public function updateById($id, $field, $newValue)
    {
        $stmt = $this->pdo->prepare("UPDATE " . $this->tableName . " SET $field= ? WHERE product_id = ?;");
        $stmt->bindValue(1, $newValue, PDO::PARAM_STR);
        $stmt->bindValue(2, $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function updateAllbyId($name, $price, $stock, $img, $info, $alcVol, $size, $origin, $catId, $id)
    {
        $stmt = $this->pdo->prepare("UPDATE $this->tableName 
        SET name= :name, 
        price= :price, 
        stock= :stock, 
        img= :img, 
        info= :info, 
        alc_vol= :alc, 
        bottle_size= :size, 
        origin= :origin, 
        date_modified= now(), 
        category_id= :cat
        WHERE product_id = :id;");
        $stmt->execute([
            'name' => $name,
            'price' => $price,
            'stock' => $stock,
            'img' => $img,
            'info' => $info,
            'alc' => $alcVol,
            'size' => $size,
            'origin' => $origin,
            'cat' => $catId,
            'id' => $id,
        ]);
    }

    public function create($args)
    {
    }

    public function deleteById($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM $this->tableName WHERE product_id = ?;");
        $stmt->bindValue(1, $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function getRowsNumber()
    {
        $sql = "SELECT COUNT(*) FROM $this->tableName;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function getRowsNumberById($categoryId)
    {
        $sql = "SELECT COUNT(*) FROM $this->tableName WHERE category_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $categoryId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchColumn();
    }
}

?>