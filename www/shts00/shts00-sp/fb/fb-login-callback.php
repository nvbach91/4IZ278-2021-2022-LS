<?php 
session_start();

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/../db/UserDB.php';


$fb = new \Facebook\Facebook([
    'app_id' => '1489720384831966',
    'app_secret' => '2894a6bdb7df06d79e0089db72618f91',
    'default_graph_version' => 'v2.10',
    //'default_access_token' => '1415ab4d6ca1cf59da671c6f7ad3f7cc', // optional
  ]);

$helper = $fb->getRedirectLoginHelper();

$accessToken;
$success = '';
$messageFail = '';

try{
    $accessToken = $helper->getAccessToken();
} catch (Exception $e){
    echo "Přihlášení pomocí Facebooku selhalo. Chyba: " . $e->getMessage();
    exit();
}

if (!$accessToken){
    exit();
}

$oAuth2Client = $fb->getOAuth2Client();

$accessTokenMetadata = $oAuth2Client->debugToken($accessToken);

$fbUserId = $accessTokenMetadata->getUserId();

$response=$fb->get('/me?fields=email', $accessToken);
$graphUser=$response->getGraphUser();

$fbEmail=$graphUser->getEmail();

$privilege = "user";
$userDB = new UserDB();

$user = $userDB->fetchByEmail($fbEmail)[0];

$_SESSION['user_id'] = $user['user_id'];
$_SESSION['email'] = $user['email'];
$_SESSION['privilege'] = $user['privilege'];

header('Location: ../index.php');

?> 