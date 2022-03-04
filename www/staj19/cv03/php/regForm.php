<?php

$err = [];

if ($_POST) {
  $name = $_POST['name'];
  $gender = $_POST['gender'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $avatar = $_POST['avatar'];
  $deck = $_POST['deck'];
  $count = $_POST['count'];

  if (strlen($name) < 3) {
    $err['name'] = 'Invalid name';
  }

  if (!in_array($gender, ['O', 'F', 'M'])) {
    $err['gender'] = 'Invalid gender';
  }

  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $err['email'] = 'Invalid email';
  }

  if (!preg_match('/^(\+420)?\d{9}$/', $phone)) {
    $err['phone'] = 'Invalid phone number';
  }

  if ($avatar === '' || !filter_var($avatar, FILTER_VALIDATE_URL)) {
    $err['avatar'] = 'Invalid avatar URL';
  }

  if (strlen($deck) < 3) {
    $err['deck'] = 'Invalid deck name';
  }

  if ($count === '' || $count <= 0) {
    $err['count'] = 'Invalid deck count';
  }

  if (!count($err)) {
    $success = true;
  }
}

?>

<h1>Form validation using PHP</h1>
<?php if (isset($success)) : ?>
  <div class="success">
    <p>You have successfully signed up!</p>
  </div>
<?php endif; ?>
<form method="POST" action=".">
  <div <?php echo isset($err['name']) ? 'class="danger"' : ''; ?>>
    <label for="name">Name*</label>
    <input name="name" value="<?php echo isset($name) ? $name : ''; ?>">
    <?php if (isset($err['name'])) : ?>
      <small><?php echo $err['name']; ?></small>
    <?php endif; ?>
  </div>
  <div <?php echo isset($err['gender']) ? 'class="danger"' : ''; ?>>
    <label for="gender">Gender*</label>
    <select name="gender">
      <option value="O" <?php echo isset($gender) && $gender === 'O' ? 'selected' : ''; ?>>Other</option>
      <option value="M" <?php echo isset($gender) && $gender === 'M' ? 'selected' : ''; ?>>Male</option>
      <option value="F" <?php echo isset($gender) && $gender === 'F' ? 'selected' : ''; ?>>Female</option>
    </select>
    <?php if (isset($err['gender'])) : ?>
      <small><?php echo $err['gender']; ?></small>
    <?php endif; ?>
  </div>
  <div <?php echo isset($err['email']) ? 'class="danger"' : ''; ?>>
    <label for="email">Email*</label>
    <input name="email" value="<?php echo isset($email) ? $email : ''; ?>">
    <?php if (isset($err['email'])) : ?>
      <small><?php echo $err['email']; ?></small>
    <?php endif; ?>
  </div>
  <div <?php echo isset($err['phone']) ? 'class="danger"' : ''; ?>>
    <label for="phone">Phone number*</label>
    <input name="phone" value="<?php echo isset($phone) ? $phone : ''; ?>">
    <?php if (isset($err['phone'])) : ?>
      <small><?php echo $err['phone']; ?></small>
    <?php endif; ?>
  </div>
  <div <?php echo isset($err['avatar']) ? 'class="danger"' : ''; ?>>
    <label for="avatar">Avatar URL*</label>
    <input name="avatar" value="<?php echo isset($avatar) ? $avatar : ''; ?>">
    <?php if (isset($err['avatar'])) : ?>
      <small><?php echo $err['avatar']; ?></small>
    <?php endif; ?>
    <?php if (isset($avatar)) : ?>
      <img src="<?php echo $avatar; ?>" alt="avatar image">
    <?php endif; ?>
  </div>
  <div <?php echo isset($err['deck']) ? 'class="danger"' : ''; ?>>
    <label for="deck">Deck name*</label>
    <input name="deck" value="<?php echo isset($deck) ? $deck : ''; ?>">
    <?php if (isset($err['deck'])) : ?>
      <small><?php echo $err['deck']; ?></small>
    <?php endif; ?>
  </div>
  <div <?php echo isset($err['count']) ? 'class="danger"' : ''; ?>>
    <label for="count">Cards count*</label>
    <input name="count" value="<?php echo isset($count) ? $count : ''; ?>" type="number">
    <?php if (isset($err['count'])) : ?>
      <small><?php echo $err['count']; ?></small>
    <?php endif; ?>
  </div>
  <button type="submit">Submit</button>
</form>