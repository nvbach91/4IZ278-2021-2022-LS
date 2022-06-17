<?php

require __DIR__ . '/util/is-not-logged.php';

$pageName = 'EventsBox | Login';


if (!empty($_POST)) {
  $email = $_POST['email'];
  $password = $_POST['password'];

  require_once __DIR__ . '/db/users-db.php';

  $userDB = new UsersDB();
  $existingUser = $userDB->fetchByEmail($email);

  $email = $_POST['email'];
  $password = $_POST['password'];

  if ($existingUser == '') {
    $wrongCred = 'User does not exist';
  } else if (password_verify($password, $existingUser['password'])) {
    $_SESSION['user'] = [
      'id' => $existingUser['id'],
      'name' => $existingUser['name'],
      'privilege' => $existingUser['privilege']
    ];
    $_SESSION['LAST_ACTIVITY'] = time();

    header('Location: events.php');
    exit();
  } else {
    $wrongCred = 'Wrong credentials';
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
  <h1>Login</h1>

  <?php if (isset($_GET['ref']) && $_GET['ref'] === 'reg') : ?>
    <div class="mt-5 p-3 bg-success text-white">
      Your registration was successful, you can log in now.
    </div>
  <?php endif ?>

  <form class="my-5 mx-auto" method="POST">
    <?php if (isset($wrongCred)) : ?>
      <p class="text-danger"><?php echo $wrongCred; ?></p>
    <?php endif ?>
    <div class="mb-3">
      <label class="form-label" for="email">Email</label>
      <input class="form-control" type="email" name="email" value="<?php echo isset($email) ? $email : '' ?>" required>
    </div>
    <div class="mb-3">
      <label class="form-label" for="password">Password</label>
      <input class="form-control" type="password" name="password" value="<?php echo isset($password) ? $password : '' ?>" required>
    </div>
    <button class="btn btn-primary m-3" type="submit">Login</button>
    <a href="<?php echo htmlspecialchars($loginUrl); ?>">Use FaceBook</a>
  </form>
</main>


<?php require __DIR__ . '/comp/foot.php' ?>