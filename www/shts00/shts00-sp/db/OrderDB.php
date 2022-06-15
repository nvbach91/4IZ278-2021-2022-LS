<?php require_once __DIR__ . '/config.php'; ?>
<?php require_once __DIR__ . '/DBConnection.php'; ?>
<?php require_once __DIR__ . '/IEntityDB.php'; ?>

<?php

class OrderDB extends DBConnection implements IEntityDB {

    public function fetchAll(){
        $sql = "SELECT * FROM `order`;";
        $statement = $this -> pdo ->prepare($sql);
        $statement->execute();
        return $orders = $statement->fetchAll();
    }

    public function fetchById($order_id){
        $sql = "SELECT * FROM `order` WHERE order_id = " . $order_id .";";
        $statement = $this -> pdo -> prepare($sql);
        $statement->execute();
        return $order = $statement->fetchAll();
    }

    public function fetchMaxId(){
        $sql = "SELECT * from `order` ORDER BY order_id DESC LIMIT 1";
        $statement = $this -> pdo -> prepare($sql);
        $statement->execute();
        return $order = $statement->fetchAll();
    }

    public function updateById($order_id, $field, $newValue){
        $sql = "UPDATE `order` SET " . $field . "= '" . $newValue . "' WHERE order_id = " . $order_id .";" ;
        $statement = $this -> pdo -> prepare($sql);
        $statement -> execute();
    }

    public function create($args){
        $sql = 'INSERT INTO `order` (total_price, date, user_user_id) VALUES (:total_price, :date, :user_user_id)';
        $statement = $this->pdo->prepare($sql);
        return $statement->execute([
            'total_price' => $args['total_price'],
            'date' => $args['date'],
            'user_user_id' => $args['user_id'],
        ]);
    }

    public function deleteById($order_id){
        $sql = 'DELETE * FROM `order` WHERE order_id = :order_id';
        $statement = $this->pdo->prepare($sql);
        $statement->execute(['order_id'=>$order_id]);
    }
}