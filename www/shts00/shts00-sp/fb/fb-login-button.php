<?php

require_once __DIR__ . '/vendor/autoload.php';

$fb = new \Facebook\Facebook([
    'app_id' => '1489720384831966',
    'app_secret' => '2894a6bdb7df06d79e0089db72618f91',
    'default_graph_version' => 'v2.10',
    //'default_access_token' => '1415ab4d6ca1cf59da671c6f7ad3f7cc', // optional
  ]);

$fbHelper = $fb->getRedirectLoginHelper();
$permissions = ['email'];
$callbackUrl = htmlspecialchars('https://eso.vse.cz/~shts00/shts00-sp/fb/fb-login-callback.php');
$fbLoginUrl = $fbHelper->getLoginUrl($callbackUrl, $permissions);
?>

<a href="<?php echo htmlspecialchars($fbLoginUrl); ?>" class="btn btn-link">Přihlášení přes Facebook</a> 


