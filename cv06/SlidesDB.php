<?php require_once './DB.php'; ?>
<?php 

class SlidesDB extends DB {
    protected $tableName = 'cv06_slides';

    public function fetchAll() {
        $statement = $this->pdo->prepare("SELECT * FROM $this->tableName");
        $statement->execute();
        return $statement->fetchAll();
    }
}

?>