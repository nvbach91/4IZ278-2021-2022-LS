<?php require_once __DIR__ . '/config.php'; ?>
<?php require_once __DIR__ . '/DBConnection.php'; ?>
<?php require_once __DIR__ . '/IEntityDB.php'; ?>

<?php

class OrganizerDB extends DBConnection implements IEntityDB {

    public function fetchAll(){
        $sql = "SELECT * FROM organizer;";
        $statement = $this -> pdo ->prepare($sql);
        $statement->execute();
        return $categories = $statement->fetchAll();
    }

    public function fetchById($organizer_id){
        //TODO
    }

    public function updateById($organizer_id, $field, $newValue){
        //TODO
    }

    public function create($args){
        //TODO
    }

    public function deleteById($organizer_id){
        //TODO
    }
}