<?php
require(dirname(__DIR__) . "/utils/utils.php");
if (($users = fetchUsers()) === NULL) {
    die("Users database does not exist");
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
    <style>
        table, th, td {
            border: 1px solid black;
            text-align: center;
        }

        th, td {
            padding: 10px;
        }
    </style>
</head>
<body>
    <table>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Password hash</th>
            <th>Registered</th>
        </tr>
        <?php foreach ($users as $user): ?>
        <tr>
            <td><?php echo $user["name"]; ?></td>
            <td><?php echo $user["email"]; ?></td>
            <td><?php echo $user["passwordHash"]; ?></td>
            <td><?php echo $user["dateRegistered"]; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>