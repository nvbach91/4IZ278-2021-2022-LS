<?php require_once __DIR__ . '/Database.php'; ?>

<?php

class UsersDB extends Database{
    protected $tableName = 'sp_user';

    public function fetchAll(){
        $statement = $this->pdo->prepare("SELECT * FROM $this->tableName");
        $statement->execute();
        return $statement->fetchAll();
    }

    public function fetchByEmail($email){
        $statement = $this->pdo->prepare("SELECT * FROM $this->tableName WHERE email = :email LIMIT 1");
        $statement->execute(['email' => $email]);
        return $statement->fetchAll();
    }

    public function fetchById($id){
        $statement = $this->pdo->prepare("SELECT * FROM $this->tableName WHERE user_id = :user_id LIMIT 1");
        $statement->execute(['user_id' => $id]);
        return $statement->fetchAll();
    }

    public function updateById($id, $field, $newValue){
        //TODO
    }

    public function create($args){
        $statement = $this->pdo->prepare("INSERT INTO $this->tableName (first_name, last_name, address, city, state, phone, email, password_hash, credit, donated, is_admin) VALUES (:first_name, :last_name, :address, :city, :state, :phone, :email, :password_hash, :credit, :donated, :is_admin)");
        $statement->execute([
            'first_name' => $args['first_name'],
            'last_name' => $args['last_name'],
            'address' => $args['address'],
            'city' => $args['city'],
            'state' => $args['state'],
            'phone' => $args['phone'],
            'email' => $args['email'],
            'password_hash' => $args['password_hash'],
            'credit' => $args['credit'],
            'donated' =>$args['donated'],
            'is_admin' =>$args['is_admin']

        ]);
    }

    public function deleteById($id){
        //TODO
    }

    public function changePassword($args){
        $statement = $this->pdo->prepare("UPDATE $this->tableName SET password_hash = :password_hash WHERE user_id = :user_id");
        $statement->execute(['password_hash' => $args['password_hash'], 'user_id' => $args['user_id']]);
        
    }

    public function minusCreditAndAddToDonated($id, $value){
        $statement = $this->pdo->prepare("UPDATE $this->tableName SET credit = credit - :value WHERE user_id = :user_id");
        $statement->execute(['value' => $value, 'user_id' => $id]);

        $statement = $this->pdo->prepare("UPDATE $this->tableName SET donated = donated + :value WHERE user_id = :user_id");
        $statement->execute(['value' => $value, 'user_id' => $id]);

        
    }
} 

?>