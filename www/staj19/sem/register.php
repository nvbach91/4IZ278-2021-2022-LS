<?php

require __DIR__ . '/util/is-not-logged.php';

$pageName = 'EventsBox | Register';


if (!empty($_POST)) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];

  require __DIR__ . '/validate/validate.php';
  $validate = new Validate();

  $err['name'] = $validate->name($name);
  $err['email'] = $validate->email($email);
  $err['password'] = $validate->password($password);

  $err = array_filter($err, function ($value) {
    return !is_null($value) && $value !== '';
  });


  if (empty($err)) {
    require_once __DIR__ . '/db/users-db.php';

    $userDB = new UsersDB();
    $existingUser = $userDB->fetchByEmail($email);

    if ($existingUser) {
      $wrongCred = 'Email is in use';
    } else {
      $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
      $userDB->insertRow($email, $name, $hashedPassword);
      mail($email, 'Registration Success', "Hello $name, your registration in EventsBox was successful!");
      header('Location: login.php?ref=reg');
      exit();
    }
  }
}


require __DIR__ . '/fb-login/cred.php';
require_once __DIR__ . '/vendor/autoload.php';

use \Facebook\Facebook;

$fb = new Facebook([
  'app_id' => APP_ID,
  'app_secret' => APP_SECRET,
  'default_graph_version' => DEFAULT_GRAPH_VERSION,
]);

$helper = $fb->getRedirectLoginHelper();
$permissions = ['email'];
$loginUrl = @$helper->getLoginUrl('https://eso.vse.cz/~staj19/sem/fb-login/fb-login-callback.php', $permissions);
?>

<?php require __DIR__ . '/comp/head.php' ?>

<main>
  <h1>Register</h1>

  <form class="my-5 mx-auto" method="POST">
    <?php if (isset($wrongCred)) : ?>
      <p class="text-danger"><?php echo $wrongCred; ?></p>
    <?php endif ?>
    <div class="mb-3">
      <label class="form-label" for="name">Name</label>
      <input class="form-control<?php echo (isset($err) && isset($err['name'])) ? ' border border-danger' : '' ?>" type="text" name="name" value="<?php echo isset($name) ? $name : '' ?>" required>
      <?php if (isset($err) && isset($err['name'])) : ?>
        <small class="text-danger"><?php echo $err['name'] ?></small>
      <?php endif ?>
    </div>
    <div class="mb-3">
      <label class="form-label" for="email">Email</label>
      <input class="form-control<?php echo (isset($err) && isset($err['email'])) ? ' border border-danger' : '' ?>" type="email" name="email" value="<?php echo isset($email) ? $email : '' ?>" required>
      <?php if (isset($err) && isset($err['email'])) : ?>
        <small class="text-danger"><?php echo $err['email'] ?></small>
      <?php endif ?>
    </div>
    <div class="mb-3">
      <label class="form-label" for="password">Password</label>
      <input class="form-control<?php echo (isset($err) && isset($err['password'])) ? ' border border-danger' : '' ?>" type="password" name="password" value="<?php echo isset($password) ? $password : '' ?>" required>
      <?php if (isset($err) && isset($err['password'])) : ?>
        <small class="text-danger"><?php echo $err['password'] ?></small>
      <?php endif ?>
    </div>
    <button class="btn btn-primary m-3" type="submit">Register</button>
    <a href="<?php echo htmlspecialchars($loginUrl); ?>">Use FaceBook</a>
  </form>
</main>


<?php require __DIR__ . '/comp/foot.php' ?>