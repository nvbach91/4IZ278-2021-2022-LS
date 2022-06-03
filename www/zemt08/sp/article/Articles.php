<?php
interface ArticlesInterface
{
    public function getUserArticles(string $user_id, int $itemsPerPage, int $offset): array;
    public function getUserArticlesCount(string $user_id, int $itemsPerPage, int $offset): int;
    public function filterArticles(
        string $category,
        string $author,
        string $dateStart,
        string $dateEnd
    ): array;

    public function getFilteredArticlesCount(
        string $category,
        string $author,
        string $dateStart,
        string $dateEnd
    ): int;

    public function getFilteredArticles(
        string $category,
        string $author,
        string $dateStart,
        string $dateEnd,
        int $itemsPerPage,
        int $offset
    ): array;

    public function getArticle(string $id): array;

    public function createArticle(
        $title,
        $desc,
        $pic,
        $pic_tem_loc,
        $pic_store,
        $meta_title,
        $meta_title_desc,
        $content,
        $author,
        $date,
        $tags
    ): bool;
}

// An abstract class may implement only a portion of an interface.
// Classes that extend the abstract class must implement the rest.
abstract class ArticlesAbstract implements ArticlesInterface
{
    public function getUserArticles(string $user_id, int $itemsPerPage, int $offset): array
    {
        include("../console/db.php");
        $stmt = $con->prepare("SELECT * FROM articles WHERE author_id = '$user_id' ORDER BY date DESC LIMIT $itemsPerPage OFFSET ?");
        $stmt->bindValue(1, $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getUserArticlesCount(string $user_id, int $itemsPerPage, int $offset): int
    {
        include("../console/db.php");
        return $con->query("SELECT COUNT(id) FROM articles WHERE author_id = '$user_id'")->fetchColumn();
    }

    public function filterArticlesSQL(string $category, string $author, string $dateStart, string $dateEnd): array
    {
        include("./console/db.php");
        $stmt = $con->prepare("SELECT * FROM articles ORDER BY date DESC");
        $stmt->execute();
        $articles = $stmt->fetchAll();

        $sqlquery = "SELECT * FROM articles WHERE ";
        if ($author != "") {
            $statement = $con->prepare("SELECT id FROM users WHERE username = :author");
            $statement->execute([
                'author' => $author
            ]);
            $result = @$statement->fetchAll()[0];
            $author_id = $result["id"];

            $sqlquery .= "author_id = $result ";
        }

        if ($category != "") {
        }

        if ($dateStart != "" || $dateEnd != "") {
        }
        $stmt = $con->prepare($sqlquery);
        $stmt->execute([
            'id' => $id
        ]);
        $articles = @$stmt->fetchAll()[0];

        return $articles;
    }

    public function filterArticles(string $category, string $author, string $dateStart, string $dateEnd): array
    {
        include("./console/db.php");
        $stmt = $con->prepare("SELECT * FROM articles ORDER BY date DESC");
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
                exit("Datum bylo zadáno ve špatném formátu <br>Datum musí být ve formátu dd.mm.yyyy");
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
        return $articles;
    }

    public function getFilteredArticles($category, $author, $dateStart, $dateEnd, $itemsPerPage, $offset): array
    {
        $articles = $this->filterArticles($category, $author, $dateStart, $dateEnd);
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

    public function getFilteredArticlesCount(string $category, string $author, string $dateStart, string $dateEnd): int
    {
        $count = count($this->filterArticles($category, $author, $dateStart, $dateEnd));
        return $count;
    }

    public function getArticle(string $id): array
    {
        include("../console/db.php");
        $stmt = $con->prepare('SELECT * FROM articles WHERE id = :id LIMIT 1');
        $stmt->execute([
            'id' => $id
        ]);
        return @$stmt->fetchAll()[0];
    }

    public function createArticle($title, $desc, $pic, $pic_tem_loc, $pic_store, $meta_title, $meta_title_desc, $content, $author, $date, $tags): bool
    {
        include("./db.php");
        if (strlen($title) <= 60 && strlen($meta_title) <= 60 && strlen($meta_title_desc) <= 160 && strlen($desc) <= 160) {

            move_uploaded_file($pic_tem_loc, $pic_store);
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
            $stmt = $con->prepare('SELECT * FROM articles WHERE author_id = :id AND date = :date LIMIT 1');
            $stmt->execute([
                'id' => $author,
                'date' => $date
            ]);
            $result = @$stmt->fetchAll()[0];

            $id = $result['id'];
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
        } else {
            return false;
        }
        return true;
    }
}
class Articles extends ArticlesAbstract
{
    public function __construct() // or any other method
    {
    }
}