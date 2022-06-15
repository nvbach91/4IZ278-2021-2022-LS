<?php require_once __DIR__ . '/config.php'; ?>
<?php require_once __DIR__ . '/DBConnection.php'; ?>
<?php require_once __DIR__ . '/IEntityDB.php'; ?>

<?php

class UserDB extends DBConnection implements IEntityDB {

    public function fetchAll(){
        $sql = "SELECT * FROM user;";
        $statement = $this -> pdo ->prepare($sql);
        $statement->execute();
        return $users = $statement->fetchAll();
    }

    public function fetchById($user_id){
        $sql = "SELECT * FROM user WHERE user_id = " . $user_id .";";
        $statement = $this -> pdo -> prepare($sql);
        $statement->execute();
        return $ticket = $statement->fetchAll();
    }

    public function fetchByEmail($email){
        $sql = 'SELECT * FROM user WHERE email = :email';
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'email'=>$email
        ]);
        return $statement->fetchAll();
    }

    public function updateById($user_id, $field, $newValue){
        $sql = "UPDATE user SET " . $field . "= '" . $newValue . "' WHERE user_id = " . $user_id .";" ;
        $statement = $this -> pdo -> prepare($sql);
        $statement -> execute();
    }

    public function create($args){
        $sql = 'INSERT INTO user (email, password, privilege) VALUES (:email, :password, :privilege)';
        $statement = $this->pdo->prepare($sql);
        return $statement->execute([
            'email' => $args['email'],
            'password' => $args['hashedPassword'],
            'privilege' => $args['privilege']
        ]);
    }

    public function deleteById($user_id){
        $sql = 'DELETE * FROM user WHERE user_id = :user_id';
        $statement = $this->pdo->prepare($sql);
        $statement->execute(['user_id'=>$user_id]);
    }
}