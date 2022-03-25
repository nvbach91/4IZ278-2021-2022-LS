<?php

require "./classes/DB.php";

class BooksDB extends Database
{
  protected $tableName = "books";

  public function fetchAll()
  {
    echo "All books was fetched<br>";
  }

  public function fetchBy($id)
  {
    echo "A book $id was fetched<br>";
  }

  public function updateById($id, $field, $newValue)
  {
    echo "Book $id updated, $field = $newValue<br>";
  }

  public function create($args)
  {
    $id = $args["id"];
    $title = $args["title"];
    $published = $args["published"];
    $price = $args["price"];

    echo "Id: $id, Title: $title, Published: $published, Price: $price; was created<br>";
  }

  public function deleteById($id)
  {
    echo "A books $id was deleted<br>";
  }
}
