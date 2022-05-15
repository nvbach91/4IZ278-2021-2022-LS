<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo isset($pageName) ? $pageName : 'EventsBox'; ?></title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link href="./public/css/style.css" rel="stylesheet">
</head>

<body class="d-flex flex-column min-vh-100">
  <header class="my-1 mx-4 d-flex justify-content-between align-items-center">
    <a href="index.php" class="fs-1">Events<b>Box</b></a>
    <nav class="fs-5 d-flex justify-content-between align-items-center gap-3">
      <a href="index.php">Home</a>
      <a href="events.php">Events</a>
      <?php if (isset($user)) : ?>
        <?php if ($user['privilege'] >= 2) : ?>
          <a href="users.php">Users</a>
        <?php endif; ?>
        <a href="profile.php">Profile</a>
        <a href="logout.php">Logout</a>
      <?php else : ?>
        <a href="register.php">Register</a>
        <a href="login.php">Login</a>
      <?php endif; ?>
    </nav>
  </header>

  <main class="m-5">