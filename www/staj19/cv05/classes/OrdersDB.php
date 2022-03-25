<?php

require "./classes/DB.php";

class OrdersDB extends Database
{
  protected $tableName = "orders";

  public function fetchAll()
  {
    echo "All orders was fetched<br>";
  }

  public function fetchBy($id)
  {
    echo "An order $id was fetched<br>";
  }

  public function updateById($id, $field, $newValue)
  {
    echo "Order $id updated, $field = $newValue<br>";
  }

  public function create($args)
  {
    $id = $args["id"];
    $date = $args["date"];
    $items = $args["items"];

    echo "Order: $id, Date: $date, Items: $items; was created<br>";
  }

  public function deleteById($id)
  {
    echo "An order $id was deleted<br>";
  }
}
