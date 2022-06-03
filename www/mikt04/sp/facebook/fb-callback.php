<?php if (session_status() !== PHP_SESSION_ACTIVE) session_start(); ?>

<?php 
// Session set
if (isset($_SESSION['user_id'])) {
  $userId = $_SESSION['user_id'];
}

require_once '../database/UsersDB.php';
require_once './facebook.php';

$fbHelper = $fb->getRedirectLoginHelper();
$accessToken;
$messageSuccess = '';
$messageFail = '';
$valid = TRUE;

try{
    $accessToken = $fbHelper->getAccessToken();
} catch (Exception $e){
    echo "Přihlášení pomocí Facebooku selhalo. Chyba: " . $e->getMessage();
    exit();
}

if (!$accessToken){
    exit('Přihlášení pomocí Facebooku se nezdařilo. Zkuste to znovu.');
}

$oAuth2Client = $fb->getOAuth2Client();

//získáme údaje k tokenu, který jsme získali z přihlášení
$accessTokenMetadata = $oAuth2Client->debugToken($accessToken);

//získáme ID uživatele z Facebooku
$fbUserId = $accessTokenMetadata->getUserId();

//získáme jméno a e-mail uživatele
$response=$fb->get('/me?fields=name,email', $accessToken);
$graphUser=$response->getGraphUser();

$fbUserEmail=$graphUser->getEmail();
$fbUserName=$graphUser->getName();
$firstName = '';
$lastName = '';


$parts = explode(" ", $fbUserName);
if(count($parts) > 1) {
    $lastName = array_pop($parts);
    $firstName = implode(" ", $parts);
}
else
{
    $firstName = $fbUserName;
    $lastName = " ";
}

$normalPrivilage = 1;
date_default_timezone_set('Europe/Prague');
$date = date('Y-m-d H:i:s', time());
$usersDB = new UsersDB();

$user = $usersDB->fetchByEmail($fbUserEmail);

if(strlen($user['email']) > 0){
    echo "email existuje";
} else {
    $inserted = $usersDB->insertFacebook($firstName, $lastName, $fbUserEmail, $date, $normalPrivilage, $fbUserId);
}

//přihlásíme uživatele (uložíme si jeho údaje do session)
$_SESSION['user_id'] = $user['user_id'];
$_SESSION['email'] = $user['email'];
$_SESSION['privilege'] = $user['privilege'];
setcookie('email', $user['email'], time() + 3600);
//přesměrujeme uživatele na homepage
header('Location: ../index.php');


?>