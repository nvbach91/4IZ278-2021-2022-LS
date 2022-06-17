<?php require './UsersDB.php'; ?>
<?php
$usersDB = new UsersDB();
$users = $usersDB->create(['email' => 'test@test.cz', 'password' => 'test']);
$users = $usersDB->create(['email' => 'test1@test.cz', 'password' => 'test']);
$users = $usersDB->create(['email' => 'test2@test.cz', 'password' => 'test']);
//$users = $usersDB->deleteById(4);
//$users = $usersDB->updateById(1, 'password', 'updatedPassw0rd828');
$users = $usersDB->fetchAll();
//$users = $usersDB->fetchById(2);
//$users = $usersDB->deleteById(15);
//$users = $usersDB->updateById(24,'email','ryder@gr-street.us');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php foreach ($users as $user) : ?>
        <div>
            <?php echo $user['email']; ?>
            <br>
            <?php echo $user['password']; ?>
            <br>
        </div>
    <?php endforeach; ?>
</body>

</html>