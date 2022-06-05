<?php

require __DIR__ . '/util/is-logged.php';

$pageName = 'EventsBox | Event Edit';

require_once __DIR__ . '/db/category-db.php';
$categoryDB = new CategoryDB();
$categories = $categoryDB->fetchAll();

require_once __DIR__ . '/db/event-db.php';
$eventDB = new EventDB();

require_once __DIR__ . '/db/location-db.php';
$locationDB = new LocationDB();

$eventId = $_GET['id'];
$event = $eventDB->fetchById($eventId);

if (empty($event) || $event['owner'] !== $user['id']) {
  header('Location: events.php');
  exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  $location = $locationDB->fetchById($event['location']);
  $categoryDB = $categoryDB->fetchById($event['category']);

  $name = $event['name'];
  $datetime = str_replace(' ', 'T', date('Y-m-d H:i', strtotime($event['datetime'])));
  $category = isset($categoryDB['name']) ? $categoryDB['name'] : '';
  $image = isset($event['img']) ? $event['img'] : '';
  $description = isset($event['description']) ? $event['description'] : '';
  $capacity = isset($event['capacity']) ? $event['capacity'] : '';
  $street = isset($location['street']) ? $location['street'] : '';
  $city = isset($location['city']) ? $location['city'] : '';
  $zip = isset($location['zip']) ? $location['zip'] : '';
}


if (!empty($_POST)) {
  $event = $eventDB->fetchById($eventId);

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
    $eventDB->updateRow($name, $datetime, $user['id'], $image, $description, $capacity, $location['id'], $categoryInDB['id'], $eventId);

    header("Location: event-detail.php?id=$eventId");
    exit();
  }
}

?>

<?php require __DIR__ . '/comp/head.php' ?>

<main>
  <h1>Edit event</h1>

  <?php require __DIR__ . '/comp/event-form.php' ?>
</main>


<?php require __DIR__ . '/comp/foot.php' ?>