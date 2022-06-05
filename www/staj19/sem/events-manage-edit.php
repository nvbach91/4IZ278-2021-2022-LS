<?php

require __DIR__ . '/util/is-admin.php';

$pageName = 'EventsBox | Manage Events';


require_once __DIR__ . '/db/category-db.php';
$categoryDB = new CategoryDB();
$categories = $categoryDB->fetchAll();

require_once __DIR__ . '/db/event-db.php';
$eventDB = new EventDB();

require_once __DIR__ . '/db/location-db.php';
$locationDB = new LocationDB();

$eventId = $_GET['id'];
$event = $eventDB->fetchById($eventId);


if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  $location = $locationDB->fetchById($event['location']);
  $categoryDB = $categoryDB->fetchById($event['category']);

  $name = $event['name'];
  $owner = $event['owner'];
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
  $owner = $_POST['owner'];
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
    $eventDB->updateRow($name, $datetime, $owner, $image, $description, $capacity, $location['id'], $categoryInDB['id'], $eventId);

    header("Location: events-manage.php");
    exit();
  }
}

?>

<?php require __DIR__ . '/comp/head.php' ?>

<main>
  <h1>Edit event</h1>

  <form method="POST">
    <?php if (isset($err['form'])) : ?>
      <p class="text-danger"><?php echo $err['form']; ?></p>
    <?php endif ?>
    <input hidden name="owner" value="<?php echo $owner ?>">
    <div class="row">
      <div class="col m-3">
        <div class="mb-3">
          <label class="form-label" for="name">Name*</label>
          <input class="form-control<?php echo (isset($err) && isset($err['name'])) ? ' border border-danger' : '' ?>" name="name" value="<?php echo isset($name) ? $name : '' ?>" required>
          <?php if (isset($err) && isset($err['name'])) : ?>
            <small class="text-danger"><?php echo $err['name'] ?></small>
          <?php endif ?>
        </div>
        <div class="mb-3">
          <label class="form-label" for="category">Category</label>
          <select class="form-select<?php echo (isset($err) && isset($err['category'])) ? ' border border-danger' : '' ?>" name="category">
            <option></option>
            <?php foreach ($categories as $oneCategory) : ?>
              <option <?php echo isset($category) && $oneCategory['name'] == $category ? 'selected="true"' : '' ?>>
                <?php echo $oneCategory['name'] ?>
              </option>
            <?php endforeach ?>
          </select>
          <?php if (isset($err) && isset($err['category'])) : ?>
            <small class="text-danger"><?php echo $err['category'] ?></small>
          <?php endif ?>
        </div>
        <div class="mb-3">
          <label class="form-label" for="image">Image URL</label>
          <input class="form-control<?php echo (isset($err) && isset($err['image'])) ? ' border border-danger' : '' ?>" name="image" value="<?php echo isset($image) ? $image : '' ?>">
          <?php if (isset($err) && isset($err['image'])) : ?>
            <small class="text-danger"><?php echo $err['image'] ?></small>
          <?php endif ?>
        </div>
        <div class="mb-3">
          <label class="form-label" for="description">Description</label>
          <textarea class="form-control" name="description" rows="4"><?php echo isset($description) ? $description : '' ?></textarea>
        </div>
      </div>
      <div class="col m-3">
        <div class="mb-3">
          <label class="form-label" for="datetime">Date & time*</label>
          <input class="form-control<?php echo (isset($err) && isset($err['datetime'])) ? ' border border-danger' : '' ?>" type="datetime-local" name="datetime" value="<?php echo isset($datetime) ? $datetime : '' ?>" required>
          <?php if (isset($err) && isset($err['datetime'])) : ?>
            <small class="text-danger"><?php echo $err['datetime'] ?></small>
          <?php endif ?>
        </div>
        <div class="mb-3">
          <label class="form-label" for="capacity">Capacity</label>
          <input class="form-control<?php echo (isset($err) && isset($err['capacity'])) ? ' border border-danger' : '' ?>" type="number" name="capacity" value="<?php echo isset($capacity) ? $capacity : '' ?>">
          <?php if (isset($err) && isset($err['capacity'])) : ?>
            <small class="text-danger"><?php echo $err['capacity'] ?></small>
          <?php endif ?>
        </div>
        <div class="mb-3">
          <label class="form-label" for="street">Street</label>
          <input class="form-control<?php echo (isset($err) && isset($err['street'])) ? ' border border-danger' : '' ?>" name="street" value="<?php echo isset($street) ? $street : '' ?>">
          <?php if (isset($err) && isset($err['street'])) : ?>
            <small class="text-danger"><?php echo $err['street'] ?></small>
          <?php endif ?>
        </div>
        <div class="mb-3">
          <label class="form-label" for="city">City</label>
          <input class="form-control<?php echo (isset($err) && isset($err['city'])) ? ' border border-danger' : '' ?>" name="city" value="<?php echo isset($city) ? $city : '' ?>">
          <?php if (isset($err) && isset($err['city'])) : ?>
            <small class="text-danger"><?php echo $err['city'] ?></small>
          <?php endif ?>
        </div>
        <div class="mb-3">
          <label class="form-label" for="zip">ZIP</label>
          <input class="form-control<?php echo (isset($err) && isset($err['zip'])) ? ' border border-danger' : '' ?>" name="zip" value="<?php echo isset($zip) ? $zip : '' ?>">
          <?php if (isset($err) && isset($err['zip'])) : ?>
            <small class="text-danger"><?php echo $err['zip'] ?></small>
          <?php endif ?>
        </div>
      </div>
    </div>
    <button class="btn btn-primary m-3" type="submit">Submit</button>
    <a href="events-manage.php" class="m-3">Back</a>
  </form>
</main>


<?php require __DIR__ . '/comp/foot.php' ?>