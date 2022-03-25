<?php require './config.php'; ?>
<?php 

$connection = new mysqli(
    $databaseUrl, 
    $databaseUsername, 
    $databasePassword,
    $databaseName
);

// var_dump($connection);

$connection = mysqli_connect(
    $databaseUrl, 
    $databaseUsername, 
    $databasePassword,
    $databaseName
);

// var_dump($connection);
$connectionString = "mysql:host=$databaseUrl;dbname=$databaseName";
try {
    $connection = new PDO(
        $connectionString,
        $databaseUsername,
        $databasePassword
    );
} catch(PDOException $e) {

}


// var_dump($connection);
/*
$statement = $connection->prepare("SELECT * FROM users;");
$statement->execute();
$result = $statement->fetchAll();
*/
// var_dump($result);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Root</title>
</head>
<body>
    <h1>dusj08 - cv05</h1>
    <h3>Pro vypsání dané kategorie z databáze klikněte na její název</h3>
    <ul>
        <li><a href="users.php">Users</a></li>
        <li><a href="products.php">Products</a></li>
        <li><a href="orders.php">Orders</a></li>
    </ul> 
</body>
</html>