<?php require_once __DIR__ . '/config.php'; ?>
<?php require_once __DIR__ . '/DBConnection.php'; ?>
<?php require_once __DIR__ . '/IEntityDB.php'; ?>

<?php

class CategoryDB extends DBConnection implements IEntityDB {

    public function fetchAll(){
        $sql = "SELECT * FROM category;";
        $statement = $this -> pdo ->prepare($sql);
        $statement->execute();
        return $categories = $statement->fetchAll();
    }

    public function fetchById($category_id){
        $sql = "SELECT * FROM category WHERE category_id = " . $category_id .";";
        $statement = $this -> pdo -> prepare($sql);
        $statement->execute();
    }

    public function updateById($category_id, $field, $newValue){
        $sql = "UPDATE category SET " . $field . "= '" . $newValue . "' WHERE category_id = " . $category_id .";" ;
        $statement = $this -> pdo -> prepare($sql);
        $statement -> execute();
    }

    public function create($args){
        $sql = "INSERT INTO category (name) VALUES ('".$args['name']."');";
        $statement = $this -> pdo -> prepare($sql);
        $statement -> execute();
    }

    public function deleteById($category_id){
        $sql = 'DELETE * FROM category WHERE category_id = :category_id';
        $statement = $this->pdo->prepare($sql);
        $statement->execute(['category_id'=>$category_id]);
    }
}