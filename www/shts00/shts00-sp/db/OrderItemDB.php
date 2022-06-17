<?php require_once __DIR__ . '/config.php'; ?>
<?php require_once __DIR__ . '/DBConnection.php'; ?>
<?php require_once __DIR__ . '/IEntityDB.php'; ?>

<?php

class OrderItemDB extends DBConnection implements IEntityDB {

    public function fetchAll(){
        $sql = "SELECT * FROM order_item;";
        $statement = $this -> pdo ->prepare($sql);
        $statement->execute();
        return $orderItems = $statement->fetchAll();
    }

    public function fetchById($ticket_id){
        //TODO
    }

    public function fetchMaxId(){
        $sql = "SELECT * from order_item ORDER BY order_item_id DESC LIMIT 1";
        $statement = $this -> pdo -> prepare($sql);
        $statement->execute();
        return $orderItem = $statement->fetchAll();
    }

    public function updateById($order_item_id, $field, $newValue){
        $sql = "UPDATE order_item SET " . $field . "= '" . $newValue . "' WHERE order_item_id = " . $order_item_id .";" ;
        $statement = $this -> pdo -> prepare($sql);
        $statement -> execute();
    }

    public function create($args){
        $sql = 'INSERT INTO order_item (price, order_order_id) VALUES (:price, :order_order_id)';
        $statement = $this->pdo->prepare($sql);
        return $statement->execute([
            'price' => $args['price'],
            'order_order_id' => $args['order_id'],
        ]);
    }

    public function deleteById($order_item_id){
        $sql = 'DELETE * FROM order_item WHERE order_item_id = :order_item_id';
        $statement = $this->pdo->prepare($sql);
        $statement->execute(['order_item_id'=>$order_item_id]);
    }
}