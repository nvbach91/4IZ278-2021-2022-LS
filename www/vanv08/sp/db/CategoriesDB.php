<?php require_once __DIR__ . '/Database.php'; ?>
<?php

class CategoriesDB extends Database {
    protected $tableName = 'sp_categories';

    public function fetchAll() {
        $statement = $this->pdo->prepare("SELECT * FROM $this->tableName");
        $statement->execute();
        return $statement->fetchAll();
    }

    public function fetchById($id){}
    
    // update/change
    public function updateById($id, $field, $newValue){}
    
    // create new
    public function create($args){}

    // delete existing
    public function deleteById($id){}

    
    public function save($args){

    }
    public function fetch($args){

    }
    public function delete($args){

    }
}


?>