<?php require 'Database.php'; ?>
<?php 

class productsDB extends Database{
    protected $tableName = 'products';
    
    public function fetchAll() {
        $statement = $this->pdo->prepare("SELECT * FROM " . $this->tableName);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function fetchById($id) {
        $statement = $this -> pdo -> prepare("SELECT * FROM " . $this->tableName . " WHERE product_id = " . $id . ";");
        $statement -> execute();
        return $statement;
    }

    public function create($args) {
        $statement = $this -> pdo -> prepare("INSERT INTO " . $this -> tableName . " (name, price, category_id) " . " VALUES (:email, :password, :category_id);");
        $statement -> execute([
            'email' => $args['email'],
            'password' => $args['password'],
            'category_id' => $args['category_id'],
            
        ]);
    }

    public function deleteById($id) {
        $statement = $this -> pdo -> prepare("DELETE FROM " . $this -> tableName . " WHERE product_id = " . $id . ";");
        $statement -> execute();
        echo 'A product was deleted.', PHP_EOL;
    }

    public function updateById($id, $field, $newValue) {
        $statement = $this -> pdo -> prepare("UPDATE " . $this -> tableName . " SET " . $field . "= '" . $newValue . "' WHERE user_ID = " . $id . ";");
        $statement -> execute();
        echo 'A product was updated.', PHP_EOL;
    }
    public function save($args){

    }
    public function fetch($args){

    }
    public function delete($args){

    }
    

}

?>