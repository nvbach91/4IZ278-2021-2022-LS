<?php

class ProductsDB extends DB
{
    protected $tableName = 'products';

    public function fetchAll()
    {
        echo "<br>--> All products were fetched";
        $statement = $this->pdo->prepare("SELECT * FROM " . $this->tableName);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function fetchById($id)
    {
        echo "<br>--> product no. " . $id . " was fetched";
        $statement = $this->pdo->prepare("SELECT * FROM " . $this->tableName . " WHERE id = " . $id . ";");
        $statement->execute();
        return $statement->fetch();
    }

    public function create($args)
    {
        $var = '<br>--> product with following specification was created: ' . print_r($args, true);
        echo $var;
        $statement = $this->pdo->prepare("INSERT INTO " . $this->tableName . " (product_name, product_category, product_price) " . " VALUES (
        '" . $args['product_name'] . "',
        '" . $args['product_category'] . "',
        '" . $args['product_price'] . "')");
        $statement->execute();
    }

    public function deleteById($id)
    {
        echo "<br>--> product no. " . $id . " was deleted";
        $statement = $this->pdo->prepare("DELETE FROM " . $this->tableName . " WHERE id = " . $id . ";");
        $statement->execute();
    }

    public function updateById($id, $field, $newValue)
    {
        echo "<br>--> product no. " . $id . " was updated";
//        var_dump("UPDATE " . $this->tableName . " SET " . $field . "= '" . $newValue . "' WHERE id = " . $id . ";");
        $statement = $this->pdo->prepare("UPDATE " . $this->tableName . " SET " . $field . "= '" . $newValue . "' WHERE id = " . $id . ";");
        $statement->execute();
    }
}

?>
