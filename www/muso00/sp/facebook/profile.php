<?php
session_start();
$title = 'Facebook User Profile';
?>
<?php

if (!isset($_SESSION['fb_access_token'])) {
    header('Location: index.php');
    exit();
}

require_once __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/config.php';

$fb = new \Facebook\Facebook(array_merge(CONFIG_FACEBOOK, ['default_access_token' => $_SESSION['fb_access_token']]));
try {
    $me = $fb->get('/me/?fields=name,email')->getGraphUser();
    $picture = $fb->get('/me/picture?redirect=false&height=200')->getGraphUser();
} catch (\Facebook\Exceptions\FacebookResponseException $e) {
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
} catch (\Facebook\Exceptions\FacebookSDKException $e) {
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}
$fullname = $me->getName();
$words = explode(" ", $fullname);
$firstName = $words[0];
$lastName = $words[1];
$email = $me->getEmail();

require '../utils/save_fb_user.php';
require '../utils/fetch_fb_user.php';
require '../db/OrdersDB.php';

?>

<?php require __DIR__ . '/incl/fb-head.php'; ?>
<?php require __DIR__ . '/incl/fb-nav.php'; ?>
<main>
    <h1 class="text-center mt-4">Facebook user profile</h1>
    <div class="container mx-auto mb-5 mt-5">
        <div class="row">
            <div class="col w-25">
                <div class="affix">
                    <div class="shadow rounded p-4">
                        <div class="row">
                            <div class="col text-center mb-3">
                                <img src="<?php echo $picture['url']; ?>" alt="profile-pic" class="rounded-circle shadow-sm img-responsive" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="row">
                                <h3 class="text-center"><?php echo $fullname; ?></h3>
                            </div>
                            <div class="row"><span class="text-center text-secondary"><?php echo $email; ?></span></div>
                        </div>
                        <div class="row mt-2 mx-auto w-50">
                            <a class="btn btn-danger mt-4" href="../utils/logout.php">Sign out</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4 w-75">
                <?php require '../components/orderDisplay.php'; ?>
            </div>
        </div>
    </div>
</main>
<?php require __DIR__ . '/incl/fb-foot.php'; ?>