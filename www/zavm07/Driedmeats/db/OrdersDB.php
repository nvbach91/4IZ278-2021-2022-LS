<?php

class OrdersDB extends Database{
    protected $tableName = 'orders';

    public function fetchById($id){
        $statement = $this->pdo->prepare('SELECT * FROM '.$this->tableName.' WHERE order_id = :id LIMIT 1');
        $statement->execute(['id'=>$id]);
        return $statement->fetchAll();
    }

    public function fetchByUser($id){
        $statement = $this->pdo->prepare('SELECT * FROM '.$this->tableName.' WHERE user_id = :id ORDER BY date desc');
        $statement->execute(['id'=>$id]);
        return $statement->fetchAll();
    }

    public function create($args){
        $sql = 'INSERT INTO ' . $this->tableName.' (order_id, street, city, zip, shipping, user_id, price) VALUES (:id, :street, :city, :zip, :shipping, :user_id, :price)';
        $statement = $this->pdo->prepare($sql);
        return $statement->execute([
            'id' => $args['id'],
            'street' => $args['street'],
            'city' => $args['city'],
            'zip' => $args['zip'],
            'shipping' => $args['shipping'],
            'user_id' => $args['user_id'],
            'price' => $args['price']
        ]);
    }

    public function deleteById($id){
        $statement = $this->pdo->prepare('DELETE * FROM '.$this->tableName.' WHERE order_id = :id');
        $statement->execute(['id'=>$id]);
    }

    public function fetchAggregation(){
        $statement = $this->pdo->prepare('SELECT CAST(date AS DATE) AS date,COUNT(*) AS sum ,SUM(price) AS price FROM '.$this->tableName.' GROUP BY CAST(date AS DATE) ORDER BY date desc');
        $statement->execute();
        return $statement;
    }
}