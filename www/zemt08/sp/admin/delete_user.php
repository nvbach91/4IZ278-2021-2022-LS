<?php
include("../console/db.php");
if (!empty($_POST) && !empty($_GET)) {

    $id = $_GET['id'];

    $statement = $con->prepare("DELETE FROM users WHERE id = :id");
    $statement->execute([
        'id' => $id
    ]);

    $statement = $con->prepare("DELETE FROM articles WHERE author_id = :id");
    $statement->execute([
        'id' => $id
    ]);

    header("Location: ./");
}
