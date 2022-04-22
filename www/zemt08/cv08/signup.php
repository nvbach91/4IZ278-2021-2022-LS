<?php
require __DIR__ . '/db.php';

if (!empty($_POST)) {
    $email = $_POST['email'];
    session_start();
    setcookie('name', $email, time() + 3600);
    $_SESSION['user_email'] = $email;
    $password = $_POST['password'];
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $statement = $db->prepare("INSERT INTO users(email,password, privilege) VALUES(:email, :password, :privilege)");
    $statement->execute([
        'email' => $email,
        'password' => $hashedPassword,
        'privilege' => 1
    ]);
    header("Location: index.php");
}
?>
<?php include __DIR__ . '/incl/header.php'; ?>
<?php include __DIR__ . '/incl/navbar.php'; ?>
<main class="container" style="height: 80vh;">
    <h1>Login</h1>
    <form method="POST">
        <div class="form-group">
            <input class="form-control" type="text" name="email" placeholder="Email">
            <input class="form-control" type="password" name="password" placeholder="Heslo">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</main>
<?php include __DIR__ . '/incl/footer.php'; ?>