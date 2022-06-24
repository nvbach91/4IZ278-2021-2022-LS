<?php

require __DIR__ . '/utils/logged.php';

$pageName = 'BookInPrague | Edit Profile';

require_once __DIR__ . '/db/user-db.php';
$userDB = new UserDB();
$existingUser = $userDB->fetchById($user['user_id']);

$name = $existingUser['name'];
$surname = $existingUser['surname'];
$email = $existingUser['email'];
$phone = $existingUser['phone'];

if (!empty($_POST)) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];

  if ($password == null) {
    $hashedPassword = $existingUser['password'];
  }

  require __DIR__ . '/utils/validation.php';
  $validate = new Validate();

  $err['name'] = $validate->name($name);
  $err['email'] = $validate->email($email);
  if (!isset($hashedPassword)) {
    $err['password'] = $validate->password($password);
  }

  array_filter($err, function ($value) {
    return !is_null($value) && $value !== '';
  });

  if (!empty($err)) {
    $userDB = new UserDB();
    $existingUser = $userDB->fetchByEmail($email);

    if ($existingUser && $existingUser['user_id'] != $user['user_id']) {
      $wrongCred = 'Email in use';
    } else {
      if (!isset($hashedPassword)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
      }
      $userDB->update($name, $surname, $email, $hashedPassword, $phone, $user['user_id']);
      header('Location: profile.php');
      exit();
    }
  }
}

?>

<?php require __DIR__ . '/incl/head.php'; ?>


<main>
  <h1>Profile</h1>

  <form class="my-5 mx-auto w-50" method="POST">
    <?php if (isset($wrongCred)) : ?>
      <p class="text-danger"><?php echo $wrongCred; ?></p>
    <?php endif ?>
    <div class="mb-3">
      <label class="form-label" for="name">Jmeno</label>
      <input class="form-control<?php echo (isset($err) && isset($err['name'])) ? ' border border-danger' : '' ?>" type="text" name="name" value="<?php echo isset($name) ? $name : '' ?>" required>
      <?php if (isset($err) && isset($err['name'])) : ?>
        <small class="text-danger"><?php echo $err['name'] ?></small>
      <?php endif ?>
    </div>
    <div class="mb-3">
      <label class="form-label" for="surname">Přijmení</label>
      <input class="form-control<?php echo (isset($err) && isset($err['surname'])) ? ' border border-danger' : '' ?>" type="text" name="surname" value="<?php echo isset($surname) ? $surname : '' ?>" required>
      <?php if (isset($err) && isset($err['surname'])) : ?>
        <small class="text-danger"><?php echo $err['surname'] ?></small>
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
      <label class="form-label" for="password">Heslo</label>
      <input class="form-control<?php echo (isset($err) && isset($err['password'])) ? ' border border-danger' : '' ?>" type="password" name="password" value="<?php echo isset($password) ? $password : '' ?>" required>
      <?php if (isset($err) && isset($err['password'])) : ?>
        <small class="text-danger"><?php echo $err['password'] ?></small>
      <?php endif ?>
    </div>
    <div class="mb-3">
      <label class="form-label" for="phone">Mobil</label>
      <input class="form-control<?php echo (isset($err) && isset($err['phone'])) ? ' border border-danger' : '' ?>" type="text" name="phone" value="<?php echo isset($phone) ? $phone : '' ?>" required>
      <?php if (isset($err) && isset($err['phone'])) : ?>
        <small class="text-danger"><?php echo $err['phone'] ?></small>
      <?php endif ?>
    </div>
    <button class="btn btn-primary m-3" type="submit">Uložít</button>
  </form>
</main>


<?php require __DIR__ . '/incl/foot.php'; ?>