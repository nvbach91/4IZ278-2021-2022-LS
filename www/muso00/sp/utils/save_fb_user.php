<?php
require '../db/UsersDB.php';
$usersDB = new UsersDB();
$res = $usersDB->fetchByEmail($email);
if ($res->rowCount() == 0) {
    $usersDB->create(['email' => $email, 'firstName' => $firstName, 'lastName' => $lastName, 'password' => '']);
}