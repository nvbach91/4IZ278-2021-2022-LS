<?php require_once __DIR__ . '/includes/header.php'; ?>
<?php require_once __DIR__ . '/db/VenueDB.php'; ?>
<?php require_once __DIR__ . '/controllers/createVenueController.php'; ?>

 <?php
 $errors = [];

 if(!empty($_SESSION['addvenue_errors'])){
     $errors = $_SESSION['addvenue_errors'];
 
     //po prvnim zobrazeni warningy vyprazdnime
     $_SESSION['addvenue_errors'] = [];
 }
?>

<?php if (!empty($_GET['success'])): ?>
    <div class="alert alert-success" role="alert">Místo konání bylo založeno</div>
<?php endif;?>

<?php if (!empty($errors)): ?>
    <div class="alert alert-danger" role="alert">
        <?php foreach ($errors as $error): ?>
            <p><?php echo $error; ?></p>
        <?php endforeach;?>
    </div>
<?php endif;?>

<form method="post" action="../shts00-sp/controllers/createVenueController.php">
  <div class="form-group">
    <label for="name" class="col-4 col-form-label">Název místa</label> 
    <div class="col-8">
      <input id="name" name="name" placeholder="Název místa" type="text" required="required" class="form-control">
    </div>
  </div>
  <div class="form-group">
    <label for="address" class="col-4 col-form-label">Adresa</label> 
    <div class="col-8">
      <input id="address" name="address" placeholder="Adresa" type="text" class="form-control">
    </div>
  </div>
  <div class="form-group">
    <label for="city" class="col-4 col-form-label">Město</label> 
    <div class="col-8">
      <input id="city" name="city" placeholder="Město" type="text" required="required" class="form-control">
    </div>
  </div>
  <div class="form-group">
    <label for="max_capacity" class="col-4 col-form-label">Maximální kapacita</label> 
    <div class="col-8">
      <input id="max_capacity" name="max_capacity" type="number" class="form-control">
    </div>
  </div> 
  <div class="form-group">
    <div class="offset-4 col-8">
      <button name="submit" type="submit" class="btn btn-primary">Uložit</button>
    </div>
  </div>
</form>

<?php require __DIR__ . '/includes/footer.php'; ?>


