<?php require './usersDB.php' ?>

<?php 
$usersDB = new UsersDB();
$users = $usersDB->create(['email' => 'Dave', 'password' => 'test4']);
/*$users = $usersDB->fetchAll(); */
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
    <?php foreach($users as $user): ?>
        <div>
            <?php echo "------------"; ?>
            <br>
            <?php echo "Username / Email: " . $user['email']; ?>
            <br>
            <?php echo "Password: " . $user['password']; ?>
            <br>
        </div>
    <?php endforeach; ?>
</body>
</html>