<?php
if (isset($_SESSION['user_id'])) {
    exit('<div class="alert alert-primary text-center" role="alert">You are already signed in. <a href="./profile.php" class="stretched-link link-primary">View account</a></div>');
}