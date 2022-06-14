<?php
session_start();
$alerts = [];

require_once __DIR__ . '/includes/requireUser.php';

require_once __DIR__ . '/db/UsersDB.php';
require_once __DIR__ . '/includes/header.php'; 



$usersDB = new UsersDB();
$editedUser = $usersDB->fetchById($_SESSION['user_id'])[0];
$editedUserID=$editedUser['user_id'];


if (!empty($_POST)) {
    $password = $_POST['password'];
    $passwordConfirm = $_POST['passwordConfirm'];
    
    if(strcmp($password,$passwordConfirm)){
      array_push($alerts, 'Hesla nejsou stejná');
    }
  
    if(!preg_match('@[A-Z]@', $password) || !preg_match('@[a-z]@', $password) || !preg_match('@[0-9]@', $password) || strlen($password) < 8) {
      array_push ($alerts, 'Heslo by mělo být nejméně 8 znaků dlouhé a obsahovat nejméně jedno velké písmeno, jedno číslo.');
    }
  
    
    if(!count($alerts)){
        //TODO: SEND EMAIL
          
          $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
          $hashedPasswordStr=$hashedPassword;
          
          $changedPasswordUser=$usersDB->changePassword(['password_hash' => $hashedPassword, 'user_id' => $editedUser['user_id']]);


          header('Location: profile.php?passwordChanged=1');
    }

}  

?>

<main class="dashboard animals">
    <div class="container">
        
        <div class="card" style="border-radius: 1rem; margin:auto;">
          
            <div class="col-md-6 col-lg-7 d-flex align-items-center">
            <div class="card-body p-4 p-lg-5 text-black">

            <form method="POST">

            <div class="d-flex align-items-center mb-3 pb-1">
              <span class="h1 fw-bold mb-0"><?php echo $editedUser['first_name'] . ' ' . $editedUser['last_name']; ?></span>
             </div>

            <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Změna hesla</h5>


  
            <div class="form-outline mb-4">
                 <input type="password" name="password" class="form-control form-control-lg" value="<?php echo isset($password) ? $password : ''; ?>" required="">
                 <label class="form-label">Heslo</label>
            </div>
            <div class="form-outline mb-4">
                 <input type="password" name="passwordConfirm" class="form-control form-control-lg" value="<?php echo isset($passwordConfirm) ? $passwordConfirm : ''; ?>" required="">
                 <label class="form-label">Potvrdit heslo</label>
        </div>

         <?php if(!empty($alerts)): ?>
         <div class="errors">
         <?php foreach($alerts as $alert): ?>
                 <div class="error"><?php echo $alert; ?></div>
             <?php endforeach; ?>
         </div>
         <?php endif; ?>


         <div class="pt-1 mb-4">
             <button class="btn btn-dark btn-lg btn-block" type="submit">Změnit</button>
         </div>

  
  
        </form>
        <a href="profile.php"><button class="btn btn-info btn-lg btn-block">Zpět</button></a>
    </div>
          
          
        
</div>
</div>
</div>
</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>