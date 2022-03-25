<?php

require './classes/DatabaseOperations.php';

abstract class Database implements DatabaseOperations
{
  protected $dbPath = '/';
  protected $dbExtension = '.db';
  protected $delimiter = ';';

  public function __construct()
  {
    echo "DB instantiated<br><br>";
  }

  public function __toString()
  {
    return "DB config: path: $this->dbPath, extenstion: $this->dbExtension, delimiter: $this->delimiter<br><br>";
  }

  public function configInfo()
  {
    echo $this;
  }
}
