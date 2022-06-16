<?php require_once __DIR__ . '/Database.php'; ?>
<?php

class OrdersDB extends Database {
    protected $tableName = 'sp_orders';

    public function fetchAll() {
        $statement = $this->pdo->prepare("SELECT * FROM $this->tableName");
        $statement->execute();
        return $statement->fetchAll();
    }

    public function fetchById($id)
    {
        $statement = $this->pdo->prepare("SELECT * FROM $this->tableName WHERE user_id = :id ORDER BY date DESC LIMIT 1;");
        $statement->execute(['id' => $id]);
        return $statement;
    }
    
    // update/change
    public function updateById($id, $field, $newValue){
        
    }
    public function fetchByAnyId($id, $value)
    {
        $statement = $this->pdo->prepare("SELECT * FROM $this->tableName WHERE $id = :value ORDER BY date DESC;");
        $statement->execute(['value' => $value,]);
        return $statement;
    }

    public function create($args)
    {
        $statement = $this->pdo->prepare("INSERT INTO $this->tableName (date, seller_id, buyer_id, product_id, price) VALUES (:date, :seller_id, :buyer_id, :product_id, :price);");
        $statement->execute([
            'date' => $args['date'],
            'seller_id' => $args['seller_id'],
            'buyer_id' => $args['buyer_id'],
            'product_id' => $args['product_id'],
            'price' => $args['price'],
        ]);
       
    }

    // delete existing
    public function deleteById($id){}

    
    public function save($args){

    }
    public function fetch($args){

    }
    public function delete($args){

    }
}


?>