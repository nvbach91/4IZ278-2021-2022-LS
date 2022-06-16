<?php require_once __DIR__ . '/Database.php'; ?>
<?php

class ProductsDB extends Database
{
    protected $tableName = 'sp_products';

    public function fetchAll()
    {
        $statement = $this->pdo->prepare("SELECT * FROM " . $this->tableName);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function fetchById($id)
    {
        $statement = $this->pdo->prepare("SELECT * FROM " . $this->tableName . " WHERE product_id = :id;");
        $statement->execute(['id' => $id]);
        return $statement;
    }
    public function fetchAllPagination($nItemsPerPage, $offset)
    {
        $statement = $this->pdo->prepare("SELECT * FROM $this->tableName ORDER BY product_id ASC LIMIT :n_items OFFSET :offset");
        $statement->bindValue(':n_items', $nItemsPerPage, PDO::PARAM_INT);
        $statement->bindValue(':offset', $offset, PDO::PARAM_INT);
        $statement->execute();
        return $statement;
        
    }
    public function fetchByIdPagination($id, $nItemsPerPage, $offset)
    {
        $statement = $this->pdo->prepare("SELECT * FROM $this->tableName WHERE category_id = :id ORDER BY product_id ASC LIMIT :n_items OFFSET :offset");
        $statement->bindValue(':id', $id, PDO::PARAM_STR);
        $statement->bindValue(':n_items', $nItemsPerPage, PDO::PARAM_INT);
        $statement->bindValue(':offset', $offset, PDO::PARAM_INT);
        $statement->execute();
        return $statement;
    }

    public function getRowsNumber()
    {
        $sql = "SELECT COUNT(*) FROM $this->tableName;";
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        return $statement->fetchColumn();
    }
    public function getRowsNumberById($categoryId)
    {
        $sql = "SELECT COUNT(*) FROM $this->tableName WHERE category_id = ?";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $categoryId, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchColumn();
    }

    public function create($args)
    {
        $statement = $this->pdo->prepare("INSERT INTO $this->tableName (name, price, product_info, img_link, category_id, user_id) VALUES (:name, :price, :product_info, :img_link, :category_id, :user_id);");
        $statement->execute([
            'name' => $args['name'],
            'price' => $args['price'],
            'product_info' => $args['product_info'],
            'img_link' => $args['img_link'],
            'category_id' => $args['category_id'],
            'user_id' => $args['user_id'],
        ]);
       
    }

    public function deleteById($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM $this->tableName WHERE product_id = ?;");
        $stmt->bindValue(1, $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function updateById($id, $field, $newValue) {
        $statement = $this -> pdo -> prepare("UPDATE " . $this -> tableName . " SET " . $field . "= '" . $newValue . "' WHERE product_id = " . $id . ";");
        $statement -> execute();
    }
    public function save($args){

    }
    public function fetch($args){

    }
    public function delete($args){

    }
}


?>