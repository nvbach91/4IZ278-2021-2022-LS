<?php
require './config.php';
require './BooksDB.php';

//$conn = mysqli_connect($databaseUrl, $databaseUsername, $databasePassword, $databaseName);

/*
$connectionString = "mysql:host=$DATABASE_URL;dbname=$databaseName";
try { 
    $conn = new PDO($connectionString, $databaseUsername, $databasePassword);
} catch (PDOException $e) {

}

$statement = $conn->prepare("SELECT * FROM books;");
$statement->execute();
$result = $statement->fetchAll();

var_dump($result);
*/
$booksDB = new BooksDB();
$result = $booksDB -> fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cv05</title>
</head>
<body>
    <h1>cv05</h1>
    <h2>Homework</h2>
    <a href="users.php">Users</a><br>
    <a href="products.php">Products</a><br>
    <a href="orders.php">Orders</a><br>
    <h2>Books:</h2>
    <?php foreach($result as $r): ?>
        <div class="book">
            <div><?php echo $r['book_id'];?></div>
            <div><?php echo $r['title'];?></div>
            <div><?php echo $r['price'];?></div>
            <div><?php echo $r['publish_year'];?></div>
        </div>
    <?php endforeach?>
    
</body>
</html>