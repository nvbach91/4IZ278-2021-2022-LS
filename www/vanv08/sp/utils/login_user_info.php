<?php

$id = $_SESSION['user_id'];
$usersDB = new UsersDB();
$result = $usersDB->fetchById($id);
$userInfo = $result->fetchAll()[0];
$first_name = $userInfo['first_name'];
$last_name = $userInfo['last_name'];
$phone = $userInfo['phone'];
$email = $userInfo['email'];
$city = $userInfo['city'];
$street = $userInfo['street'];
$postalCode = $userInfo['postal'];

$full_name = $userInfo['first_name'] . '' . $last_name = $userInfo['last_name'];
?>
