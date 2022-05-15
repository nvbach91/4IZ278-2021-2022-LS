<?php
include("./console/db.php");

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
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Články | Fyzioterapie Meritum</title>
    <link rel="icon" href="../pics/logo_meritum.png" />
    <meta name="description" content="Přečtěte si o metodách fyzioterapie a novinkách z naší kliniky." />
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

        <section class="articles">
            <?php if ($count) { ?>
                <div class="articles-list">
                    <?php foreach ($goods as $row) : ?>
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
            <section>
                <h3>Otevírací doba</h3>
                <p>Po - Pá:</p>
                <p>8:00 - 17:00</p>
                <p style="font-style: italic">(nebo dle rezervace)</p>
            </section>

            <section>
                <h3>Kontakt</h3>
                <p>+420 728 566 969</p>
                <p>+420 724 220 607</p>
                <p>ordinace@fyziomeritum.cz</p>
            </section>

            <section>
                <h3>Adresa</h3>
                <p>Fyzioterapie Meritum s.r.o.</p>
                <p>28. pluku 575/21</p>
                <p>101 00 Praha 10 - Vršovice</p>
            </section>

            <section>
                <h3>Účetní údaje</h3>
                <p>IČO: 14032066</p>
            </section>
        </div>
    </footer>
</body>
<script src="./articles/articles.js" crossorigin="anonymous"></script>

</html>