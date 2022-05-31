<?php
include("../console/db.php");
session_start();

if (!empty($_POST)) {
    $statement = $con->prepare("INSERT INTO comments(comment, user_id, article_id, date) VALUES(:comment, :user_id, :article_id, :date)");
    $statement->execute([
        'comment' => $_POST['comment'],
        'user_id' => $_SESSION['user_id'],
        'article_id' => $_POST['article_id'],
        'date' => date("Y-m-d H:i:s")
    ]);
    header("Location: ../article/article.php?id=" . $_POST['article_id']);
}


$tags = "#hello# there";

$tags = str_replace(" ", "", $tags);


$tagsArray = explode("#", $tags);
foreach ($tagsArray as $value) {
    echo $value . "<br>";
}
