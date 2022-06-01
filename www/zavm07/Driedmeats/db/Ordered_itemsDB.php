<?php

class Ordered_itemsDB extends Database{
    private $tableName = 'ordered_items';

    public function fetchById($id){
        $statement = $this->pdo->prepare('SELECT * FROM '.$this->tableName.' WHERE order_id = :id');
        $statement->execute(['id'=>$id]);
        return $statement->fetchAll();
    }

    public function create($args){
        $sql = 'INSERT INTO ' . $this->tableName.'(prod_id, order_id, prod_name, count, price) VALUES (:prod_id, :order_id, :prod_name, :count, :price)';
        $statement = $this->pdo->prepare($sql);
        return $statement->execute([
            'prod_id' => $args['prod_id'],
            'order_id' => $args['order_id'],
            'prod_name' => $args['prod_name'],
            'count' => $args['count'],
            'price' => $args['price'],
        ]);
    }}