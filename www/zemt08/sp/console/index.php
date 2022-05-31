<!DOCTYPE html>
<html>

<head>
    <link rel="icon" href="../pics/logo_meritum.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <title>Profil | Blogino</title>
    <script src="../js/font-awesome.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/styles.css" />
    <link rel="stylesheet" href="../css/nav.css" />
    <link rel="stylesheet" href="../css/profile.css" />
    <link rel="stylesheet" href="../articles/articles.css" />
</head>

<body>
    <?php
    include("./auth_session.php");
    include("./db.php");
    require('../utils/utils_user.php');
    $userlogin = $_SESSION['username'];
    $user_id = $_SESSION['user_id'];
    if (!empty($_POST)) {
        if (isset($_POST['password-submit'])) {
            $password = $_POST['password'];
            $passwordcheck = $_POST['passwordcheck'];
            if ($password == $passwordcheck && checkPasswordStrength($password)) {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                $statement = $con->prepare("UPDATE users SET password = :password WHERE username = :username");
                $statement->execute([
                    'username' => $userlogin,
                    'password' => $hashedPassword
                ]);
            } else {
                exit("Heslo nesplňuje požadavky.");
            }
        } else {
            $username = $_POST['username'];
            $surname = $_POST['surname'];
            $forename = $_POST['forename'];
            if ($_SESSION['username'] != $_POST['username']) {
                if (!checkUser($username, $con)) {
                    $statement = $con->prepare("UPDATE users SET username = :username, forename = :forename, surname = :surname  WHERE username = :userlogin");
                    $statement->execute([
                        'username' => $username,
                        'forename' => $forename,
                        'surname' => $surname,
                        'userlogin' => $userlogin
                    ]);
                    $_SESSION['username'] = $username;
                } else {
                    exit("Uživatelské jméno je již zabrané");
                }
            } else {
                $statement = $con->prepare("UPDATE users SET forename = :forename, surname = :surname  WHERE username = :userlogin");
                $statement->execute([
                    'forename' => $forename,
                    'surname' => $surname,
                    'userlogin' => $userlogin
                ]);
            }
        }
        $userlogin = $_SESSION['username'];
        $user = getUser($userlogin, $con);
    }
    //** Načtení údajů o uživateli */
    $user = getUser($userlogin, $con);

    $itemsPerPage = 5;
    $offset = 0;
    if (!empty($_GET)) {
        $offset = $_GET['offset'];
    }

    $count = $con->query("SELECT COUNT(id) FROM articles WHERE author_id = '$user_id'")->fetchColumn();

    $stmt = $con->prepare("SELECT * FROM articles WHERE author_id = '$user_id' ORDER BY id DESC LIMIT $itemsPerPage OFFSET ?");
    $stmt->bindValue(1, $offset, PDO::PARAM_INT);
    $stmt->execute();
    $goods = $stmt->fetchAll();
    ?>
    <nav>
        <input type="checkbox" id="check" />
        <label for="check" class="checkbtn">
            <i class="fas fa-bars"></i>
        </label>
        <ul>
            <li>
                <a href="../">Články</a>
            </li>
            <li><a href="./logout.php">Odhlásit</a></li>
        </ul>
    </nav>
    <div class="content">
        <form class="form" method="post">
            <h1 class="headline">Správa uživatelského účtu</h1>
            <?php if (isset($_SESSION['access_token'])) { ?>
                <div class="github_user">
                    <img src="../pics/github.svg" />
                    <h3><?php echo $_SESSION['username']; ?></h3>
                    <p>Pro přihlášení využíváte služby Github</p>
                </div>
            <?php } else { ?>
                <div>
                    <input type="text" name="username" placeholder="Uživatelské jméno" value="<?php echo $_SESSION['username'] ?>" />
                    <input type="text" name="forename" placeholder="Křestní jméno" value="<?php echo $user['forename'] ?>" />
                    <input type="text" name="surname" placeholder="Příjmení" value="<?php echo $user['surname'] ?>" />
                    <input type="submit" value="Uložit" name="submit" class="submit-button" />
                </div>

                <div>
                    <input type="password" name="password" placeholder="Heslo" />
                    <input type="password" name="passwordcheck" placeholder="Heslo znovu" />
                    <input type="submit" value="Změnit heslo" name="password-submit" class="submit-button" />
                </div>
            <?php } ?>
        </form>

        <section class="user-articles">
            <h1 class="headline">Moje články:</h1>
            <button onclick="document.location.href='./new_article.php'">Přidat nový článek</button>
            <?php if ($count) { ?>
                <div class="articles-list">
                    <?php foreach ($goods as $row) : ?>
                        <article>
                            <img src='../pics/clanky/<?php echo $row['image_path'] ?>' alt='<?php echo $row['title'] ?>' />
                            <h3><?php echo $row['title'] ?></h3>
                            <p><?php echo date("d.m.Y", strtotime($row['date'])); ?></p>
                            <div>
                                <a class="show-article" href='./edit_article.php?id=<?php echo $row['id'] ?>'>Zobrazit</a>
                            </div>
                        </article>

                    <?php endforeach; ?>
                </div>
                <br>
                <div class="pagination">
                    <?php for ($i = 1; $i <= ceil($count / $itemsPerPage); $i++) { ?>
                        <a class="<?php echo $offset / $itemsPerPage + 1 == $i ? "active" : ""; ?>" href="./index.php?offset=<?php echo ($i - 1) * $itemsPerPage; ?>">
                            <?php echo $i; ?>
                        </a>
                    <?php } ?>
                </div>
                <br>
            <?php } ?>
        </section>
    </div>
</body>
<script src="../articles/articles.js" crossorigin="anonymous"></script>

</html>