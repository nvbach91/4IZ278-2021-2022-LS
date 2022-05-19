<?php
$passwdReq = '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,32}$/';

if (!preg_match($passwdReq, $password)) {
    array_push($errors, 'Invalid Password');
}

if ($password !== $confirm) {
    array_push($errors, 'The passwords do not match');
}