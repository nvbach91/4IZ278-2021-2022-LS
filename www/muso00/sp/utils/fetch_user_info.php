<?php
$id = intval($_SESSION['user_id']);
$usersDB = new UsersDB();

$res = $usersDB->fetchById($id);
$userInfo = $res->fetchAll()[0];

$firstName = $userInfo['first_name'];
$lastName = $userInfo['last_name'];
$phone = $userInfo['phone'];
$email = $userInfo['email'];
$city = $userInfo['city'];
$street = $userInfo['street'];
$postalCode = $userInfo['postal_code'];
