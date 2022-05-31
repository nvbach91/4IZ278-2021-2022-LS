<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <title>Registrace | Blogino</title>
    <script src="./js/font-awesome.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/styles.css" />
    <link rel="stylesheet" href="../css/nav.css" />
    <link rel="stylesheet" href="../css/login.css" />
</head>

<body>
    <?php
    require('db.php');
    require('../utils/utils_user.php');
    session_start();
    if (!empty($_POST)) {
        $email = $_POST['email'];
        $username = $_POST['username'];
        $surname = $_POST['surname'];
        $forename = $_POST['forename'];
        $password = $_POST['password'];
        $passwordcheck = $_POST['passwordcheck'];

        if (!checkUser($username, $con) && !checkEmail($email, $con)) {
            if ($password == $passwordcheck && checkPasswordStrength($password)) {
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
            } else {
                exit('Heslo nesplňuje požadavky.');
            }
        } else {
            exit('Uživatelské jméno je již zabrané nebo email už by použit.');
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
            <input type="text" name="username" placeholder="Uživatelské jméno" autofocus="true" required />
            <input type="email" name="email" placeholder="Email" required />
            <input type="text" name="forename" placeholder="Křestní jméno" required />
            <input type="text" name="surname" placeholder="Příjmení" required />
            <input type="password" name="password" placeholder="Heslo" required />
            <label>*alespoň jedno velé písmeno a více jak 8 znaků</label>
            <input type="password" name="passwordcheck" placeholder="Heslo znovu" required />
            <input type="submit" value="Registrovat" name="submit" class="login-button" />
            <a href="./login.php">Máte již účet? Přihlašte se zde.</a>
            <a href="https://github.com/login/oauth/authorize?client_id=ad7aed5e4e3b7497802a&">Registrovat se pomocí Github</a>
        </form>
    </div>
</body>

</html>