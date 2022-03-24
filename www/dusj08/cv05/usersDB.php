<?php require './database.php'; ?>
<?php
class UsersDB extends Database {
    protected $tableName = 'users';

    public function fetchAll() {
        echo "<br>--> All users were fetched"; 
        $statement = $this->pdo->prepare("SELECT * FROM " . $this->tableName);
        $statement->execute();
        return $statement->fetchAll();
    }
    public function fetchById($id) {
        echo "<br>--> User id " . $id . " was fetched"; 
        $statement = $this -> pdo -> prepare("SELECT * FROM " . $this-> tableName . " WHERE user_id = " . $id .";");
        $statement -> execute();
        return $statement;
    }
    public function create($args) {
        $var = '<br>--> User with following specification was created: ' . print_r($args, true);
        echo $var; 
        $statement = $this -> pdo -> prepare("INSERT INTO " . $this-> tableName ." (email, password) ". " VALUES ('".$args['email']."','". $args['password'] ."');");
        $statement -> execute();
    }
    public function deleteById($id) {
        echo "<br>--> User id " . $id . " was deleted"; 
        $statement = $this -> pdo -> prepare("DELETE FROM" . $this-> tableName . "WHERE user_id = " . $id .";");
        $statement -> execute();
    }
    public function updateById($id, $field, $newValue) {
        $statement = $this -> pdo -> prepare("UPDATE" . $this-> tableName . "SET" . $field . "= '" . $newValue . "' WHERE user_id = " . $id .";");
        $statement -> execute();
    }
}
?>