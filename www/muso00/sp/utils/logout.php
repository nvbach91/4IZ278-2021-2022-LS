<?php 
session_start();

if (isset($_SESSION['user_id'])) {
session_destroy();
header('Location: ../index.php');
exit();
} else {
    exit('<div class="alert alert-warning text-center" role="alert">You are not signed in. <a href="./signin.php" class="stretched-link link-warning">Sign In</a></div>');
}

?>