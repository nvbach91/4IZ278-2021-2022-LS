<?php


function getUsers()
{
  $users = [];
  $file = file_get_contents(dirname(__DIR__) . '/users.db');
  $lines = explode(PHP_EOL, $file);
  foreach ($lines as $line) {
    $user = explode(';', $line);
    if (count($user) > 2) {
      $temp['name'] = $user[0];
      $temp['email'] = $user[1];
      $temp['password'] = $user[2];
      array_push($users, $temp);
    }
  }
  return $users;
}


function getUser($email)
{
  $file = file_get_contents(dirname(__DIR__) . '/users.db');
  $lines = explode(PHP_EOL, $file);
  foreach ($lines as $line) {
    $user = explode(';', $line);
    if (
      count($user) > 2
      && $user[1] == $email
    ) {
      $returnUser = [];
      $returnUser['name'] = $user[0];
      $returnUser['email'] = $user[1];
      $returnUser['password'] = $user[2];
      return $returnUser;
    }
  }
  return null;
}


function registerNewUser($name, $email, $password)
{
  if (getUser($email)) {
    return 'Email is in use';
  }

  $userRecord = implode(';', [$name, $email, $password]);
  file_put_contents('users.db', $userRecord . PHP_EOL, FILE_APPEND);
  mail($email, 'You are registered!', "Your name: $name");

  header("Location: login.php?ref=register&email=$email");
  exit();
}


function authenticate($email, $password)
{
  $user = getUser($email);

  if (!$user) {
    return 'Email not found';
  } else if ($user['password'] !== $password) {
    return 'Wrong password';
  }

  return true;
}
