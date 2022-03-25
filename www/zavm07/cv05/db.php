<?php require './Database.php'

?>

<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<?php
$usersDb = new UsersDB();
$users = $usersDb->fetchAll();
?>

<?php foreach ($users as $user): ?>
    <div class="user">
        <?php echo $user['email'] ?>
        <br>
        <?php echo $user['password'] ?>
    </div>
<?php endforeach; ?>
</body>