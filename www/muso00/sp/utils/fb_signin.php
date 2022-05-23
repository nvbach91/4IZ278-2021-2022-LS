<?php
if (isset($_SESSION['fb_access_token'])) {
    exit('<div class="alert alert-primary text-center" role="alert">You are already logged in through Facebook. <a href="./facebook/profile.php" class="stretched-link link-primary">View profile</a></div>');
}