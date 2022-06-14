<?php
session_start();
require_once __DIR__ . '/db/UsersDB.php';

$alerts = [];

if ('POST' == $_SERVER['REQUEST_METHOD']) {
  $email = $_POST['email'];
  $password = $_POST['password'];

$userDB = new UsersDB();
$existing_user = @$userDB->fetchByEmail($email)[0];



if (password_verify($password, $existing_user['password_hash'])) {
  $_SESSION['user_id'] = $existing_user['user_id'];
  $_SESSION['user_email'] = $existing_user['email'];
  $_SESSION['user_firstName'] = $existing_user['first_name'];
  $_SESSION['user_lastName'] = $existing_user['last_name'];
  $_SESSION['loggedin'] = true;
  $_SESSION['user_isAdmin'] = $existing_user['is_admin'];

  header('Location: animals.php');
} else {
  array_push($alerts, 'Špatný email nebo heslo!');
  //exit('Invalid user or password!');
}
}

?>


<?php require __DIR__ . '/includes/header.php';?>
<main class="login-page">
<div class="container">
    <div class="logincard">
    <div class="card" style="border-radius: 1rem; margin:auto;">
          <div class="row g-0">
            <div class="col-md-6 col-lg-5 d-none d-md-block">
              <img src="https://api.zoohluboka.cz/storage/1920x1920_1587508164.505_5910-surikata_-_Jerhotova_081.jpg"
                alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
            </div>
            <div class="col-md-6 col-lg-7 d-flex align-items-center">
              <div class="card-body p-4 p-lg-5 text-black">

                <form method="POST">

                  <div class="d-flex align-items-center mb-3 pb-1">
                   
                    <span class="h1 fw-bold mb-0">Zoonation</span>
                  </div>

                  <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Přihlašte se do účtu</h5>

                  <?php if(!empty($alerts)): ?>
                       <div class="errors">
                    <?php foreach($alerts as $alert): ?>
                                <div class="error"><?php echo $alert; ?></div>
                            <?php endforeach; ?>
                    </div>
                    <?php endif; ?>

                  <div class="form-outline mb-4">
                    <input type="email" class="form-control form-control-lg" name="email" required/>
                    <label class="form-label" >Email</label>
                  </div>

                  <div class="form-outline mb-4">
                    <input type="password" class="form-control form-control-lg" name="password" required/>
                    <label class="form-label" >Heslo</label>
                  </div>

                  <div class="pt-1 mb-4">
                    <button class="btn btn-dark btn-lg btn-block" type="submit">Přihlásit se</button>
                  </div>

                  
                  <p class="mb-5 pb-lg-2" style="color: #393f81;">Nemáte účet? <a href="signup.php"
                      style="color: #393f81;">Zaregistrujte se zde a dostaň 100, Kč bonus</a></p>
                </form>

              </div>
           </div>
          
        </div>
</div>

</div>
</main>
<?php require __DIR__ . '/includes/footer.php';?>