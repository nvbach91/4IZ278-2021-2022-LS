<?php require_once __DIR__ . '/config.php'; ?>
<?php require_once __DIR__ . '/DBConnection.php'; ?>
<?php require_once __DIR__ . '/IEntityDB.php'; ?>

<?php

class VenueDB extends DBConnection implements IEntityDB {

    public function fetchAll(){
        $sql = "SELECT * FROM venue;";
        $statement = $this -> pdo ->prepare($sql);
        $statement->execute();
        return $categories = $statement->fetchAll();
    }

    public function fetchById($venue_id){
        //TODO
    }

    public function updateById($venue_id, $field, $newValue){
        //TODO
    }

    public function create($args){
        //TODO
    }

    public function deleteById($venue_id){
        //TODO
    }
}