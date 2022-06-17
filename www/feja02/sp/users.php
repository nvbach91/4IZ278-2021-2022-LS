<?php

include "include/header.php";
require "database/usersdb.php";
require "functions/adminCheck.php";

$usersDb = new UsersDB();
$users = $usersDb->fetchAll();
?>

<h1 class="text-center text-black mt-5">Users</h1>
<div class="d-flex w-50 mx-auto text-black flex-column flex-wrap mt-4 mb-5">
    <table class="table table-striped table-product">
        <thead>
            <tr class="align-middle">
                <th>ID</th>
                <th>EMAIL</th>
                <th>ROLE</th>
                <th>JOINED</th>
                <th>ORDERS</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
            <tr class="align-middle">
                <td><?php echo $user["id"]; ?></td>
                <td><?php echo $user["email"]; ?></td>
                <td><?php echo $user["role"]; ?></td>
                <td><?php echo $user["created_at"] ?></td>
                <th><a class="btn" href="./orders?userId=<?php echo $user["id"]; ?>"><img src="./resources/order24.png" alt="orders"></a></th>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include "include/footer.php"; ?>
