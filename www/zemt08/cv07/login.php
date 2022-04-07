<?php
require __DIR__ . '/db.php';
if (!empty($_POST)) {
    $name = $_POST['name'];

    if (strlen($name) > 3) {
        setcookie('name', $name, time() + 3600);
        header("Location: index.php");
        exit();
    }
    echo 'Name must be longer than 3 characters';
}
?>
<?php include __DIR__ . '/incl/header.php'; ?>
<?php include __DIR__ . '/incl/navbar.php'; ?>
<main class="container" style="height: 80vh;">
    <h1>Login</h1>
    <form method="POST">
        <div class="form-group">
            <input class="form-control" type="text" name="name" placeholder="name">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</main>
<?php include __DIR__ . '/incl/footer.php'; ?>