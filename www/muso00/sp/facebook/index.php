<?php
require_once __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/config.php';

session_start();
$title = 'Facebook Log in';

$fb = new \Facebook\Facebook(CONFIG_FACEBOOK);

$helper = $fb->getRedirectLoginHelper();
$permissions = array('scope' => 'email'); // Optional permissions
$loginUrl = $helper->getLoginUrl(CONFIG_PROTOCOL . CONFIG_DOMAIN . CONFIG_PATH . '/fb-login-callback.php', $permissions);

?>
<?php require __DIR__ . '/incl/fb-head.php'; ?>
<?php require __DIR__ . '/incl/fb-nav.php'; ?>
<?php 
if (isset($_SESSION['fb_access_token'])) {
    exit('<div class="alert alert-info text-center" role="alert">You are already logged in through Facebook. <a href="./profile.php" class="stretched-link link-info">View profile</a></div>');
}

?>
<main class="container d-flex flex-column align-items-center justify-content-center flex-fill">
    <h1 class="mb-5">Facebook Log in</h1>
    <div class="container shadow rounded w-50 p-5">
        <div class="row mb-4">
            <a class="btn btn-primary w-50  mx-auto" href="<?php echo htmlspecialchars($loginUrl); ?>">Log in with Facebook</a>
        </div>
        <div class="row text-secondary">
            <hr />
        </div>
        <div class="row text-secondary text-center">
            <small>You will be redirected to Facebook to sign in. Once signed in you will come back to us.</small>
        </div>
    </div>
</main>
<?php require __DIR__ . '/incl/fb-foot.php'; ?>