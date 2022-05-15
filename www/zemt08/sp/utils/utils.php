<?php
include("../console/db.php");

function getAricleId($userId, $uploadDate, $con)
{
    $stmt = $con->prepare('SELECT * FROM articles WHERE author_id = :id AND date = :date LIMIT 1');
    $stmt->execute([
        'id' => $userId,
        'date' => $uploadDate
    ]);
    $result = @$stmt->fetchAll()[0];
    return $result['id'];
}

function getTags($articleId, $con, $asString)
{
    $stmt = $con->prepare('SELECT * FROM tags WHERE article_id = :id');
    $stmt->execute([
        'id' => $articleId
    ]);
    $result = @$stmt->fetchAll();
    if ($asString) {
        $arrayString = "";
        foreach ($result as $value) {
            $arrayString = $arrayString . "#" . $value['tag'];
        }
        return $arrayString;
    }

    return $result;
}

function getComments($articleId, $con, $deleteAllComments)
{
    $comments = $con->query("SELECT * FROM comments WHERE article_id=" . $articleId . " ORDER BY UNIX_TIMESTAMP(date) DESC")->fetchAll();

    if ($deleteAllComments) {
        foreach ($comments as $value) {
            $statement = $con->prepare("DELETE FROM comments WHERE id = :id");
            $statement->execute([
                'id' => $value['id']
            ]);
        }
    } else {
        return $comments;
    }
}

// Funkce k smazání položek

function deleteTags($articleId, $con)
{
    $stmt = $con->prepare('SELECT * FROM tags WHERE article_id = :id');
    $stmt->execute([
        'id' => $articleId
    ]);
    $result = @$stmt->fetchAll();
    foreach ($result as $value) {
        $statement = $con->prepare("DELETE FROM tags WHERE id = :id");
        $statement->execute([
            'id' => $value['id']
        ]);
    }
}

function deleteRatings($articleId, $con)
{
    $stmt = $con->prepare('SELECT * FROM ratings WHERE article_id = :id');
    $stmt->execute([
        'id' => $articleId
    ]);
    $result = @$stmt->fetchAll();
    foreach ($result as $value) {
        $statement = $con->prepare("DELETE FROM ratings WHERE id = :id");
        $statement->execute([
            'id' => $value['id']
        ]);
    }
}

function deleteArticle($id, $con, $imagePath)
{
    $statement = $con->prepare("DELETE FROM articles WHERE id = :id");
    $statement->execute([
        'id' => $id
    ]);
    if (file_exists("../pics/clanky/" . $imagePath)) {
        unlink("../pics/clanky/" . $imagePath);
    }
    getComments($id, $con, true);
    deleteTags($id, $con);
    deleteRatings($id, $con);
}

// Update článku

function updateTags($articleId, $con, $tags)
{
    $stmt = $con->prepare('SELECT * FROM tags WHERE article_id = :id');
    $stmt->execute([
        'id' => $articleId
    ]);
    $result = @$stmt->fetchAll();
    foreach ($result as $value) {
        $statement = $con->prepare("DELETE FROM tags WHERE id = :id");
        $statement->execute([
            'id' => $value['id']
        ]);
    }

    $tagsString = str_replace(" ", "", $tags);
    $tagsArray = explode("#", $tagsString);
    foreach ($tagsArray as $value) {
        if ($value != "") {
            $statement = $con->prepare("INSERT INTO tags(tag, article_id) VALUES(:tag, :article_id)");
            $statement->execute([
                'tag' => $value,
                'article_id' => $articleId
            ]);
        }
    }
}
