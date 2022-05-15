<?php require 'Database.php'; ?>
<?php 

class UsersDB extends Database{
    protected $tableName = 'users';
    
    public function fetchAll() {
        $statement = $this->pdo->prepare("SELECT * FROM " . $this->tableName);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function fetchById($id) {
        $statement = $this -> pdo -> prepare("SELECT * FROM " . $this->tableName . " WHERE user_id = " . $id . ";");
        $statement -> execute();
        return $statement;
    }
    public function fetchByEmail($email) {
        $statement = $this -> pdo -> prepare("SELECT email FROM " . $this->tableName . " WHERE email = " . $email . ";");
        $statement -> execute();
        
        if($statement->rowCount()>0){
            return $statement->fetchAll()[0];
          }
          else{
            return null;
          }
    }   

    public function create($args) {
        $statement = $this -> pdo -> prepare("INSERT INTO " . $this -> tableName . " (email, password) " . " VALUES (:email, :password);");
        $statement -> execute([
            'email' => $args['email'],
            'password' => $args['password'],
        ]);
    }

    public function deleteById($id) {
        $statement = $this -> pdo -> prepare("DELETE FROM " . $this -> tableName . " WHERE user_id = " . $id . ";");
        $statement -> execute();
        echo 'A user was deleted.', PHP_EOL;
    }

    public function updateById($id, $field, $newValue) {
        $statement = $this -> pdo -> prepare("UPDATE " . $this -> tableName . " SET " . $field . "= '" . $newValue . "' WHERE user_ID = " . $id . ";");
        $statement -> execute();
        echo 'A user was updated.', PHP_EOL;
    }
    public function save($args){

    }
    public function fetch($args){

    }
    public function delete($args){

    }
    

}

?>