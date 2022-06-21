<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo isset($pageName) ? $pageName : 'BookInPrague'; ?></title>

  <link rel="stylesheet" href="css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body class="d-flex flex-column min-vh-100">
  <header class="py-1 px-4 d-flex justify-content-between align-items-center">
    <a href="index.php" class="fs-1">Book<b>In</b>Prague</a>
    <span></span>
    <nav class="fs-5 gap-3">
      <a href="index.php">Úvodní stránka</a>
      <a href="property-list.php">Seznam ubytování</a>
      <?php if (isset($user)) : ?>
        <a href="profile.php">Profile</a>
        <a href="favourites-list.php">Zajímavé ubytování</a>
        <a href="logout.php">Odhlásit se</a>
      <?php else : ?>
        <a href="login.php">Přihlasít se</a>
        <a href="registration.php">Registrovát se</a>
      <?php endif; ?>
    </nav>
  </header>