<?php require_once __DIR__ . '/Database.php'; ?>
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
        $stmt = $this->pdo->prepare("SELECT * FROM $this->tableName WHERE user_id = :id;");
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
        $stmt = $this->pdo->prepare("DELETE FROM $this->tableName WHERE user_id = ?");
        $stmt->bindValue(1, $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function updateById($field, $newValue, $id)
    {
        $stmt = $this->pdo->prepare("UPDATE $this->tableName SET $field= ?
        WHERE user_id = ?;");
        $stmt->bindValue(1, $newValue, PDO::PARAM_STR);
        $stmt->bindValue(2, $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function updateAllbyId($firstName, $lastName, $phone, $street, $city, $postCode, $id)
    {
        $stmt = $this->pdo->prepare("UPDATE $this->tableName 
        SET first_name= :first_name, last_name= :last_name, phone= :phone, street= :street, city= :city, postal_code= :post_code
        WHERE user_id = :user_id;");
        $stmt->bindValue(':first_name', $firstName, PDO::PARAM_STR);
        $stmt->bindValue(':last_name', $lastName, PDO::PARAM_STR);
        $stmt->bindValue(':phone', $phone, PDO::PARAM_STR);
        $stmt->bindValue(':street', $street, PDO::PARAM_STR);
        $stmt->bindValue(':city', $city, PDO::PARAM_STR);
        $stmt->bindValue(':post_code', $postCode, PDO::PARAM_STR);
        $stmt->bindValue(':user_id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }


    public function fetchByEmail($email)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM $this->tableName WHERE email = ? LIMIT 1");
        $stmt->bindValue(1, $email, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt;
    }
}

?>