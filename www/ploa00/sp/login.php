<?php

require __DIR__ . '/utils/not-logged.php';

$pageName = 'BookInPrague | Login';


if (!empty($_POST)) {
  $email = $_POST['email'];
  $password = $_POST['password'];

  require_once __DIR__ . '/db/user-db.php';

  $userDB = new UserDB();
  $existingUser = $userDB->fetchByEmail($email);

  if ($existingUser == '') {
    $wrongCred = 'User does not exist';
  } else if (password_verify($password, $existingUser['password'])) {
    $_SESSION['user'] = [
      'user_id' => $existingUser['user_id'],
      'name' => $existingUser['name'],
    ];
    $_SESSION['LAST_ACTIVITY'] = time();

    header('Location: index.php');
    exit();
  } else {
    $wrongCred = 'Wrong credentials';
  }
}
?>

<?php require __DIR__ . '/incl/head.php' ?>


<main>
  <h1>Přihlášení</h1>

  <form class="my-5 mx-auto" method="POST">
    <?php if (isset($wrongCred)) : ?>
      <p class="text-danger"><?php echo $wrongCred; ?></p>
    <?php endif ?>
    <div class="mb-3">
      <label class="form-label" for="email">Email</label>
      <input class="form-control" type="email" name="email" value="<?php echo isset($email) ? $email : '' ?>" required>
    </div>
    <div class="mb-3">
      <label class="form-label" for="password">Heslo</label>
      <input class="form-control" type="password" name="password" value="<?php echo isset($password) ? $password : '' ?>" required>
    </div>
    <button class="btn btn-primary m-3" type="submit">Login</button>
  </form>
</main>


<?php require __DIR__ . '/incl/foot.php' ?>