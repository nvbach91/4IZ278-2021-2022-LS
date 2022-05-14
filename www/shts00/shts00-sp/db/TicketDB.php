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
        //TODO
    }

    public function updateById($ticket_id, $field, $newValue){
        //TODO
    }

    public function create($args){
        //TODO
    }

    public function deleteById($ticket_id){
        //TODO
    }
}