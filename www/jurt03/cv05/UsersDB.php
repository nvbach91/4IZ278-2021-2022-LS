<?php require './Database.php'; ?>
<?php
class UsersDB extends Database {

    public function create($args){
        echo 'User with ID' . $args['id'] . ' and name: ' .$args['name'] . ' ,age: ' . $args['age'] . ' ,city: ' . $args['city'] . ' was added.<br>';
    }

    public function fetch($id){
        echo "User with ID $id was fetched.<br>";
    }

    
    public function save($args){
        echo "User with ID " .$args['id'] . " was saved.<br>";
    }

    
    public function delete($id){
        echo "User with ID $id was deleted.<br>";
    }
}
?>