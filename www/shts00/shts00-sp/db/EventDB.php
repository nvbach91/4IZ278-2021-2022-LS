<?php require_once __DIR__ . '/config.php'; ?>
<?php require_once __DIR__ . '/DBConnection.php'; ?>
<?php require_once __DIR__ . '/IEntityDB.php'; ?>

<?php

class EventDB extends DBConnection implements IEntityDB {

    public function fetchAll(){
        $sql = "SELECT * FROM event;";
        $statement = $this -> pdo ->prepare($sql);
        $statement->execute();
        return $events = $statement->fetchAll();
    }

    public function fetchById($id){
        $sql = "SELECT * FROM event WHERE event_id = " . $id .";";
        $statement = $this -> pdo -> prepare($sql);
        $statement->execute();
        return $event = $statement->fetchAll();
    }

    public function fetchMaxId(){
        $sql = "SELECT * from event ORDER BY event_id DESC LIMIT 1";
        $statement = $this -> pdo -> prepare($sql);
        $statement->execute();
        return $event = $statement->fetchAll();
    }

    public function fetchByCategory($category_id){
        $sql = "SELECT * FROM event
                JOIN category_to_event ON event.event_id = category_to_event.event_event_id 
                WHERE category_category_id = " . $category_id .";";
        $statement = $this -> pdo -> prepare($sql);
        $statement->execute();
        return $events = $statement->fetchAll();
    }

    public function fetchByUserId($user_id){
        $sql = "SELECT * FROM event
                JOIN venue ON event.venue_venue_id = venue.venue_id
                JOIN ticket ON event.event_id = ticket.event_event_id
                JOIN order_item ON ticket.order_item_order_item_id = order_item.order_item_id 
                JOIN `order` ON order_item.order_order_id = `order`.order_id
                WHERE user_user_id = " . $user_id .";";
        $statement = $this -> pdo -> prepare($sql);
        $statement->execute();
        return $events = $statement->fetchAll();
    }

    public function fetchTicketByEventId($id){
        $sql = "SELECT * FROM event
                JOIN ticket ON event.event_id = ticket.event_event_id 
                WHERE event_id = " . $id .";";
        $statement = $this -> pdo -> prepare($sql);
        $statement->execute();
        return $event = $statement->fetchAll();
    }


    public function updateById($event_id, $field, $newValue){
        $sql = "UPDATE event SET " . $field . "= '" . $newValue . "' WHERE event_id = " . $event_id .";" ;
        $statement = $this -> pdo -> prepare($sql);
        $statement -> execute();
    }

    public function create($args){
        $sql = 'INSERT INTO 
        event (name, description, date, capacity, organizer_organizer_id, venue_venue_id, open_for_sale) 
        VALUES (:name, :description, :date, :capacity, :organizer_organizer_id, :venue_venue_id, :open_for_sale)';
        $statement = $this->pdo->prepare($sql);
        return $statement->execute([
            'name' => $args['name'],
            'description' => $args['description'],
            'date' => $args['date'],
            'capacity' => $args['capacity'],
            'organizer_organizer_id' => $args['organizer_id'],
            'venue_venue_id' => $args['venue_id'],
            'open_for_sale' => $args['open_for_sale']
        ]);
    }

    public function deleteById($event_id){
        $sql = 'DELETE * FROM event WHERE event_id = :event_id';
        $statement = $this->pdo->prepare($sql);
        $statement->execute(['event_id'=>$event_id]);
    }
}