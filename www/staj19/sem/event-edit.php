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

if (empty($event) || $event['owner'] !== $user['id']) {
  header('Location: events.php');
  exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  $event = $eventDB->fetchById($eventId);
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

  var_dump($err);
  var_dump(empty($err));
  // location check / insert, event insert
  if (empty($err)) {
    require_once __DIR__ . '/db/location-db.php';
    $locationDB = new LocationDB();
    $location = $locationDB->checkAndInsertRow($city, $street, $zip);

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


<h1>Edit event</h1>

<form class="m-5" method="POST">
  <?php if (isset($err['form'])) : ?>
    <p><?php echo $err['form']; ?></p>
  <?php endif ?>
  <div class="row">
    <div class="col">
      <div>
        <label class="form-label" for="name">Name*</label>
        <input class="form-control" name="name" value="<?php echo isset($name) ? $name : '' ?>" required>
        <?php if (isset($err) && isset($err['name'])) : ?>
          <small><?php echo $err['name'] ?></small>
        <?php endif ?>
      </div>
      <div>
        <label class="form-label" for="category">Category</label>
        <select class="form-select" name="category">
          <option></option>
          <?php foreach ($categories as $oneCategory) : ?>
            <option <?php echo isset($category) && $oneCategory['name'] == $category ? 'selected="true"' : '' ?>>
              <?php echo $oneCategory['name'] ?>
            </option>
          <?php endforeach ?>
        </select>
        <?php if (isset($err) && isset($err['category'])) : ?>
          <small><?php echo $err['category'] ?></small>
        <?php endif ?>
      </div>
      <div>
        <label class="form-label" for="image">Image URL</label>
        <input class="form-control" name="image" value="<?php echo isset($image) ? $image : '' ?>">
        <?php if (isset($err) && isset($err['image'])) : ?>
          <small><?php echo $err['image'] ?></small>
        <?php endif ?>
      </div>
      <div>
        <label class="form-label" for="description">Description</label>
        <textarea class="form-control" name="description" rows="4"><?php echo isset($description) ? $description : '' ?></textarea>
      </div>
    </div>
    <div class="col">
      <div>
        <label class="form-label" for="datetime">Date & time*</label>
        <input class="form-control" type="datetime-local" name="datetime" value="<?php echo isset($datetime) ? $datetime : '' ?>" required>
        <?php if (isset($err) && isset($err['datetime'])) : ?>
          <small><?php echo $err['datetime'] ?></small>
        <?php endif ?>
      </div>
      <div>
        <label class="form-label" for="capacity">Capacity</label>
        <input class="form-control" type="number" name="capacity" value="<?php echo isset($capacity) ? $capacity : '' ?>">
        <?php if (isset($err) && isset($err['capacity'])) : ?>
          <small><?php echo $err['capacity'] ?></small>
        <?php endif ?>
      </div>
      <div>
        <label class="form-label" for="street">Street</label>
        <input class="form-control" name="street" value="<?php echo isset($street) ? $street : '' ?>">
        <?php if (isset($err) && isset($err['street'])) : ?>
          <small><?php echo $err['street'] ?></small>
        <?php endif ?>
      </div>
      <div>
        <label class="form-label" for="city">City</label>
        <input class="form-control" name="city" value="<?php echo isset($city) ? $city : '' ?>">
        <?php if (isset($err) && isset($err['city'])) : ?>
          <small><?php echo $err['city'] ?></small>
        <?php endif ?>
      </div>
      <div>
        <label class="form-label" for="zip">ZIP</label>
        <input class="form-control" name="zip" value="<?php echo isset($zip) ? $zip : '' ?>">
        <?php if (isset($err) && isset($err['zip'])) : ?>
          <small><?php echo $err['zip'] ?></small>
        <?php endif ?>
      </div>
    </div>
  </div>
  <button class="btn btn-primary m-3" type="submit">Submit</button>
  <a href="event-detail.php?id=<?php echo $eventId ?>" class="m-3">Back</a>
</form>


<?php require __DIR__ . '/comp/foot.php' ?>