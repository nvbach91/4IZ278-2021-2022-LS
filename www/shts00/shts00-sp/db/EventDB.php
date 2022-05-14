<?php require_once __DIR__ . '/config.php'; ?>
<?php require_once __DIR__ . '/DBConnection.php'; ?>
<?php require_once __DIR__ . '/IEntityDB.php'; ?>

<?php

class EventDB extends DBConnection implements IEntityDB {

    public function fetchAll(){
        $sql = "SELECT * FROM event;";
        $statement = $this -> pdo ->prepare($sql);
        $statement->execute();
        return $categories = $statement->fetchAll();
    }

    public function fetchById($event_id){
        $sql = "SELECT * FROM event WHERE event_id = " . $event_id .";";
        $statement = $this -> pdo -> prepare($sql);
        $statement->execute();
    }

    public function updateById($event_id, $field, $newValue){
        $sql = "UPDATE event SET " . $field . "= '" . $newValue . "' WHERE event_id = " . $event_id .";" ;
        $statement = $this -> pdo -> prepare($sql);
        $statement -> execute();
    }

    public function create($args){
        //TODO
        //$sql = "INSERT INTO event (name, description, date, capacity, organizer_organizer_id, venue_venue_id, open_for_sale) 
                //VALUES ('". $args['name'].", ". $args['description'].", );";
        //$statement = $this -> pdo -> prepare($sql);
        //$statement -> execute();
    }

    //TODO: pro eventy nejspis nebude moznost mazat, ale promyslet
    public function deleteById($event_id){
        $sql = "DELETE FROM event WHERE event_id = " . $event_id .";";
        $statement = $this -> pdo -> prepare($sql);
        $statement -> execute();
    }
}