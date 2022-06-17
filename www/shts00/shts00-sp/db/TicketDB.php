<?php require_once __DIR__ . '/config.php'; ?>
<?php require_once __DIR__ . '/DBConnection.php'; ?>
<?php require_once __DIR__ . '/IEntityDB.php'; ?>

<?php

class TicketDB extends DBConnection implements IEntityDB {

    public function fetchAll(){
        $sql = "SELECT * FROM ticket;";
        $statement = $this -> pdo ->prepare($sql);
        $statement->execute();
        return $categories = $statement->fetchAll();
    }

    public function fetchById($ticket_id){
        $sql = "SELECT * FROM ticket WHERE ticket_id = " . $ticket_id .";";
        $statement = $this -> pdo -> prepare($sql);
        $statement->execute();
        return $ticket = $statement->fetchAll();
    }

    public function updateById($ticket_id, $field, $newValue){
        $sql = "UPDATE ticket SET " . $field . "= '" . $newValue . "' WHERE ticket_id = " . $ticket_id .";" ;
        $statement = $this -> pdo -> prepare($sql);
        $statement -> execute();
    }

    public function create($args){
        $sql = 'INSERT INTO 
        ticket (seat, row, price, event_event_id, order_item_order_item_id) 
        VALUES (:seat, :row, :price, :event_event_id, :order_item_order_item_id)';
        $statement = $this->pdo->prepare($sql);
        return $statement->execute([
            'seat' => $args['seat'],
            'row' => $args['row'],
            'price' => $args['price'],
            'event_event_id' => $args['event_id'],
            'order_item_order_item_id' => $args['order_item_id']
        ]);
    }

    public function deleteById($ticket_id){
        $sql = 'DELETE * FROM ticket WHERE ticket_id = :ticket_id';
        $statement = $this->pdo->prepare($sql);
        $statement->execute(['ticket_id'=>$ticket_id]);
    }
}