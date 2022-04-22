<?php
require __DIR__ . '/db.php';
if (!empty($_POST)) {
    session_start();
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $db->prepare('SELECT * FROM users WHERE email = :email LIMIT 1'); //limit 1 jen jako vykonnostni optimalizace, 2 stejne maily se v db nepotkaji
    $stmt->execute([
        'email' => $email
    ]);
    $existing_user = @$stmt->fetchAll()[0];

    if (password_verify($password, $existing_user['password'])) {
        $_SESSION['user_email'] = $existing_user['email'];
        $_SESSION['user_privilege'] = $existing_user['privilege'];
        header('Location: index.php');
    } else {
        exit('Invalid user or password!');
    }
}
?>
<?php include __DIR__ . '/incl/header.php'; ?>
<?php include __DIR__ . '/incl/navbar.php'; ?>
<main class="container" style="height: 80vh;">
    <h1>Login</h1>
    <form method="POST">
        <div class="form-group">
            <input class="form-control" type="text" name="email" placeholder="Email">
            <input class="form-control" type="password" name="password" placeholder="Password" style="margin-top: 15px;">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button><a href="signup.php">Don't have an account yet? Sign up!</a>
    </form>
</main>
<?php include __DIR__ . '/incl/footer.php'; ?>