<?php require './UsersDB.php';?>

<?php 
$usersDB = new UsersDB();
$users = $usersDB->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
</head>
<body>
<?php foreach($users as $users): ?>
        <div class="book">
            <div><?php echo $user['email'];?></div>
            <div><?php echo $user['password'];?></div>
        </div>
    <?php endforeach?>
</body>
</html>