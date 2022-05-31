<?php
include("auth_session.php");
include("db.php");
include("../utils/utils.php");

if (!empty($_GET)) {
    $id = $_GET['id'];
    $stmt = $con->prepare('SELECT * FROM articles WHERE id = :id LIMIT 1');
    $stmt->execute([
        'id' => $id
    ]);
    $article = @$stmt->fetchAll()[0];
    $tags = getTags($id, $con, true);
} else {
    header('Location: index.php');
    exit();
}


if (!empty($_POST)) {
    if (isset($_POST['delete'])) {
        deleteArticle($id, $con, $article['image_path']);
        header('Location: index.php');
        return;
    }

    $title = $_POST['title'];
    $desc = $_POST['title-desc'];

    $meta_title = $_POST['meta-title'];
    $meta_title_desc = $_POST['meta-title-desc'];

    $content = $_POST['hello'];

    $author = $_SESSION['username'];
    $date = date("Y-m-d");

    if (strlen($title) <= 60 && strlen($meta_title) <= 60 && strlen($meta_title_desc) <= 160 && strlen($desc) <= 160) {
        if ($_FILES['file']['size'] != 0) {
            $pic = $_FILES['file']['name'];
            $pic_tem_loc = $_FILES['file']['tmp_name'];
            $pic_store = "../pics/clanky/" . $pic;

            move_uploaded_file($pic_tem_loc, $pic_store);

            if (file_exists("../pics/clanky/" . $article['image_path'])) {
                unlink("../pics/clanky/" . $article['image_path']);
            }
        } else {
            $pic = $article['image_path'];
        }


        $statement = $con->prepare("UPDATE articles SET title = :title, description = :description, content = :content, meta_title = :meta_title, meta_description = :meta_description, 
        image_path = :image_path, date = :date WHERE id = :id");
        $statement->execute([
            'title' => $title,
            'description' => $desc,
            'content' => $content,
            'meta_title' => $meta_title,
            'meta_description' => $meta_title_desc,
            'image_path' => $pic,
            'date' => $date,
            'id' => $id
        ]);

        updateTags($id, $con, $_POST['tags']);
        header("Location: index.php");
    } else {
        exit("*Nadpis a Title může obsahovat maximálně 60 znaků a popisek a Description 160!");
    }
}
?>

<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Úprava článku | Blogino</title>
    <meta name="description" content="" />
    <meta name="author" content="Tomáš Zeman" />

    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <script src="../js/font-awesome.js" crossorigin="anonymous"></script>
    <script src="../js/stopScrolling.js" crossorigin="anonymous"></script>
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script src="../js/jquery-3.4.1.js"></script>
    <link rel="stylesheet" href="../css/styles.css" />
    <link rel="stylesheet" href="../css/nav.css" />
    <link rel="stylesheet" href="../css/new_article.css" />
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

            <li><a href="./">Profil</a></li>
        </ul>
    </nav>
    <div class="content">
        <section class="banner">
            <h1>Článek</h1>
            <img src="../pics/kruhy.png" alt="kruhy" />
        </section>

        <section>
            <form id="formArticle" method="post" class="article-form" enctype="multipart/form-data">
                <div class="main-info boxes">
                    <input name="title" type="text" placeholder="Nadpis" value="<?php echo $article['title'] ?>" />
                    <textarea name="title-desc" placeholder="Úvodní popisek"><?php echo $article['description'] ?></textarea>
                    <input name="file" id="file" type="file" class="form-data" />
                    <p>*Nadpis může obsahovat maximálně 60 znaků a popisek 160</p>
                </div>

                <div class="meta-info boxes">
                    <input name="meta-title" type="text" placeholder="Title" value="<?php echo $article['meta_title'] ?>" />
                    <textarea name="meta-title-desc" placeholder="Description"><?php echo $article['meta_description'] ?></textarea>
                    <p>*Title může obsahovat maximálně 60 znaků a Description 160</p>
                </div>
                <div class="editor-cont">
                    <div id="editor" class="editor">
                        <?php echo $article['content'] ?>
                    </div>
                </div>
                <div class="tags">
                    <input type="text" name="tags" placeholder="#tag#tag.." value="<?php echo $tags ?>" />
                    <p>* Jednotlivé kategorie (tagy) oddělujte # a nerozdělujte mezarami</p>
                </div>
                <div style="width: 100%;">
                    <input id="btnUpload" type="submit" name="upload" value="Uložit" />
                    <input type="submit" name="delete" value="Smazat" style="background-color: #AE1414; color: white;" />
                </div>
            </form>
        </section>
    </div>
</body>
<script src="../js/new_article.js" crossorigin="anonymous"></script>

</html>