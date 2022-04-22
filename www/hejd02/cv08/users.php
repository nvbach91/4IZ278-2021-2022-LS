<?php require __DIR__ . '/db.php' ?>
<?php require __DIR__ . '/requireAdmin.php' ?>
<?php
if (!empty($_POST)) {
    $stmt = $db->prepare("UPDATE users SET privilege = :privilege WHERE id = :id");

    $stmt->execute([
        'privilege' => $_POST["privilege"],
        'id' => $_POST["id"]
    ]);
}

$stmt = $db->prepare("SELECT * FROM users");
$stmt->execute();
$users = $stmt->fetchAll();
    ?>
<?php include __DIR__ . '/includes/header.php'; ?>
<?php include __DIR__ . '/includes/navbar.php'; ?>

<main class="container">
    <h1>Users</h1>
    <?php foreach ($users as $user) : ?>
        <form method="POST">
            <div class="form-group">
                <label for="email">Email</label>
                <input name="email" class="form-control" placeholder="Email" required value="<?php echo $user['email']; ?>">

                <label for="password">Password</label>
                <input name="password" class="form-control" placeholder="Password" required value="<?php echo $user['password']; ?>">

                <label for="privilege">Privilege</label>
                <input name="privilege" type="number" class="form-control" placeholder="Privilege" required value="<?php echo $user['privilege']; ?>">

                <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
            </div>
            <button class="btn btn-primary" type="submit">Submit</button>
        </form>
    <?php endforeach; ?>
    <div style="margin-bottom: 600px"></div>
</main>
<?php include __DIR__ . '/includes/footer.php'; ?>