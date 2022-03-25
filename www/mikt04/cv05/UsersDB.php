<?php require './Database.php'; ?>

<?php
class UsersDB extends Database {
    protected $tableName = 'users';


    public function fetchAll()
    {
        $statement = $this->pdo->prepare("SELECT * FROM" . $this->tableName);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function fetchById($id)
    {
        $statement = $this->pdo ->prepare("SELECT * FROM" . $this-> tableName . "WHERE user_id = " . $id .";");
        $statement->execute();
    }

    public function create($args)
    {
        $statement = $this->pdo->prepare("INSERT INTO " . $this-> tableName . " (number, date) " . " VALUES ('" . $args['number'] . "','" . $args['date'] ."');");
        $statement->execute();
    }

    public function deleteById($id)
    {
        $statement = $this->pdo->prepare("DELETE FROM" . $this-> tableName . "WHERE user_id = " . $id .";");
        $statement -> execute();
    }

    public function updateById($id, $field, $newValue)
    {
        $statement = $this->pdo->prepare("UPDATE" . $this-> tableName . "SET" . $field . "= '" . $newValue . "' WHERE user_id = " . $id .";");
        $statement->execute();
    }
    
}
$usersDB = new UsersDB();

?>