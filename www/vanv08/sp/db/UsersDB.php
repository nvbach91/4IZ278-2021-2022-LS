<?php require_once __DIR__ . '/Database.php'; ?>
<?php 

class UsersDB extends Database{
    protected $tableName = 'sp_users';
    
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
    public function fetchByEmail($email)
    {
        $statement = $this->pdo->prepare("SELECT * FROM $this->tableName WHERE email = ? LIMIT 1");
        $statement->bindValue(1, $email, PDO::PARAM_STR);
        $statement->execute();
        return $statement;
    }  
    public function fetchEmailById($id){
        $statement = $this -> pdo -> prepare("SELECT email FROM " . $this->tableName . "WHERE user_id = " . $id . ";");
        $statement -> execute();
        return $statement;
    }

    public function create($args) {
        $statement = $this -> pdo -> prepare("INSERT INTO " . $this -> tableName . " (email, password, level) " . " VALUES (:email, :password, 1 );");
        $statement -> execute([
            'email' => $args['email'],
            'password' => $args['password'],
        ]);
    }

    public function deleteById($id) {
        $statement = $this -> pdo -> prepare("DELETE FROM " . $this -> tableName . " WHERE user_id = " . $id . ";");
        $statement -> execute();
        
    }

    public function updateById($id, $field, $newValue) {
        $statement = $this -> pdo -> prepare("UPDATE " . $this -> tableName . " SET " . $field . "= '" . $newValue . "' WHERE user_ID = " . $id . ";");
        $statement -> execute();
        echo 'A user was updated.', PHP_EOL;
    }
    public function updateAllbyId($first_name, $last_name, $phone, $street, $city, $postal, $id)
    {
        $statement = $this->pdo->prepare("UPDATE $this->tableName 
        SET first_name= :first_name, last_name= :last_name, phone= :phone, street= :street, city= :city, postal= :postal
        WHERE user_id = :user_id;");
        $statement->bindValue(':first_name', $first_name, PDO::PARAM_STR);
        $statement->bindValue(':last_name', $last_name, PDO::PARAM_STR);
        $statement->bindValue(':phone', $phone, PDO::PARAM_STR);
        $statement->bindValue(':street', $street, PDO::PARAM_STR);
        $statement->bindValue(':city', $city, PDO::PARAM_STR);
        $statement->bindValue(':postal', $postal, PDO::PARAM_STR);
        $statement->bindValue(':user_id', $id, PDO::PARAM_INT);
        $statement->execute();
    }
    public function save($args){

    }
    public function fetch($args){

    }
    public function delete($args){

    }
    

}

?>