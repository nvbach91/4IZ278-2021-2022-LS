<?php require_once __DIR__ . '/Database.php'; ?>

<?php

class DonationsDB extends Database{
    protected $tableName = 'sp_donation';

    public function fetchAll(){
        $statement = $this->pdo->prepare("SELECT * FROM $this->tableName ORDER BY donation_id DESC");
        $statement->execute();
        return $statement->fetchAll();
    }

    public function fetchById($id){
        $statement = $this->pdo->prepare("SELECT * FROM $this->tableName WHERE donation_id = :donation_id LIMIT 1");
        $statement->execute(['donation_id' => $id]);
        return $statement->fetchAll();
    }

    public function fetchByUser($id){
        $statement = $this->pdo->prepare("SELECT * FROM $this->tableName WHERE user_id = :user_id ORDER BY donation_id DESC");
        $statement->execute(['user_id' => $id]);
        return $statement->fetchAll();
    }


    public function updateById($id, $field, $newValue){
        //TODO
    }

    public function create($args){
        $statement = $this->pdo->prepare("INSERT INTO $this->tableName (animal_id, user_id, value, date, description) VALUES (:animal_id, :user_id, :value, :date, :description)");
        $statement->execute([
            'animal_id' => $args['animal_id'],
            'user_id' => $args['user_id'],
            'value' => $args['value'],
            'date' => $args['date'],
            'description' => $args['description']
        ]);
    }

    public function deleteById($id){
        //TODO
    }
} 