<?php require './DatabaseOperations.php';?>
<?php 

abstract class Database implements DatabaseOperations{
   protected $dbPath = './db';
   protected $dbExtension = '.db';
   protected $delimiter = ';';

   public function __construct(){
      echo '....Database ' ,static::class , ' was instantiated....<br>';
   }

   public function __toString(){
     return "DB config: dbPath : $this->dbPath, dbExtension: $this->dbExtension, delimiter: $this->delimiter";
   }

   public function configInfo(){
     echo $this;
   }

}

?>