<?php require_once __DIR__ . '/config.php'; ?>
<?php require_once __DIR__ . '/DBConnection.php'; ?>
<?php require_once __DIR__ . '/IEntityDB.php'; ?>

<?php

class OrganizerDB extends DBConnection implements IEntityDB {

    public function fetchAll(){
        $sql = "SELECT * FROM organizer;";
        $statement = $this -> pdo ->prepare($sql);
        $statement->execute();
        return $organizer = $statement->fetchAll();
    }

    public function fetchById($organizer_id){
        //TODO
    }

    public function fetchMaxId(){
        $sql = "SELECT * from organizer ORDER BY organizer_id DESC LIMIT 1";
        $statement = $this -> pdo -> prepare($sql);
        $statement->execute();
        return $organizer = $statement->fetchAll();
    }

    public function updateById($organizer_id, $field, $newValue){
        $sql = "UPDATE organizer SET " . $field . "= '" . $newValue . "' WHERE organizer_id = " . $organizer_id .";" ;
        $statement = $this -> pdo -> prepare($sql);
        $statement -> execute();
    }

    public function create($args){
        $sql = 'INSERT INTO organizer (name, description) VALUES (:name, :description)';
        $statement = $this->pdo->prepare($sql);
        return $statement->execute([
            'name' => $args['name'],
            'description' => $args['description']
        ]);

    }

    public function deleteById($organizer_id){
        $sql = 'DELETE * FROM organizer WHERE organizer_id = :organizer_id';
        $statement = $this->pdo->prepare($sql);
        $statement->execute(['organizer_id'=>$organizer_id]);
    }
}