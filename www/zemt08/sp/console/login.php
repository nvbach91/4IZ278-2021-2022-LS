<!DOCTYPE html>
<html>

<head>
    <link rel="icon" href="../pics/logo_meritum.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <title>Login</title>
    <script src="../js/font-awesome.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/styles.css" />
    <link rel="stylesheet" href="../css/nav.css" />
    <link rel="stylesheet" href="../css/login.css" />
</head>

<body>
    <?php
    require __DIR__ . '/db.php';
    if (!empty($_POST)) {
        session_start();
        $username = $_POST['username'];
        $password = $_POST['password'];

        $stmt = $con->prepare('SELECT * FROM users WHERE username = :username LIMIT 1'); //limit 1 jen jako vykonnostni optimalizace, 2 stejne maily se v db nepotkaji
        $stmt->execute([
            'username' => $username
        ]);
        $existing_user = @$stmt->fetchAll()[0];

        if (password_verify($password, $existing_user['password'])) {
            $_SESSION['username'] = $existing_user['username'];
            $_SESSION['user_id'] = $existing_user['id'];
            header('Location: index.php');
        } else {
            exit('Nesprávné uživatelské jméno nebo heslo.');
        }
    }
    ?>
    <nav>
        <input type="checkbox" id="check" />
        <label for="check" class="checkbtn">
            <i class="fas fa-bars"></i>
        </label>
        <ul>
            <li>
                <a href="../">Úvod</a>
            </li>
        </ul>
    </nav>
    <div class="content">
        <form class="form" method="post" name="login">
            <h1 class="headline">Přihlášení</h1>
            <input type="text" name="username" placeholder="Uživatelské jméno" autofocus="true" />
            <input type="password" name="password" placeholder="Heslo" />
            <input type="submit" value="Přihlásit" name="submit" class="login-button" />
            <a href="https://github.com/login/oauth/authorize?client_id=ad7aed5e4e3b7497802a&">Přihlásit se pomocí Github</a>
            <a href="./register.php">Nemáte založený účet? Vytvořte si ho zde.</a>
        </form>
    </div>
</body>

</html>