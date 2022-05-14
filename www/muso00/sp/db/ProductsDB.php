<?php require_once __DIR__ . '/Database.php'; ?>
<?php 

class ProductsDB extends Database {
    protected $tableName = 'sp_products';

    public function fetchAll() {
        $statement = $this->pdo->prepare("SELECT * FROM $this->tableName");
        $statement->execute();
        return $statement->fetchAll();
    }

    // read one
    public function fetchById($id){
        $stmt = $this->pdo->prepare("SELECT * FROM " . $this->tableName . " WHERE product_id = :id;");
        $stmt->execute(['id' => $id]);
        return $stmt;
    }

    public function fetchByCatId($catId){
        $stmt = $this->pdo->prepare("SELECT * FROM " . $this->tableName . " WHERE category_id = :id;");
        $stmt->execute(['id' => $catId]);
        return $stmt;
    }
    
    // update/change
    public function updateById($id, $field, $newValue){}
    
    // create new
    public function create($args){}

    // delete existing
    public function deleteById($id){}
}

?>