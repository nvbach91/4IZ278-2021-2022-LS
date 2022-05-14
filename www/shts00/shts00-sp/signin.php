<?php require_once __DIR__ . '/includes/header.php'; ?>

<div class="container">
  <div class="row">
    <div class="col-md-6">
        <h2>Přihlášení</h2>
        <form>
            <div class="form-group">
                <label for="exampleInputEmail1">Email</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                <small id="emailHelp" class="form-text text-muted">Zadejte platnou emailovou adresu.</small>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Heslo</label>
                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
            </div>
            <button type="submit" class="btn btn-primary">Přihlásit se</button>
            <a href="signup.php" class="btn btn-link">Ještě nemám účet</a>
        </form>
    </div>
  </div>
</div>


<?php require __DIR__ . '/includes/footer.php'; ?>