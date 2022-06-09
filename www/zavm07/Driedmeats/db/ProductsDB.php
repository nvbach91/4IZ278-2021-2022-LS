<?php

class ProductsDB extends Database{
    protected $tableName = "products";

    public function fetchAll(){
        $statement = $this->pdo->prepare("SELECT * FROM ".$this->tableName);
        $statement->execute();
        return $statement->fetchAll();
         }

     public function fetchById($id){
        $statement = $this->pdo->prepare("SELECT * FROM ".$this->tableName." WHERE prod_id = :id LIMIT 1");
        $statement->execute(['id'=>$id]);
        return $statement->fetchAll();

     }

     public function fetchByCategory($id, $offset, $itemsPerPage){
        $itemsPerPage = 6;
         $statement = $this->pdo->prepare("SELECT * FROM ".$this->tableName."  WHERE cat_id = ? ORDER BY prod_id LIMIT ? OFFSET ?");
         $statement->bindValue(1, $id, PDO::PARAM_INT);
         $statement->bindValue(2, $itemsPerPage, PDO::PARAM_INT);
         $statement->bindValue(3, $offset, PDO::PARAM_INT);
         $statement->execute();
         return $statement->fetchAll();
     }

     public function countItems($cat_id){
        $statement = $this->pdo->prepare("SELECT COUNT(prod_id) FROM products WHERE cat_id = :cat_id ");
        $statement->execute(['cat_id'=>$cat_id]);
        return $statement->fetchColumn();
     }

    public function create($args){
        $sql = 'INSERT INTO ' . $this->tableName.' (prod_name, description, price, size, cat_id, img_link) VALUES (:prod_name, :description, :price, :size, :cat_id, :img_link)';
        $statement = $this->pdo->prepare($sql);
        return $statement->execute([
            'prod_name' => $args['prod_name'],
            'description' => $args['description'],
            'price' => $args['price'],
            'size' => $args['size'],
            'cat_id' => $args['cat_id'],
            'img_link' => $args['img_link'],
        ]);

    }

    public function updateById($id, $field, $value){
        $statement = $this -> pdo -> prepare('UPDATE ' . $this-> tableName . ' SET ' . $field . '= :value  WHERE prod_id = :id');
        return $statement -> execute([
            'value'=>$value,
            'id'=>$id
        ]);
    }

    public function deleteById($id){
        $statement = $this->pdo->prepare('SET FOREIGN_KEY_CHECKS=0; DELETE FROM '.$this->tableName.' WHERE prod_id = :id;SET FOREIGN_KEY_CHECKS=1');
        return$statement->execute(['id'=>$id]);
    }
}
?>
