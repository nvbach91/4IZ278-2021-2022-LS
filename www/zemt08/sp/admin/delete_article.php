<?php
include("../console/db.php");
include("../utils/utils.php");
if (!empty($_POST) && !empty($_GET)) {

    $id = $_GET['id'];
    $stmt = $con->prepare('SELECT * FROM articles WHERE id = :id LIMIT 1');
    $stmt->execute([
        'id' => $id
    ]);
    $article = @$stmt->fetchAll()[0];

    deleteArticle($id, $con, $article['image_path']);

    header("Location: ./");
}
