<?php

class ProductsDB extends DB
{
    public function __construct()
    {
        parent::__construct('otoj00/products');
        $this->query("CREATE TABLE  Products (Name varchar(255),Price int)");
    }

    public function create($args)
    {
        echo 'Product ', $args['name'], ' was created', "<br>";
        //It would be good to do some escaping for security reasons
        $name = $args["name"];
        $price = $args["price"];
        $sql = "INSERT INTO Products (Name, Price) VALUES ('$name','$price')";
        if(mysqli_query($this->connection, $sql)){
            echo "Records were deleted successfully.";
        } else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($this->connection);
        }
    }

    public function fetch(string $number)
    {
        echo 'A product was fetched', "<br>";
        return $this->query("SELECT * FROM Products WHERE Name='$number'");
    }

    public function save()
    {
        echo 'A product was saved  ', "<br>";
        $this->connection->commit();
    }

    public function delete(string $number)
    {
        $sql = "DELETE FROM Products WHERE Name = '$number'";
        if (mysqli_query($this->connection, $sql)) {
            echo "Records were deleted successfully.";
        } else {
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($this->connection);
        }
        echo "$number user deleted", "<br>";
    }
}