<?php


class OrdersDB extends DB
{
    public function __construct()
    {
        parent::__construct('otoj00/orders');
        $this->query("CREATE TABLE Orders (Number int,Date TIMESTAMP )");
    }

    public function create($args)
    {
        echo 'Order ', $args['number'],' was created', "<br>";
        //It would be good to do some escaping for security reasons
        $number = $args["number"];
        $date = $args["date"];
        $sql = "INSERT INTO Orders (Number,Date) VALUES ('$number','$date')";
        if(mysqli_query($this->connection, $sql)){
            echo "Records were deleted successfully.";
        } else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($this->connection);
        }
    }

    public function fetch(string $number)
    {
        echo 'A order was fetched', "<br>";
        return $this->query("SELECT * FROM Orders WHERE Number='$number'");
    }

    public function save()
    {
        echo 'A order was saved  ', "<br>";
        $this->connection->commit();
    }

    public function delete(string $number)
    {
        $sql = "DELETE FROM Orders WHERE Number = '$number'";
        if(mysqli_query($this->connection, $sql)){
            echo "Records were deleted successfully.";
        } else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($this->connection);
        }
        echo "$number user deleted", "<br>";
    }
}