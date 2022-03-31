<?php require_once './Database.php'; ?>
 <?php

 class SlidesDB extends Database{
     protected $tableName = 'slides';
     public function fetchAll(){
         $sql = 'SELECT * FROM ' . $this->tableName;
         $statement = $this->pdo->prepare($sql);
         $statement->execute();
         $allResults = $statement->fetchAll();
         return $allResults;
     }
 } 