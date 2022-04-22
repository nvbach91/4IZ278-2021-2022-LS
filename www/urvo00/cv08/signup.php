<?php require __DIR__ . '/db.php'; ?>
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

    $stmt = $db->prepare("SELECT * FROM users_shop WHERE email like :email LIMIT 1");
    $stmt->execute(['email' => $email]);
    $existingUser = $stmt->fetchAll()[0];
    if ($existingUser) {
        echo ('This email is already in use.');
        $valid = FALSE;
    }
    if($valid){
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $statement = $db->prepare("INSERT INTO users_shop (email, password, privilege) VALUES (:email, :password, 1)");
    $statement->execute(['email' => $email, 'password' => $hashedPassword,]);

    header('Location: login.php');
    exit();
    }
}
?>

<?php include __DIR__ . '/incl/header.php'; ?>
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

<?php include __DIR__ . '/incl/footer.php'; ?>