<?php

class UsersDB extends DB
{

    public function __construct()
    {
        parent::__construct('otoj00/users');
        $this->query("CREATE TABLE  Users (Name varchar(255),Age int,Email varchar(255) )");
    }

    public function create($args)
    {
        echo 'User ', $args['name'], ' age: ', $args['age'], ' was created', "<br>";
        //It would be good to do some escaping for security reasons
        $name = $args["name"];
        $age = $args["name"];
        $email = @$args["email"];
        $this->query("INSERT INTO Users(Name,Age,Email) VALUES ('$name','$age','$email')");
    }

    public function fetch(string $number)
    {
        echo 'A user was fetched', "<br>";
        return $this->query("SELECT * FROM Users WHERE Email='$number'");
    }

    public function save()
    {
        echo 'A user was saved  ', "<br>";
        $this->connection->commit();
    }

    public function delete(string $number)
    {
        $sql = "DELETE FROM Users WHERE Email = '$number'";
        if(mysqli_query($this->connection, $sql)){
            echo "Records were deleted successfully.";
        } else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($this->connection);
        }
        echo "$number user deleted", "<br>";
    }
}