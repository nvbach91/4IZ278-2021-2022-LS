<?php
include("../console/db.php");
include("../utils/utils.php");
include("../article/Articles.php");
session_start();
if (!empty($_GET)) {
    $id = $_GET['id'];
    $data = new Articles();
    $article = $data->getArticle($id);
    $author = getAuthor($article['author_id'], $con);
} else {
    header('Location: index.php');
    exit();
}

if (!empty($_POST)) {
    if (!isset($_SESSION["username"])) {
        header("Location: ../console/");
        exit();
    }

    if (isset($_POST['like'])) {
        $rating = 1;
    } else {
        $rating = 0;
    }

    $stmt = $con->prepare('SELECT rating FROM ratings WHERE user_id=:user_id AND article_id=:article_id');
    $stmt->execute([
        'user_id' => $_SESSION['user_id'],
        'article_id' => $article['id']
    ]);
    $existingRating = @$stmt->fetchAll()[0];

    if (isset($existingRating)) {
        $statement = $con->prepare("UPDATE ratings SET rating = :rating  WHERE user_id = :user_id");
        $statement->execute([
            'rating' => $rating,
            'user_id' => $_SESSION['user_id']
        ]);
    } else {
        $statement = $con->prepare("INSERT INTO ratings(rating, user_id, article_id) VALUES(:rating, :user_id, :article_id)");
        $statement->execute([
            'rating' => $rating,
            'user_id' => $_SESSION['user_id'],
            'article_id' => $article['id']
        ]);
    }
}

$ratings = getRatings($article['id'], $con);
$bilance = 0;
foreach ($ratings as $row) {
    if ($row['rating'] == 0) {
        $bilance -= 1;
    } else {
        $bilance += 1;
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title><?php echo $article['meta_title'] ?> | Fyzioterapie Meritum</title>
    <link rel="icon" href="../pics/logo_meritum.png" />
    <meta name="description" content="<?php echo $article['meta_description'] ?>" />
    <meta name="author" content="Tomáš Zeman" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="format-detection" content="telephone=no" />
    <script src="../js/font-awesome.js" crossorigin="anonymous"></script>
    <script src="../js/stopScrolling.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/styles.css" />
    <link rel="stylesheet" href="../css/nav.css" />
    <link rel="stylesheet" href="./article.css" />
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
            <li><a href="../console/">Profil</a></li>
        </ul>
    </nav>
    <div class="content">
        <section class="article">
            <div style="border-bottom: solid 1px #e5e5e5">
                <h1 class="headline"><?php echo $article['title'] ?></h1>
                <h3>
                    <?php echo $article['description'] ?>
                </h3>
                <p><?php echo date("d.m.Y", strtotime($article['date'])) . "<br> Autor: " . $author['username']; ?></p>
                <img src="../pics/clanky/<?php echo $article['image_path'] ?>" />
                <?php echo $article['content'] ?>
            </div>
        </section>
        <form class="thumbs" method="post">
            <input type="submit" name="like" value="Like" />
            <label><?php echo $bilance; ?></label>
            <input type="submit" name="dislike" value="Dislike" />
        </form>

        <form class="add-comment" method="post" action="../console/add_comment.php">
            <p>Přidat komentář:</p>
            <textarea name="comment" placeholder="Napište svůj komentář"></textarea>
            <input type="submit" value="Přidat" name="addcomment" />
            <input type="hidden" name="article_id" value="<?= $id; ?>" />
        </form>
        <section class="comments">
            <?php
            $comments = getComments($id, $con, false);

            $commentsCount = count($comments);
            ?>

            <?php if ($commentsCount) { ?>
            <ul>
                <?php foreach ($comments as $row) : ?>
                <li class="comment">
                    <p>
                        <?php
                                $username = $con->query("SELECT username FROM users WHERE id=" . $row['user_id'])->fetchColumn();
                                echo $username;
                                ?>
                    </p>
                    <p>
                        <?php
                                echo date("d.m.Y", strtotime($row['date'])) . " ";

                                echo substr($row['date'], 11);
                                ?>
                    </p>
                    <p><?php echo $row['comment'] ?></p>
                </li>
                <?php endforeach; ?>
            </ul>
            <?php } ?>
        </section>
    </div>
    <footer>
        <div class="footer">

        </div>
    </footer>
</body>

</html>