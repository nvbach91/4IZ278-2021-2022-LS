<?php require './Database.php'; ?>
<?php
class BooksDB extends Database{
    protected $tableName = 'books';
    public function fetchAll(){
        $statement = $this -> pdo -> prepare("SELECT * FROM " . $this-> tableName .";");
        $statement -> execute();
        return $statement -> fetchAll();
    }
    public function fetchById($id){
        $statement = $this -> pdo -> prepare("SELECT * FROM" . $this-> tableName . "WHERE book_id = " . $id .";");
        $statement -> execute();
    }
    public function updateById($id, $field, $newValue){
        $statement = $this -> pdo -> prepare("UPDATE" . $this-> tableName . "SET" . $field . "= '" . $newValue . "' WHERE book_id = " . $id .";");
        $statement -> execute();
    }
    public function create($args){
        //tbd
    }
    public function deleteById($id){
        $statement = $this -> pdo -> prepare("DELETE FROM" . $this-> tableName . "WHERE book_id = " . $id .";");
        $statement -> execute();
    }
}
$booksDB = new BooksDB();
?> 