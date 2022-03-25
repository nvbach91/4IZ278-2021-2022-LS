<?php require dirname(__DIR__) . '/utils/utils.php' ?>
<?php
$root = '../';
$users = fetchUsers();
?>

<?php include dirname(__DIR__) . '/includes/head.php' ?>
<main>
    <h2>User credentials</h2>
    <table class="user-info">
        <tr>
            <th>Name</th>
            <th>Username</th>
            <th>Password</th>
        </tr>
        <?php foreach ($users as $user) : ?>
            <tr>
                <td class="name"><?php echo $user['name']; ?></td>
                <td class="email"><?php echo $user['email']; ?></td>
                <td class="passwd"><?php echo $user['password']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</main>

<?php include dirname(__DIR__) . '/includes/foot.php' ?>