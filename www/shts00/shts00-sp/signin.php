<?php 
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/controllers/signinController.php';
//require_once __DIR__ . '/fb/fb-login-button.php';
?>

<?php if (!empty($_GET['error']) && ($_GET['error'] == 1)): ?>
    <div class="alert alert-danger" role="alert">Špatný login nebo heslo!</div>
<?php endif;?>

<?php if (!empty($_GET['error']) && ($_GET['error'] == 2)): ?>
    <div class="alert alert-primary col-md-4" role="alert">Nejdřív se musíte přihlásit</div>
<?php endif;?>

<div class="container">
  <div class="row">
    <div class="col-md-6">
        <h2>Přihlášení</h2>
        <form method="POST" action="../shts00-sp/controllers/signinController.php">
            <div class="form-group">
                <label for="exampleInputEmail1">Email</label>
                <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                <small id="emailHelp" class="form-text text-muted">Zadejte platnou emailovou adresu.</small>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Heslo</label>
                <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
            </div>
            <button type="submit" class="btn btn-primary">Přihlásit se</button>
        </form>
        <?php require __DIR__ . '/fb/fb-login-button.php'; ?>
        <a href="signup.php" class="btn btn-link">Ještě nemám účet</a>
    </div>
  </div>
</div>


<?php require __DIR__ . '/includes/footer.php'; ?>