<?php require_once './DB.php'; ?>
<?php 

class CategoriesDB extends DB {
    protected $tableName = 'cv06_categories';

    public function fetchAll() {
        $statement = $this->pdo->prepare("SELECT * FROM $this->tableName");
        $statement->execute();
        return $statement->fetchAll();
    }
}

?>