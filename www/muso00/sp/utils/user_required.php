<?php
if (!isset($_SESSION['user_id']) && !isset($_SESSION['fb_access_token'])) {
    exit('<div class="alert alert-warning text-center" role="alert">You are not signed in. <a href="./signin.php" class="stretched-link link-warning">Sign In</a></div>');
}
