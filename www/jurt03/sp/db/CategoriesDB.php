<?php require_once __DIR__ . '/Database.php'; ?>

<?php

class CategoryDB extends Database{
    protected $tableName = 'sp_category';

    public function fetchAll(){
        $statement = $this->pdo->prepare("SELECT * FROM $this->tableName");
        $statement->execute();
        return $statement->fetchAll();
    }

    public function fetchById($id){
        $statement = $this->pdo->prepare("SELECT * FROM $this->tableName WHERE category_id = :category_id LIMIT 1");
        $statement->execute(['category_id' => $id]);
        return $statement->fetchAll();
    }

    public function updateById($id, $field, $newValue){
        //TODO
    }

    public function create($args){
        //TODO
    }

    public function deleteById($id){
        //TODO
    }
} 