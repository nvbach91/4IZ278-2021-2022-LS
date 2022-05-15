<!DOCTYPE html>
<html>

<head>
    <link rel="icon" href="../pics/logo_meritum.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <title>Register</title>
    <script src="./js/font-awesome.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/styles.css" />
    <link rel="stylesheet" href="../css/nav.css" />
    <link rel="stylesheet" href="../css/login.css" />
</head>

<body>
    <?php
    require('db.php');
    session_start();
    if (!empty($_POST)) {
        $email = $_POST['email'];
        $username = $_POST['username'];
        $surname = $_POST['surname'];
        $forename = $_POST['forename'];
        $password = $_POST['password'];
        $passwordcheck = $_POST['passwordcheck'];

        if ($password == $passwordcheck) {
            $_SESSION['username'] = $username;

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $statement = $con->prepare("INSERT INTO users(username,email,password, forename, surname) VALUES(:username, :email, :password, :forename, :surname)");
            $statement->execute([
                'username' => $username,
                'email' => $email,
                'password' => $hashedPassword,
                'forename' => $forename,
                'surname' => $surname,
            ]);
            header("Location: index.php");
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

            <li><a href="../contact/">CRM</a></li>
        </ul>
    </nav>
    <div class="content">
        <form class="form" method="post" name="login">
            <h1 class="headline">Přihlášení</h1>
            <input type="text" name="username" placeholder="Uživatelské jméno" autofocus="true" />
            <input type="text" name="email" placeholder="Email" />
            <input type="text" name="forename" placeholder="Křestní jméno" />
            <input type="text" name="surname" placeholder="Příjmení" />
            <input type="password" name="password" placeholder="Heslo" />
            <input type="password" name="passwordcheck" placeholder="Heslo znovu" />
            <input type="submit" value="Registrovat" name="submit" class="login-button" />
            <a href="./login.php">Máte již účet? Přihlašte se zde.</a>
        </form>
    </div>
</body>

</html>