<?php require_once __DIR__ . '/config.php'; ?>
<?php require_once __DIR__ . '/DBConnection.php'; ?>
<?php require_once __DIR__ . '/IEntityDB.php'; ?>

<?php

class VenueDB extends DBConnection implements IEntityDB {

    public function fetchAll(){
        $sql = "SELECT * FROM venue;";
        $statement = $this -> pdo ->prepare($sql);
        $statement->execute();
        return $venues = $statement->fetchAll();
    }

    public function fetchById($venue_id){
        $sql = "SELECT * FROM venue WHERE venue_id = " . $venue_id .";";
        $statement = $this -> pdo -> prepare($sql);
        $statement->execute();
        return $venue = $statement->fetchAll();
    }

    public function fetchByEventId($id){
        $sql = "SELECT venue.name, venue.address, venue.city FROM venue
                JOIN event ON venue.venue_id = event.venue_venue_id 
                WHERE event_id = " . $id .";";
        $statement = $this -> pdo -> prepare($sql);
        $statement->execute();
        return $event = $statement->fetchAll();
    }

    public function updateById($venue_id, $field, $newValue){
        $sql = "UPDATE venue SET " . $field . "= '" . $newValue . "' WHERE venue_id = " . $venue_id .";" ;
        $statement = $this -> pdo -> prepare($sql);
        $statement -> execute();
    }

    public function create($args){
        $sql = 'INSERT INTO venue (name, address, city, max_capacity) VALUES (:name, :address, :city, :max_capacity)';
        $statement = $this->pdo->prepare($sql);
        return $statement->execute([
            'name' => $args['name'],
            'address' => $args['address'],
            'city' => $args['city'],
            'max_capacity' => $args['max_capacity'],
        ]);

    }

    public function deleteById($venue_id){
        $sql = 'DELETE * FROM venue WHERE venue_id = :venue_id';
        $statement = $this->pdo->prepare($sql);
        $statement->execute(['venue_id'=>$venue_id]);
    }
}