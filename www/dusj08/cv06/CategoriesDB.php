<?php require_once './Database.php'; ?>
 <?php

 class CategoriesDB extends Database{
     protected $tableName = 'cv06_categories';
     public function fetchAll(){
         $sql = 'SELECT * FROM ' . $this->tableName;
         $statement = $this->pdo->prepare($sql);
         $statement->execute();
         $allResults = $statement->fetchAll();
         return $allResults;
     }
 }
