<?php require './Database.php'; ?>
<?php
class OrdersDB extends Database {

    public function create($args){
        echo 'Order number ' . $args['orderNumber'] . ' was added.<br>';
    }

    public function fetch($id){
        echo "Order with order number $id was fetched.<br>";
    }

    
    public function save($args){
        echo "Order with orderNumber". $args['orderNumber']. " was saved.<br>";
    }

    
    public function delete($id){
        echo "Order with order number $id was deleted.<br>";
    }
}
?>