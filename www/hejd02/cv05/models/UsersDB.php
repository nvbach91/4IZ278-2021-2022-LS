<?php

class UsersDB extends DB
{
    protected $tableName = 'users';

    public function fetchAll()
    {
        echo "<br>--> All users were fetched";
        $statement = $this->pdo->prepare("SELECT * FROM " . $this->tableName);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function fetchById($id)
    {
        echo "<br>--> user no. " . $id . " was fetched";
        $statement = $this->pdo->prepare("SELECT * FROM " . $this->tableName . " WHERE id = " . $id . ";");
        $statement->execute();
        return $statement->fetch();
    }

    public function create($args)
    {
        $var = '<br>--> user with following specification was created: ' . print_r($args, true);
        echo $var;
        $statement = $this->pdo->prepare("INSERT INTO " . $this->tableName . " (first_name, last_name, email, pwd) " . " VALUES (
        '" . $args['first_name'] . "',
        '" . $args['last_name'] . "',
        '" . $args['email'] . "',
        '" . $args['pwd'] . "')");
        $statement->execute();
    }

    public function deleteById($id)
    {
        echo "<br>--> user no. " . $id . " was deleted";
        $statement = $this->pdo->prepare("DELETE FROM " . $this->tableName . " WHERE id = " . $id . ";");
        $statement->execute();
    }

    public function updateById($id, $field, $newValue)
    {
        echo "<br>--> user no. " . $id . " was updated";
        $statement = $this->pdo->prepare("UPDATE " . $this->tableName . " SET " . $field . "= '" . $newValue . "' WHERE id = " . $id . ";");
        $statement->execute();
    }
}

?>
