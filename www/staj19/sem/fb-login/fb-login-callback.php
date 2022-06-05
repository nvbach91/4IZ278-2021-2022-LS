<?php

require __DIR__ . '/cred.php';
require_once __DIR__ . '/../vendor/autoload.php';

use \Facebook\Facebook;
use \Facebook\Exceptions\FacebookResponseException;



if (!empty($_GET) && isset($_GET['code'])) {
  $code = $_GET['code'];

  $fb = new Facebook([
    'app_id' => APP_ID,
    'app_secret' => APP_SECRET,
    'default_graph_version' => DEFAULT_GRAPH_VERSION,
  ]);

  $helper = $fb->getRedirectLoginHelper();

  $helper->getPersistentDataHandler()->set('state', $_GET['state']);

  try {
    $accessToken = $helper->getAccessToken();
  } catch (FacebookResponseException $e) {
    Header('Location: ../register.php?ref=err');
  }

  if ($accessToken->getValue()) {
    $token = $accessToken->getValue();

    $user = $fb->get('/me?fields=name,email', "{$token}")->getGraphUser();

    $name = $user->getName();
    $email = $user->getEmail();

    if (isset($name) && isset($email)) {
      require_once __DIR__ . '/../db/users-db.php';

      $userDB = new UsersDB();
      $existingUser = $userDB->fetchByEmail($email);

      if ($existingUser === '') {
        $existingUser = $userDB->insertRow($email, $name, password_hash(random_bytes(20), PASSWORD_DEFAULT));
      }

      session_start();

      $_SESSION['user'] = [
        'id' => $existingUser['id'],
        'name' => $existingUser['name'],
        'privilege' => $existingUser['privilege']
      ];
      $_SESSION['LAST_ACTIVITY'] = time();

      Header('Location: ../events.php');
      exit;
    }
  }
  Header('Location: ../register.php?ref=err');
}
