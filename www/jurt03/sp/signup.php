<?php
session_start();

require_once __DIR__ . '/db/UsersDB.php';

$alerts = [];

if (!empty($_POST)) {
  $usersDB = new UsersDB();
  $firstName = $_POST['firstName'];
  $lastName = $_POST['lastName'];
  $address = $_POST['address'];
  $city = $_POST['city'];
  $state = $_POST['state'];
  $phone = $_POST['phone'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $passwordConfirm = $_POST['passwordConfirm'];
  $isUserRegisteredYet= $usersDB->fetchByEmail($email)[0];

  if(!$isUserRegisteredYet['user_id'] == ""){
    array_push($alerts, 'Uživatel je již registrován.');
  }
  //check first and last name
  if (strlen($firstName) < 2 ){
    array_push($alerts, 'Jméno je příliš krátké');
  }

  if (strlen($lastName) < 2 ){
    array_push($alerts, 'Příjmení je příliš krátké');
  }

  //check address and city and state
  if (strlen($address) < 3 ){
    array_push($alerts, 'Adresa je příliš krátká');
  }

  if (strlen($city) < 3 ){
    array_push($alerts, 'Město je příliš krátké');
  }

  if (strlen($state) < 3 ){
    array_push($alerts, 'Název země je příliš krátký');
  }

  //check phone number

  if (!preg_match('/^\+?\d{9,}$/', $phone)) {
    array_push($alerts, 'Neplatné telefonní číslo');
  }

  //check email
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    array_push($alerts, 'Neplatný email');
  } 
  
  if(strcmp($password,$passwordConfirm)){
    array_push($alerts, 'Hesla nejsou stejná');
  }

  if(!preg_match('@[A-Z]@', $password) || !preg_match('@[a-z]@', $password) || !preg_match('@[0-9]@', $password) || strlen($password) < 8) {
    array_push ($alerts, 'Heslo by mělo být nejméně 8 znaků dlouhé a obsahovat nejméně jedno velké písmeno, jedno číslo.');
  }


if(!count($alerts)){
//TODO: SEND EMAIL
  //insert user into database
  $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
  $credit = 100;
  $donated = 0;
  $isAdmin= 0;
  
  $newUser=$usersDB->create([
  'first_name' => $firstName,
  'last_name' => $lastName,
  'address' => $address,
  'city' => $city,
  'state' => $state,
  'phone' => $phone,
  'email' => $email,
  'password_hash' => $hashedPassword,
  'credit' => $credit,
  'donated' => $donated,
  'is_admin' => $isAdmin
  ]);
    
  $loggedUser=$usersDB->fetchByEmail($email)[0];
  
  $_SESSION['user_id']= $loggedUser['user_id'];
  $_SESSION['user_firstName'] = $loggedUser['first_name'];
  $_SESSION['user_lastName'] = $loggedUser['last_name'];
  $_SESSION['user_email'] = $loggedUser['email'];
  $_SESSION['loggedin'] = true;
  $_SESSION['user_isAdmin'] = $loggedUser['is_admin'];
  header('Location: animals.php');
}


}
?>




<?php require __DIR__ . '/includes/header.php';?>
<main class="login-page">
<div class="container">
    
    <div class="card" style="border-radius: 1rem; margin:auto;">
          
            <div class="col-md-6 col-lg-7 d-flex align-items-center">
            <div class="card-body p-4 p-lg-5 text-black">

<form method="POST">

  <div class="d-flex align-items-center mb-3 pb-1">
    <span class="h1 fw-bold mb-0">Zoonation</span>
  </div>

  <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Registrace se vstupním bonusem 100,-Kč</h5>


  <div class="form-outline mb-4">
    <input type="text" name="firstName" class="form-control form-control-lg" value="<?php echo isset($firstName) ? $firstName : ''; ?>" required/>
    <label class="form-label" >Jméno</label>
  </div>
  <div class="form-outline mb-4">
    <input type="text" name="lastName" class="form-control form-control-lg" value="<?php echo isset($lastName) ? $lastName : ''; ?>" required/>
    <label class="form-label" >Příjmení</label>
  </div>

  <div class="form-outline mb-4">
    <input type="email" name="email" class="form-control form-control-lg" value="<?php echo isset($email) ? $email : ''; ?>" required />
    <label class="form-label" >Email</label>
  </div>
  <div class="form-outline mb-4">
    <input type="number" name="phone" class="form-control form-control-lg" value="<?php echo isset($phone) ? $phone : ''; ?>" required/>
    <label class="form-label" >Telefon</label>
  </div>
  <div class="form-outline mb-4">
    <input type="text" name="address" class="form-control form-control-lg" value="<?php echo isset($address) ? $address : ''; ?>" required/>
    <label class="form-label" >Adresa</label>
  </div>
  <div class="form-outline mb-4">
    <input type="text" name="city" class="form-control form-control-lg" value="<?php echo isset($city) ? $city : ''; ?>" required/>
    <label class="form-label" >Město</label>
  </div>
  <div class="form-outline mb-4">
    <input type="text" name="state" class="form-control form-control-lg" value="<?php echo isset($state) ? $state : ''; ?>" required/>
    <label class="form-label" >Země</label>
  </div>
  <div class="form-outline mb-4">
    <input type="password" name="password" class="form-control form-control-lg" value="<?php echo isset($password) ? $password : ''; ?>" required/>
    <label class="form-label">Heslo</label>
  </div>
  <div class="form-outline mb-4">
    <input type="password"  name="passwordConfirm" class="form-control form-control-lg" value="<?php echo isset($passwordConfirm) ? $passwordConfirm : ''; ?>" required/>
    <label class="form-label" >Potvrdit heslo</label>
  </div>


 
<?php if(!empty($alerts)): ?>
   <div class="errors">
<?php foreach($alerts as $alert): ?>
            <div class="error"><?php echo $alert; ?></div>
        <?php endforeach; ?>
</div>
<?php endif; ?>


  <div class="pt-1 mb-4">
    <button class="btn btn-dark btn-lg btn-block" type="submit">Zaregistrovat se</button>
  </div>

  
  
</form>

</div>
          
          
        </div>
</div>

</div>
</main>
<?php require __DIR__ . '/includes/footer.php';?>