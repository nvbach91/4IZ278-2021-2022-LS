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
//var_dump($fbEmail);
if (isset($fbEmail)) { 
    $userDB = new UserDB();

    $existingUserArr = $userDB->fetchByEmail($fbEmail);
    //var_dump($existingUserArr);
    if(!empty($existingUserArr)){
        
        $existingUser = $userDB->fetchByEmail($fbEmail)[0];
        var_dump($existingUser);

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        setcookie("user_id", $existingUser['user_id'], time()+3600);
        setcookie("email", $existingUser['email'], time()+3600);
        setcookie("privilege", $existingUser['privilege'], time()+3600);

        // $_SESSION['user_id'] = $existingUser['user_id'];
        // $_SESSION['email'] = $existingUser['email'];
        // $_SESSION['privilege'] = $existingUser['privilege'];

        header('Location: ../index.php?success=1');
    } else {

        $args=[
            'email'=>$fbEmail,
            'hashedPassword'=>"fromFB",
            'privilege'=>$privilege
            ];
        $userDB->create($args);

        $newUserFromFB = $userDB->fetchMaxId()[0];

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        setcookie("user_id", $newUserFromFB['user_id'], time()+3600);
        setcookie("email", $newUserFromFB['email'], time()+3600);
        setcookie("privilege", $newUserFromFB['privilege'], time()+3600);

        // $_SESSION['user_id'] = $newUserFromFB['user_id'];
        // $_SESSION['email'] = $newUserFromFB['email'];
        // $_SESSION['privilege'] = $newUserFromFB['privilege'];

        header('Location: ../index.php?success=1');
    }
    exit;
}

?> 