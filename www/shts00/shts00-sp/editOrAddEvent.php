<?php require_once __DIR__ . '/includes/header.php'; ?>
<?php require_once __DIR__ . '/db/CategoryDB.php'; ?>
<?php require_once __DIR__ . '/db/VenueDB.php'; ?>
<?php require_once __DIR__ . '/controllers/createEventController.php'; ?>

<?php 
$categoryDB = new CategoryDB();
$categories = $categoryDB->fetchAll();

$venueDB = new VenueDB();
$venues = $venueDB->fetchAll();

$errors = [];

if(!empty($_SESSION['addevent_errors'])){
    $errors = $_SESSION['addevent_errors'];

    //po prvnim zobrazeni warningy vyprazdnime
    $_SESSION['addevent_errors'] = [];
}

?>

<?php if (!empty($_GET['success'])): ?>
    <div class="alert alert-success" role="alert">Konference byla založena</div>
<?php endif;?>

<?php if (!empty($errors)): ?>
    <div class="alert alert-danger" role="alert">
        <?php foreach ($errors as $error): ?>
            <p><?php echo $error; ?></p>
        <?php endforeach;?>
    </div>
<?php endif;?>

<form method="post" action="../shts00-sp/controllers/createEventController.php">
  <div class="form-group row">
    <label for="name" class="col-4 col-form-label">Název konference</label> 
    <div class="col-8">
      <input id="name" name="name" placeholder="Název konference" type="text" required="required" class="form-control">
    </div>
  </div>
  <div class="form-group row">
    <label for="description" class="col-4 col-form-label">Popis</label> 
    <div class="col-8">
      <textarea id="description" name="description" cols="40" rows="3" class="form-control"></textarea>
    </div>
  </div>
  <div class="form-group row">
    <label for="category" class="col-4 col-form-label">Kategorie</label> 
    <div class="col-8">
      <select id="category" name="category[]" class="selectpicker" required="required" multiple>
        <?php foreach($categories as $category) : ?>
            <option value="<?php echo $category['category_id']; ?>"><?php echo $category['name']; ?></option>
        <?php endforeach; ?>
      </select>
    </div>
  </div>
  <div class="form-group row">
    <label for="venue" class="col-4 col-form-label">Místo konání</label> 
    <div class="col-8">
      <select id="venue" name="venue" class="selectpicker" required="required">
        <?php foreach($venues as $venue) : ?>
            <option value="<?php echo $venue['venue_id']; ?>"><?php echo $venue['name']; ?></option>
        <?php endforeach; ?>
      </select>
    </div>
  </div>
  <div class="form-group row">
    <label for="organizer" class="col-4 col-form-label">Pořadatel</label> 
    <div class="col-8">
      <input id="organizer" name="organizer" placeholder="Pořadatel" type="text" class="form-control" required="required">
    </div>
  </div>
  <div class="form-group row">
    <label for="date" class="col-4 col-form-label">Datum konání</label> 
    <div class="col-8">
      <input id="date" name="date" type="date" class="form-control" value="01-01-2022">
    </div>
  </div>
  <div class="form-group row">
    <label for="capacity" class="col-4 col-form-label">Počet vstupenek k prodeji</label> 
    <div class="col-8">
      <input id="capacity" name="capacity" type="number" class="form-control" required="required">
    </div>
  </div>
  <div class="form-group row">
    <label for="price" class="col-4 col-form-label">Cena vstupného</label> 
    <div class="col-8">
      <input id="price" name="price" type="number" class="form-control" required="required">
    </div>
  </div>
  <div class="form-group row">
    <label class="col-4">Umožnit prodej listků</label> 
    <div class="col-8">
      <div class="custom-control custom-checkbox custom-control-inline">
        <input name="openForSale" id="openForSale" type="checkbox" class="custom-control-input" value="1"> 
        <label for="openForSale" class="custom-control-label"></label>
      </div>
    </div>
  </div> 
  <div class="form-group row">
    <div class="offset-4 col-8">
      <button name="submit" type="submit" class="btn btn-primary">Submit</button>
    </div>
  </div>
</form>

<?php require __DIR__ . '/includes/footer.php'; ?>