<?php

class OrdersDB extends DB
{
    protected $tableName = 'orders';

    public function fetchAll()
    {
        echo "<br>--> All orders were fetched";
        $statement = $this->pdo->prepare("SELECT * FROM " . $this->tableName);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function fetchById($id)
    {
        echo "<br>--> Order no. " . $id . " was fetched";
        $statement = $this->pdo->prepare("SELECT * FROM " . $this->tableName . " WHERE id = " . $id . ";");
        $statement->execute();
        return $statement;
    }

    public function create($args)
    {
        $var = '<br>--> Order with following specification was created: ' . print_r($args, true);
        echo $var;
        $statement = $this->pdo->prepare("INSERT INTO " . $this->tableName . " (first_name, last_name, products, total) " . " VALUES (
        '" . $args['first_name'] . "',
        '" . $args['last_name'] . "',
        '" . $args['products'] . "',
        '" . $args['total'] . "')");
        $statement->execute();
    }

    public function deleteById($id)
    {
        echo "<br>--> Order no. " . $id . " was deleted";
        $statement = $this->pdo->prepare("DELETE FROM " . $this->tableName . " WHERE id = " . $id . ";");
        $statement->execute();
    }

    public function updateById($id, $field, $newValue)
    {
        echo "<br>--> Order no. " . $id . " was updated";
        $statement = $this->pdo->prepare("UPDATE " . $this->tableName . " SET " . $field . "= '" . $newValue . "' WHERE id = " . $id . ";");
        $statement->execute();
    }
}

?>
