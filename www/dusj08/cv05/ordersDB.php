<?php require './database.php'; ?>
<?php
class OrdersDB extends Database {
    protected $tableName = 'orders';

    public function fetchAll() {
        echo "<br>--> All orders were fetched"; 
        $statement = $this->pdo->prepare("SELECT * FROM " . $this->tableName);
        $statement->execute();
        return $statement->fetchAll();
    }
    public function fetchById($id) {
        echo "<br>--> Order no. " . $id . " was fetched"; 
        $statement = $this -> pdo -> prepare("SELECT * FROM " . $this-> tableName . " WHERE order_id = " . $id .";");
        $statement -> execute();
        return $statement;
    }
    public function create($args) {
        $var = '<br>--> Order with following specification was created: ' . print_r($args, true);
        echo $var;         
        $statement = $this -> pdo -> prepare("INSERT INTO " . $this-> tableName ." (customer_name, sum_products, total) ". " VALUES ('".$args['customer_name']."','". $args['sum_products']." ','". $args['total'] ."');");
        $statement -> execute();
    }
    public function deleteById($id) {
        echo "<br>--> Order no. " . $id . " was deleted"; 
        $statement = $this -> pdo -> prepare("DELETE FROM" . $this-> tableName . "WHERE order_id = " . $id .";");
        $statement -> execute();
    }
    public function updateById($id, $field, $newValue) {
        echo "<br>--> Order no. " . $id . " was updated"; 
        $statement = $this -> pdo -> prepare("UPDATE" . $this-> tableName . "SET" . $field . "= '" . $newValue . "' WHERE order_id = " . $id .";");
        $statement -> execute();
    }
}
?>