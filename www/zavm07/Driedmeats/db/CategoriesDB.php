<?php

class CategoriesDB extends Database{
    private $tableName = 'categories';

    public function fetchAll(){
        $statement = $this->pdo->prepare("SELECT * FROM ".$this->tableName);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function fetchById($id){
        $statement = $this->pdo->prepare("SELECT * FROM ".$this->tableName." WHERE cat_id = :id LIMIT 1");
        $statement->execute(['id'=>$id]);
        return $statement->fetchAll();

    }

}