<?php require_once __DIR__ . '/Database.php'; ?>
<?php

class OrderItemsDB extends Database
{
    protected $tableName = 'sp_order_items';

    public function fetchAll()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM " . $this->tableName);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function fetchById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM " . $this->tableName . " WHERE order_item_id = :id;");
        $stmt->execute(['id' => $id]);
        return $stmt;
    }

    public function fetchByOrderId($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM " . $this->tableName . " WHERE order_id = :id;");
        $stmt->execute(['id' => $id]);
        return $stmt;
    }

    public function create($args)
    {
        $stmt = $this->pdo->prepare("INSERT INTO $this->tableName (qty, price, product_id, order_id) VALUES (:qty, :price, :product_id, :order_id);");
        $stmt->execute([
            'qty' => $args['qty'],
            'price' => $args['price'],
            'product_id' => $args['productId'],
            'order_id' => $args['orderId'],
        ]);
       
    }

    public function deleteById($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM " . $this->tableName . " WHERE order_item_id = " . $id . ";");
        $stmt->execute();
    }

    public function updateById($id, $field, $newValue) {
        $stmt = $this -> pdo -> prepare("UPDATE " . $this -> tableName . " SET " . $field . "= '" . $newValue . "' WHERE order_item_id = " . $id . ";");
        $stmt -> execute();
    }
}


?>