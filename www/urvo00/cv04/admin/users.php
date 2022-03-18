<?php include '../header.php' ?>
<?php require '../utils.php' ?>

<main>

    <?php

    $users = getUsers();

    ?>

    <h1>All users</h1>
    <?php foreach ($users as $user) : ?>
        <div class="user">
            <div class="name"><?php echo $user['name']; ?></div>
            <div class="email"><?php echo $user['email']; ?></div>
            <div class="password"><?php echo $user['password']; ?></div>
        </div>
    <?php endforeach ?>
</main>

<?php include '../footer.php'; ?>