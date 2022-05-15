<?php require __DIR__ . '/Database.php'; ?>

<?php

class AnimalsDB extends Database{
    protected $tableName = 'animals';

    public function fetchAll(){
        $statement = $this->pdo->prepare("SELECT * FROM $this->tableName");
        $statement->execute();
        return $statement->fetchAll();
    }

    public function fetchById($id){
        $statement = $this->pdo->prepare("SELECT * FROM $this->tableName WHERE animal_id = :animal_id LIMIT 1");
        $statement->execute(['animal_id' => $id]);
        return $statement->fetchAll();
    }

    public function updateById($animalId){
        //TODO
    }

    public function create(){
        //TODO
    }

    public function deleteById(){
        //TODO
    }
} 