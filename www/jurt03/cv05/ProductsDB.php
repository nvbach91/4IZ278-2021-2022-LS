<?php require './Database.php'; ?>
<?php
class ProductsDB extends Database {

    public function create($args){
        echo 'Product ' . $args['name'] . ' productID: ' . $args['productID'] . ' price: ' . $args['price'] . ' was added.<br>';
    }

    public function fetch($id){
        echo "Product with productID $id was fetched.<br>";
    }

    
    public function save($args){
        echo "Product with productID" . $args['productID'] . " was saved.<br>";
    }

    
    public function delete($id){
        echo "Product with productID $id was deleted.<br>";
    }
}
?>