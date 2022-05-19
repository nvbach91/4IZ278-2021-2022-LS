<?php

interface DatabaseOperations
{
  // read all
  public function fetchAll();

  // read by id
  public function fetchById($id);
}

?>