<?php require __DIR__ . '/Database.php'; ?>
<?php

class UsersDB extends Database
{
    protected $tableName = 'sp_users';

    public function fetchAll()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM " . $this->tableName);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function fetchById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM " . $this->tableName . " WHERE user_id = :id;");
        $stmt->execute(['id' => $id]);
        return $stmt;
    }

    public function create($args)
    {
        $stmt = $this->pdo->prepare("INSERT INTO " . $this->tableName . " (email, first_name, last_name, password, privilege) " . " VALUES (:email, :firstName, :lastName, :password, 1);");
        $stmt->execute([
            'email' => $args['email'],
            'firstName' => $args['firstName'],
            'lastName' => $args['lastName'],
            'password' => $args['password'],
        ]);
    }

    public function deleteById($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM " . $this->tableName . " WHERE user_id = " . $id . ";");
        $stmt->execute();
    }

    public function updateById($id, $field, $newValue) {
        $stmt = $this -> pdo -> prepare("UPDATE " . $this -> tableName . " SET " . $field . "= '" . $newValue . "' WHERE user_ID = " . $id . ";");
        $stmt -> execute();
    }
    
    public function fetchByEmail($email)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM $this->tableName WHERE email = :email LIMIT 1");
        $stmt->execute([
            'email' => $email,
        ]);
        
        return $stmt;
    }
}


?>