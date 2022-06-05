<?php

require __DIR__ . '/util/is-logged.php';

$pageName = 'EventsBox | Event Create';

require_once __DIR__ . '/db/category-db.php';
$categoryDB = new CategoryDB();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  $categories = $categoryDB->fetchAll();
}

if (!empty($_POST)) {
  $name = $_POST['name'];
  $datetime = $_POST['datetime'];
  $category = $_POST['category'];
  $image = $_POST['image'];
  $description = $_POST['description'];
  $capacity = $_POST['capacity'];
  $street = $_POST['street'];
  $city = $_POST['city'];
  $zip = $_POST['zip'];


  // if no input set null (db purpose)
  $category = ($category == '') ? null : $category;
  $image = ($image == '') ? null : $image;
  $description = ($description == '') ? null : $description;
  $capacity = ($capacity == '') ? null : $capacity;
  $street = ($street == '') ? null : $street;
  $city = ($city == '') ? null : $city;
  $zip = ($zip == '') ? null : str_replace(' ', '', $zip);


  // Inputs validation
  require __DIR__ . '/validate/validate.php';
  $validate = new Validate();

  $err['name'] = $validate->name($name);
  $err['datetime'] = $validate->datetime($datetime);
  $err['category'] = $validate->category($category);
  $err['image'] = $validate->image($image);
  $err['capacity'] = $validate->capacity($capacity);
  $err['street'] = $validate->street($street);
  $err['city'] = $validate->city($city);
  $err['zip'] = $validate->zip($zip);
  $err['form'] = $validate->location($street, $city, $zip);

  $err = array_filter($err, function ($value) {
    return !is_null($value) && $value !== '';
  });


  // location check / insert, event insert
  if (empty($err)) {
    require_once __DIR__ . '/db/location-db.php';
    if (isset($err['street']) && isset($err['city']) && isset($err['zip'])) {
      $locationDB = new LocationDB();
      $location = $locationDB->checkAndInsertRow($city, $street, $zip);
    }

    $categoryInDB = $categoryDB->fetchByName($category);
    $categoryInDB = $categoryInDB == '' ? null : $categoryInDB;

    require_once __DIR__ . '/db/event-db.php';
    $eventDB = new EventDB();
    $eventDB->insertRow($name, $datetime, $user['id'], $image, $description, $capacity, $location['id'], $categoryInDB['id']);

    header('Location: events.php');
    exit();
  }
}

?>

<?php require __DIR__ . '/comp/head.php' ?>

<main>
  <h1>Create event</h1>

  <?php require __DIR__ . '/comp/event-form.php' ?>
</main>

<?php require __DIR__ . '/comp/foot.php' ?>