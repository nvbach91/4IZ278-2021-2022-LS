<?php

session_start();
require_once( './vendor/autoload.php' );
require "../database/database.php";
require "../database/usersdb.php";

$fb = new Facebook\Facebook([
  'app_id' => '',
  'app_secret' => '',
  'default_graph_version' => 'v2.5',
]);  
  
$helper = $fb->getRedirectLoginHelper();  
  
try 
{  
  $accessToken = $helper->getAccessToken();  
} catch(Facebook\Exceptions\FacebookResponseException $e) {  
  // When Graph returns an error  
  
  echo 'Graph returned an error: ' . $e->getMessage();  
  exit;  
} catch(Facebook\Exceptions\FacebookSDKException $e) {  
  // When validation fails or other local issues  

  echo 'Facebook SDK returned an error: ' . $e->getMessage();  
  exit;  
}  


try 
{
  // Get the Facebook\GraphNodes\GraphUser object for the current user.
  $response = $fb->get('/me?fields=id,name,email,first_name,last_name', $accessToken->getValue());

} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'ERROR: Graph ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'ERROR: validation fails ' . $e->getMessage();
  exit;
}

$me = $response->getGraphUser();

$_SESSION["login_id"] = $me->getProperty("id");
$_SESSION["login_email"] = $me->getProperty("email");
$_SESSION["login_oauth"] = 1;
$_SESSION["login_role"] = "0";


header("Location: ../");
?>
