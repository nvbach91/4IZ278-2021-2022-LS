<?php require_once __DIR__ . '/includes/header.php'; ?>
<?php require_once __DIR__ . '/controllers/signupController.php'; ?>

<?php

$errors = [];

if(!empty($_SESSION['signup_errors'])){
    $errors = $_SESSION['signup_errors'];

    //po prvnim zobrazeni warningy vyprazdnime
    $_SESSION['signup_errors'] = [];
}

?>

<div class="container">
  <div class="row">
    <div class="col-md-6">
        <h2>Registrace</h2>

        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger" role="alert">
                <?php foreach ($errors as $error): ?>
                    <p><?php echo $error; ?></p>
                <?php endforeach;?>
            </div>
        <?php endif;?>

        <form method="post" action="../shts00-sp/controllers/signupController.php">
            <div class="form-group">
                <label for="email">Email</label>
                <input name="email" type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="example@example.cz">
                <small id="emailHelp" class="form-text text-muted">Zadejte platnou emailovou adresu.</small>
            </div>
            <div class="form-group">
                <label for="password">Heslo</label>
                <input name="password" type="password" class="form-control" id="password" placeholder="Zadejte heslo">
            </div>
            <div class="form-group">
                <label for="confirmPassword">Potvrdit heslo</label>
                <input name="confirmPassword" type="password" class="form-control" id="confirmPassword" placeholder="Zadejte heslo znovu">
            </div>
            <button type="submit" class="btn btn-primary">Zaregistrovat se</button>
        </form>
    </div>
  </div>
</div>

<?php require __DIR__ . '/includes/footer.php'; ?>