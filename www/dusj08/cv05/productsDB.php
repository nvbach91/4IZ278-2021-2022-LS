<?php require './database.php'; ?>
<?php
class ProductsDB extends Database {
    protected $tableName = 'products';

    public function fetchAll() {
        echo "<br>--> All products were fetched"; 
        $statement = $this->pdo->prepare("SELECT * FROM " . $this->tableName);
        $statement->execute();
        return $statement->fetchAll();
    }
    public function fetchById($id) {
        echo "<br>--> Product with id " . $id . " was fetched"; 
        $statement = $this -> pdo -> prepare("SELECT * FROM " . $this-> tableName . " WHERE product_id = " . $id .";");
        $statement -> execute();
        return $statement;
    }
    public function create($args) {
        $var = '<br>--> Product with following specification was created: ' . print_r($args, true);
        echo $var; 
        $statement = $this -> pdo -> prepare("INSERT INTO " . $this-> tableName ." (name, price) ". " VALUES ('".$args['name']."','". $args['price'] ."');");
        $statement -> execute();
    }
    public function deleteById($id) {
        echo "<br>--> Product with id " . $id . " was deleted"; 
        $statement = $this -> pdo -> prepare("DELETE FROM" . $this-> tableName . "WHERE product_id = " . $id .";");
        $statement -> execute();
    }
    public function updateById($id, $field, $newValue) {
        $statement = $this -> pdo -> prepare("UPDATE" . $this-> tableName . "SET" . $field . "= '" . $newValue . "' WHERE product_id = " . $id .";");
        $statement -> execute();
    }
}
?>