<?php

interface DBOperations
{
  // read all
  public function fetchAll();

  // read by id
  public function fetchById($id);
}
