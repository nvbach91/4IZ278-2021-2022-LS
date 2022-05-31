<?php
include("./console/db.php");
include("./utils/filter.php");
$itemsPerPage = 5;
if (isset($_GET['offset'])) {
    $offset = $_GET['offset'];
} else {
    $offset = 0;
}
//$offset = 0;
//$count = $con->query("SELECT COUNT(id) FROM articles")->fetchColumn();
$count = getCount("", "", "", "", $con);
$articles = getFilteredArticles("", "", "", "", $con, $itemsPerPage, $offset);

if (!empty($_POST)) {
    $category = $_POST['tags'];
    $author = $_POST['author'];
    $dateStart = $_POST['date_start'];
    $dateEnd = $_POST['date_end'];

    $articles = getFilteredArticles($category, $author, $dateStart, $dateEnd, $con, $itemsPerPage, $offset);
    $count = getCount($category, $author, $dateStart, $dateEnd, $con);
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Články | Blogino</title>
    <meta name="description" content="" />
    <meta name="author" content="Tomáš Zeman" />

    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="format-detection" content="telephone=no" />
    <script src="./js/font-awesome.js" crossorigin="anonymous"></script>
    <script src="./js/stopScrolling.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/styles.css" />
    <link rel="stylesheet" href="./css/nav.css" />
    <link rel="stylesheet" href="./articles/articles.css" />
</head>

<body>
    <nav>
        <input type="checkbox" id="check" />
        <label for="check" class="checkbtn">
            <i class="fas fa-bars"></i>
        </label>
        <ul>
            <li>
                <a href="./">Články</a>
            </li>
            <li><a href="./console/">Profil</a></li>
        </ul>
    </nav>
    <div class="content">
        <section class="banner">
            <h1>Články</h1>
            <img src="../pics/kruhy.png" alt="kruhy" />
        </section>

        <section class="filter">
            <form method="POST">
                <input type="text" name="tags" placeholder="Kategorie" />
                <input type="text" name="author" placeholder="Autor" />
                <input type="text" name="date_start" placeholder="Datum od" />
                <input type="text" name="date_end" placeholder="Datum do" />
                <input type="submit" value="Filtrovat" name="submit" class="submit-button" />
            </form>
        </section>

        <section class="articles">
            <?php if ($count) { ?>
                <div class="articles-list">
                    <?php foreach ($articles as $row) : ?>
                        <article>
                            <img src='./pics/clanky/<?php echo $row['image_path'] ?>' alt='<?php echo $row['title'] ?>' />
                            <h3><?php echo $row['title'] ?></h3>
                            <p><?php echo date("d.m.Y", strtotime($row['date'])); ?></p>
                            <div>
                                <a class="show-article" href='./article/article.php?id=<?php echo $row['id'] ?>'>Zobrazit</a>
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
    <footer>
        <div class="footer">

        </div>
    </footer>
</body>
<script src="./articles/articles.js" crossorigin="anonymous"></script>

</html>