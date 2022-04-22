<?php

if (session_status() !== PHP_SESSION_ACTIVE) session_start();

$logged = false;

if (isset($_SESSION['user_name'])) {
  $name = $_SESSION['user_name'];
  $privilege = $_SESSION['user_privilege'];
  $logged = true;
}

?>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
  <div class="container">
    <img src="https://www.lindt.cz/static/version1648441517/frontend/Lindt/nontransactional/cs_CZ/images/logo.png" alt="logo" style="width:100px;margin-right:5px;">
    <a class="navbar-brand" href="index.php">Lindor shop</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="cart.php">Cart</a>
        </li>
        <?php if (!$logged) { ?>
          <li class="nav-item">
            <a class="nav-link" href="login.php">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="register.php">Register</a>
          </li>
        <?php } else { ?>
          <li class="nav-item">
            <a class="nav-link" href="profile.php"><?php echo $name; ?></a>
          </li>
          <?php if ($privilege >= 2) { ?>
            <li class="nav-item">
              <a class="nav-link" href="new.php">New product</a>
            </li>
          <?php }; ?>
          <?php if ($privilege >= 3) { ?>
            <li class="nav-item">
              <a class="nav-link" href="users.php">Users</a>
            </li>
          <?php }; ?>
          <li class="nav-item">
            <a class="nav-link" href="logout.php">Logout</a>
          </li>
        <?php }; ?>
      </ul>
    </div>
  </div>
</nav>