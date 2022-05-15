<?php
include("../console/auth_session.php");
include("../console/db.php");
$userlogin = $_SESSION['username'];
// if ($userlogin != "admin") {
//     header("Location: ../");
// }
if (!empty($_POST)) {
}
//** Načtení údajů o uživateli */
$stmt = $con->prepare('SELECT * FROM users WHERE username = :username LIMIT 1');
$stmt->execute([
    'username' => $userlogin
]);
$user = @$stmt->fetchAll()[0];

$itemsPerPage = 5;
$offset = 0;
if (!empty($_GET)) {
    $offset = $_GET['offset'];
}

$count = $con->query("SELECT COUNT(id) FROM articles")->fetchColumn();

$stmt = $con->prepare("SELECT * FROM articles ORDER BY id DESC LIMIT $itemsPerPage OFFSET ?");
$stmt->bindValue(1, $offset, PDO::PARAM_INT);
$stmt->execute();
$goods = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="icon" href="../pics/logo_meritum.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <title>Admin | Blogino</title>
    <script src="../js/font-awesome.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/styles.css" />
    <link rel="stylesheet" href="../css/nav.css" />
    <link rel="stylesheet" href="../css/profile.css" />
    <link rel="stylesheet" href="../articles/articles.css" />
</head>

<body>
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
        </form>

        <section class="user-articles">
            <h1 class="headline">Moje články:</h1>
            <?php if ($count) { ?>
                <div class="articles-list">
                    <?php foreach ($goods as $row) : ?>
                        <article>
                            <img src='../pics/clanky/<?php echo $row['image_path'] ?>' alt='<?php echo $row['title'] ?>' />
                            <h3><?php echo $row['title'] ?></h3>
                            <p><?php echo date("d.m.Y", strtotime($row['date'])); ?></p>
                            <div>
                                <a class="show-article" href='../article/article.php?id=<?php echo $row['id'] ?>'>Zobrazit</a>
                            </div>
                            <form action="./delete_article.php?id=<?php echo $row['id'] ?>" method="post">
                                <input type="submit" value="Smazat" name="delete" />
                            </form>
                        </article>

                    <?php endforeach; ?>
                </div>
                <br>
                <div class="pagination">
                    <?php for ($i = 1; $i <= ceil($count / $itemsPerPage); $i++) { ?>
                        <a class="<?php echo $offset / $itemsPerPage + 1 == $i ? "active" : ""; ?>" href="./admin.php?offset=<?php echo ($i - 1) * $itemsPerPage; ?>">
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