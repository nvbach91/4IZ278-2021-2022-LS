<?php

require "./classes/DB.php";

class UsersDB extends Database
{
  protected $tableName = "users";

  public function fetchAll()
  {
    echo "All users was fetched<br>";
  }

  public function fetchBy($id)
  {
    echo "An user $id was fetched<br>";
  }

  public function updateById($id, $field, $newValue)
  {
    echo "User $id updated, $field = $newValue<br>";
  }

  public function create($args)
  {
    $id = $args["id"];
    $email = $args["email"];
    $password = $args["password"];

    echo "Id: $id, Email: $email, Password: $password; was created<br>";
  }

  public function deleteById($id)
  {
    echo "An user $id was deleted<br>";
  }
}
