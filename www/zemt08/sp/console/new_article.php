<?php
include("auth_session.php");
include("db.php");
include("../utils/utils.php");

if (!empty($_POST)) {
    $title = $_POST['title'];
    $desc = $_POST['title-desc'];
    $pic = $_FILES['file']['name'];
    $pic_tem_loc = $_FILES['file']['tmp_name'];
    $pic_store = "../pics/clanky/" . $pic;

    move_uploaded_file($pic_tem_loc, $pic_store);

    $meta_title = $_POST['meta-title'];
    $meta_title_desc = $_POST['meta-title-desc'];

    $content = $_POST['hello'];

    $author = $_SESSION['user_id'];
    $date = date("Y-m-d H:i:s");

    $statement = $con->prepare("INSERT INTO articles(title, description, content, meta_title, meta_description, image_path, author_id, date) VALUES(:title, :description, :content, :meta_title,
     :meta_description, :image_path, :author_id, :date)");
    $statement->execute([
        'title' => $title,
        'description' => $desc,
        'content' => $content,
        'meta_title' => $meta_title,
        'meta_description' => $meta_title_desc,
        'image_path' => $pic,
        'author_id' => $author,
        'date' => $date,
    ]);

    $id = getAricleId($author, $date, $con);

    $tags = $_POST['tags'];
    $tags = str_replace(" ", "", $tags);
    $tagsArray = explode("#", $tags);
    foreach ($tagsArray as $value) {
        if ($value != "") {
            $statement = $con->prepare("INSERT INTO tags(tag, article_id) VALUES(:tag, :article_id)");
            $statement->execute([
                'tag' => $value,
                'article_id' => $id
            ]);
        }
    }

    header("Location: index.php");
}
?>

<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Nový článek | Fyzioterapie Meritum</title>
    <link rel="icon" href="../pics/logo_meritum.png" />
    <meta name="description" content="V ceníku najdete kompletní výpis našich služeb. Můžete u nás platit v hotovosti i na fakturu." />
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
            <h1>Nový článek</h1>
            <img src="../pics/kruhy.png" alt="kruhy" />
        </section>

        <section>
            <form id="formArticle" method="post" class="article-form" enctype="multipart/form-data">
                <div class="main-info boxes">
                    <input name="title" type="text" placeholder="Nadpis" />
                    <textarea name="title-desc" placeholder="Úvodní popisek"></textarea>
                    <input name="file" id="file" type="file" class="form-data" />
                </div>

                <div class="meta-info boxes">
                    <input name="meta-title" type="text" placeholder="Title" />
                    <textarea name="meta-title-desc" placeholder="Description"></textarea>
                </div>
                <div class="editor-cont">
                    <div id="editor" class="editor">
                        <p>Hello World!</p>
                        <p>Some initial <strong>bold</strong> text</p>
                    </div>
                </div>
                <div class="tags">
                    <input type="text" name="tags" placeholder="#tag#tag.." />
                    <p>* Jednotlivé kategorie (tagy) oddělujte # a nerozdělujte mezarami</p>
                </div>
                <div style="width: 100%;">
                    <input id="btnUpload" type="submit" name="upload" value="Vytvořit" />
                </div>
            </form>
        </section>
    </div>
</body>
<script src="../js/new_article.js" crossorigin="anonymous"></script>

</html>