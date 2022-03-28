<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
</head>
<body>
    
<?php 
require './UsersDB.php';
$users = new UsersDB();
$users->create(['id' => 1, 'name' => 'Tomas', 'age' => 80, 'city' => 'Prague']);
$users->fetch(1);
$users->delete(1);
?>

</body>
</html>