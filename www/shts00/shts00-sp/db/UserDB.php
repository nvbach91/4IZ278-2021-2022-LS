<?php require_once __DIR__ . '/config.php'; ?>
<?php require_once __DIR__ . '/DBConnection.php'; ?>
<?php require_once __DIR__ . '/IEntityDB.php'; ?>

<?php

class UserDB extends DBConnection implements IEntityDB {

    public function fetchAll(){
        $sql = "SELECT * FROM user;";
        $statement = $this -> pdo ->prepare($sql);
        $statement->execute();
        return $categories = $statement->fetchAll();
    }

    public function fetchById($user_id){
        //TODO
    }

    public function updateById($user_id, $field, $newValue){
        //TODO
    }

    public function create($args){
        //TODO
    }

    public function deleteById($user_id){
        //TODO
    }
}