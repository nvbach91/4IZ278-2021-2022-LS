<?php require_once __DIR__ . '/Database.php'; ?>

<?php

class AnimalsDB extends Database{
    protected $tableName = 'sp_animal';

    public function fetchAll(){
        $statement = $this->pdo->prepare("SELECT * FROM $this->tableName");
        $statement->execute();
        return $statement->fetchAll();
    }

    public function fetchAllWithOffsetAndCategory($numberOfItemsPerPagination, $offset, $categoryChoice){
        if($categoryChoice == 0) {
            $statement = $this->pdo->prepare("SELECT * FROM $this->tableName ORDER BY animal_id DESC LIMIT :numberOfItemsPerPagination OFFSET :offset");
        $statement->execute(['numberOfItemsPerPagination' => $numberOfItemsPerPagination, 'offset' => $offset]);
        return $statement->fetchAll();
        }
        $statement = $this->pdo->prepare("SELECT * FROM $this->tableName WHERE category_id = :categoryChoice ORDER BY animal_id DESC LIMIT :numberOfItemsPerPagination OFFSET :offset");
        $statement->execute(['numberOfItemsPerPagination' => $numberOfItemsPerPagination, 'offset' => $offset, 'categoryChoice' => $categoryChoice]);
        return $statement->fetchAll();
    }

    public function fetchById($id){
        $statement = $this->pdo->prepare("SELECT * FROM $this->tableName WHERE animal_id = :animal_id LIMIT 1");
        $statement->execute(['animal_id' => $id]);
        return $statement->fetchAll();
    }

    public function fetchAllByCategory($categoryChoice){
        
        $statement = $this->pdo->prepare("SELECT * FROM $this->tableName WHERE category_id = :category_id ");
        $statement->execute(['category_id' => $categoryChoice]);
        return $statement->fetchAll();
    }

    public function updateById($id, $field, $newValue){
        //TODO
    }

    public function changeMoney($id, $value){
        $statement = $this->pdo->prepare("UPDATE $this->tableName SET raised_yet = raised_yet + :value WHERE animal_id = :animal_id ");
        $statement->execute(['value' => $value, 'animal_id' => $id]);
    }

    public function changeToBeRaised($id, $value){
        $statement = $this->pdo->prepare("UPDATE $this->tableName SET to_be_raised = :value WHERE animal_id = :animal_id ");
        $statement->execute(['value' => $value, 'animal_id' => $id]);
    }


    public function getLatestRecord(){
        $statement = $this->pdo->prepare("SELECT * FROM $this->tableName ORDER BY animal_id DESC LIMIT 1");
        $statement->execute();
        return $statement->fetchAll();
    }

    public function create($args){
        //TODO
    }

    public function deleteById($id){
        //TODO
    }
} 