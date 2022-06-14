<?php 
if(!isset($_SESSION)) { 
        session_start(); 
} 
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="background-color: #7aa5d2;">
<div class="container">
      
  <div class="collapse navbar-collapse" id="navbarsExample09">
    <ul class="navbar-nav mr-auto">
    <?php if(!isset($_SESSION['loggedin'])) : ?>  
      <li class="nav-item active">
        <a class="nav-link" style="color: white;" href="index.php">Zoonation<span class="sr-only"></span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="login.php">Přihlásit se</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="signup.php">Registrovat se</a>
      </li>
    <?php endif; ?>

    <?php if($_SESSION['loggedin']) : ?>
      <li class="nav-item">
        <a class="nav-link" href="animals.php">Přehled zvířat</a>
      </li>
      <?php if($_SESSION['user_isAdmin']) : ?>
        <li class="nav-item">
          <a class="nav-link" href="users.php">Přehled uživatelů</a>
        </li>
      <?php endif; ?>
      <li class="nav-item">
        <a class="nav-link" href="profile.php"><?php echo $_SESSION['user_firstName'] . ' ' . $_SESSION['user_lastName'];?></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="signout.php">Odhlásit se</a>   
      </li>
    <?php endif; ?>
            
    </ul>
  </div>
</div>
</nav>
