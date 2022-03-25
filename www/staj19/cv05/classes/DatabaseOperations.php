<?php

interface DatabaseOperations
{
  // read all
  public function fetchAll();

  // read one
  public function fetchBy($id);

  // update/change
  public function updateById($id, $field, $newValue);

  // create new
  public function create($args);

  // delete existing
  public function deleteById($id);
}
