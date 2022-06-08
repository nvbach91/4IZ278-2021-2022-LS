<?php require __DIR__ . '/db/UsersDB.php'; ?>
<?php
if (session_status() !== PHP_SESSION_ACTIVE) session_start();
if (!empty($_POST)) {
    $valid = TRUE;
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo ('Invalid email');
        $valid = FALSE;
    }
    if (strlen($password) < 3) {
        echo ('Password must be at least 3 characters long');
        $valid = FALSE;
    }
    $usersDB = new UsersDB();
    $existingUser = $usersDB -> fetchByEmail($email);
    if ($existingUser) {
        echo ('This email is already in use.');
        $valid = FALSE;
    }
    if($valid){
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $usersDB -> create(['email' => $email, 'password' => $hashedPassword, 'privilege' => 1]);

    header('Location: login.php');
    exit();
    }
}
?>

<?php include __DIR__ . '/incl/head.php'; ?>
<?php include __DIR__ . '/incl/navbar.php'; ?>
<main class="container">
    <h1>Sign up</h1>
    <form action="" method="POST">
        <div class="form-group">
            <label for="name">Email</label>
            <input class="form-control" name="email" placeholder="email">
            <label for="name">Password</label>
            <input class="form-control" name="password" placeholder="password">
        </div>
        <button class="btn btn-primary">Submit</button>
    </form>
    <div style="margin-bottom: 600px"></div>
</main>

<?php include __DIR__ . '/incl/foot.php'; ?>