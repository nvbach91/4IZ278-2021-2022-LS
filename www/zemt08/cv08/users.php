<?php require __DIR__ . '/db.php' ?>
<?php include __DIR__ . '/incl/header.php'; ?>
<?php include __DIR__ . '/incl/navbar.php'; ?>
<?php
if (session_status() !== PHP_SESSION_ACTIVE) session_start();

if (!isset($_SESSION['user_privilege']) || $_SESSION['user_privilege'] != 3) {
    exit();
}

if (!empty($_POST)) {
    $id = $_POST['id'];
    $privilege = $_POST['privilege'];
    $stmt = $db->prepare("UPDATE users SET privilege = :privilege WHERE id = :id");
    $stmt->execute([
        'privilege' => $privilege,
        'id' => $id
    ]);
}

$stmt = $db->prepare("SELECT * FROM users");
$stmt->execute();
$users = $stmt->fetchAll();
?>
<main class="container">
    <h1>Users</h1>
    <?php foreach ($users as $user) : ?>
        <form method="POST" style="margin-top: 30px; border-bottom: solid 1px #eb6864; padding-bottom: 15px;">
            <div class="form-group">
                <label for="email">Email</label>
                <input name="email" class="form-control" placeholder="Email" required value="<?php echo $user['email']; ?>">

                <label for="privilege" style="margin-top: 15px;">Privilege</label>
                <input name="privilege" type="number" class="form-control" placeholder="Privilege" required value="<?php echo $user['privilege']; ?>">

                <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
            </div>
            <button class="btn btn-primary" type="submit">Submit</button>
        </form>
    <?php endforeach; ?>
    <div style="margin-bottom: 600px"></div>
</main>
<?php include __DIR__ . '/incl/footer.php'; ?>