<?php
function getFilteredArticles($category, $author, $dateStart, $dateEnd, $con, $itemsPerPage, $offset)
{

    if (isset($_GET['offset'])) {
        $offset = $_GET['offset'];
    }

    $stmt = $con->prepare("SELECT * FROM articles ORDER BY id DESC");
    $stmt->execute();
    $articles = $stmt->fetchAll();


    if ($author != "") {
        $statement = $con->prepare("SELECT id FROM users WHERE username = :author");
        $statement->execute([
            'author' => $author
        ]);

        $result = @$statement->fetchAll();
        $articles_id = array();
        foreach ($result as $el) {
            array_push($articles_id, $el['id']);
        }

        $articles = array_filter($articles, function ($data) use ($articles_id) {
            return (in_array($data['author_id'], $articles_id));
        });
    }

    if ($category != "") {
        $statement = $con->prepare("SELECT article_id FROM tags WHERE tag = :tag");
        $statement->execute([
            'tag' => $category
        ]);

        $result = @$statement->fetchAll();
        $articles_id = array();
        foreach ($result as $el) {
            array_push($articles_id, $el['article_id']);
        }
        $articles = array_filter($articles, function ($data) use ($articles_id) {
            return (in_array($data['id'], $articles_id));
        });
    }

    if ($dateStart != "" || $dateEnd != "") {
        if (strlen($dateStart) !=  10 && $dateStart != "" || strlen($dateEnd) !=  10 && $dateEnd != "") {
            //$error_array = array('id' => '0', 'title' => "Špatně zadáno", 'date' => "", 'image_path' => 'error.png');
            $kk = array();
            //array_push($kk, $error_array);
            return $kk;
        }
        $dateStart = $dateStart != "" ? explode(".", $dateStart) : explode(".", "01.01.1970");
        $dateEnd = $dateEnd != "" ? explode(".", $dateEnd) : explode("-", date("d-m-Y"));

        $startInt = $dateStart[2] . $dateStart[1] . $dateStart[0];
        $endInt = $dateEnd[2] . $dateEnd[1] . $dateEnd[0];

        $startInt = (int) $startInt;
        $endInt = (int) $endInt;

        if ($startInt > $endInt) {
            return array();
        }

        $articles = array_filter($articles, function ($data) use ($startInt, $endInt) {
            return (date("Ymd", strtotime($data['date'])) >= $startInt && date("Ymd", strtotime($data['date'])) <= $endInt);
        });
    }
    $limitedArray = array();
    $limit = (count($articles)) < $offset + $itemsPerPage ? $limit = count($articles) : $offset + $itemsPerPage;

    $counter = 0;
    foreach ($articles as $el) {
        if ($counter < $limit) {
            if ($counter >= $offset) {
                array_push($limitedArray, $el);
            }
        }

        $counter += 1;
    }

    return $limitedArray;
}

function getCount($category, $author, $dateStart, $dateEnd, $con)
{
    $stmt = $con->prepare("SELECT * FROM articles");
    $stmt->execute();
    $articles = $stmt->fetchAll();

    if ($author != "") {
        $statement = $con->prepare("SELECT id FROM users WHERE username = :author");
        $statement->execute([
            'author' => $author
        ]);

        $result = @$statement->fetchAll();
        $articles_id = array();
        foreach ($result as $el) {
            array_push($articles_id, $el['id']);
        }

        $articles = array_filter($articles, function ($data) use ($articles_id) {
            return (in_array($data['author_id'], $articles_id));
        });
    }

    if ($category != "") {
        $statement = $con->prepare("SELECT article_id FROM tags WHERE tag = :tag");
        $statement->execute([
            'tag' => $category
        ]);

        $result = @$statement->fetchAll();
        $articles_id = array();
        foreach ($result as $el) {
            array_push($articles_id, $el['article_id']);
        }

        $articles = array_filter($articles, function ($data) use ($articles_id) {
            return (in_array($data['id'], $articles_id));
        });
    }

    if ($dateStart != "" || $dateEnd != "") {
        if (strlen($dateStart) !=  10 && $dateStart != "" || strlen($dateEnd) !=  10 && $dateEnd != "") {
            //$error_array = array('id' => '0', 'title' => "Špatně zadáno", 'date' => "", 'image_path' => 'error.png');
            $kk = array();
            //array_push($kk, $error_array);
            return $kk;
        }
        $dateStart = $dateStart != "" ? explode(".", $dateStart) : explode(".", "01.01.1970");
        $dateEnd = $dateEnd != "" ? explode(".", $dateEnd) : explode("-", date("d-m-Y"));

        $startInt = $dateStart[2] . $dateStart[1] . $dateStart[0];
        $endInt = $dateEnd[2] . $dateEnd[1] . $dateEnd[0];

        $startInt = (int) $startInt;
        $endInt = (int) $endInt;

        if ($startInt > $endInt) {
            return array();
        }

        $articles = array_filter($articles, function ($data) use ($startInt, $endInt) {
            return (date("Ymd", strtotime($data['date'])) >= $startInt && date("Ymd", strtotime($data['date'])) <= $endInt);
        });
    }

    return count($articles);
}
