<?php include __DIR__ . '/incl/header.php'; ?>
<?php include __DIR__ . '/incl/navbar.php'; ?>
<?php
require __DIR__ . '/db.php';
if (!isset($_SESSION['user_email'])) {
    header('Location: login.php');
    exit();
}
$name = $_SESSION['user_email'];
?>
<main class="container" style="height: 80vh;">
    <h1>About me</h1>
    <form method="POST">
        <div class="form-group">
            <input class="form-control" name="name" placeholder="name" value="<?php echo $name; ?>">
        </div>
        <a href="./">Go back to Homepage</a>
    </form>
</main>
<?php include __DIR__ . '/incl/footer.php'; ?>