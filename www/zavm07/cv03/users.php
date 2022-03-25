<?php
require './includes/header.php';
require './utils.php';

    $users =getUsers();
    ?>
<main>
    <?php foreach ($users as $user): ?>
        <div class="users">
            <div class="name"><?php echo $user[0] ?></div>
            <div class="gender"><?php echo $user[1] ?></div>
            <div class="email"><?php echo $user[2] ?></div>
            <div class="phone"><?php echo $user[3] ?></div>
            <div class="avatar"><?php echo $user[4] ?></div>
        </div>
    <br>
    <?php endforeach ?>
</main>
<?php require './includes/footer.php';




