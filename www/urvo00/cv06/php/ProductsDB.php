<?php require_once  __DIR__ . '/Database.php'; ?>
<?php
class ProductsDB extends Database{
    protected $tableName = 'products_hw';
    public function fetchAll(){
        $statement = $this -> pdo -> prepare("SELECT * FROM " . $this-> tableName .";");
        $statement -> execute();
        return $statement -> fetchAll();
    }
    public function fetchById($id){
        $statement = $this -> pdo -> prepare("SELECT * FROM" . $this-> tableName . "WHERE product_id = " . $id .";");
        $statement -> execute();
    }
    public function updateById($id, $field, $newValue){
        $statement = $this -> pdo -> prepare("UPDATE" . $this-> tableName . "SET" . $field . "= '" . $newValue . "' WHERE product_id = " . $id .";");
        $statement -> execute();
    }
    public function create($args){
        $statement = $this -> pdo -> prepare("INSERT INTO " . $this-> tableName ." (name, price) ". " VALUES ('".$args['name']."','". $args['price'] ."');");
        $statement -> execute();
    }
    public function deleteById($id){
        $statement = $this -> pdo -> prepare("DELETE FROM" . $this-> tableName . "WHERE product_id = " . $id .";");
        $statement -> execute();
    }
}
?>