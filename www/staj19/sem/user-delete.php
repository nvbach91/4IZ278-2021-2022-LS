<?php

require __DIR__ . '/util/is-admin.php';

$userId = $_GET['userId'];

if (isset($userId) && $userId != $_SESSION['user']['id']) {
  require_once __DIR__ . '/db/users-db.php';

  $userDB = new UsersDB();
  $existingUser = $userDB->deleteRow($userId);
}


header('Location: users.php');
exit();
