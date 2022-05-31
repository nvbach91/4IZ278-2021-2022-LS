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

    $stmt = $con->prepare('SELECT email FROM users WHERE id = :id LIMIT 1');
    $stmt->execute([
        'id' => $article['author_id']
    ]);
    $user = @$stmt->fetchAll()[0];

    $to = $user['email'];
    echo $to;
    $subject = "Smazání článku";

    $message = "<h1>Váš článek by smazán administrátorem!</h1>";
    $message .= "<p>Článek porušoval zásady stránky.</p>";

    $header = "From:info@blogino.cz \r\n";
    $header .= "MIME-Version: 1.0\r\n";
    $header .= "Content-type: text/html\r\n";

    $retval = mail($to, $subject, $message, $header);

    if ($retval == true) {
        echo "Message sent successfully...";
    } else {
        echo "Message could not be sent...";
    }
    header("Location: ./");
}
