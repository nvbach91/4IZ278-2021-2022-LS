<?php
$res = $usersDB->fetchByEmail($email);
$user = $res->fetchAll()[0];
$id = $user['user_id'];

$_SESSION['fb_user_id'] = $id;
$_SESSION['user_first_name'] = $firstName;
$_SESSION['user_last_name'] = $lastName;
$_SESSION['user_email'] = $email;
$_SESSION['user_privilege'] = $user['privilege'];