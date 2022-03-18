<?php
require './utils.php';

$errors = [];
if (!empty($_POST)) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cPassword = $_POST['cPassword'];

    if (!preg_match("/^[a-zA-Z -.]{2,}$/", $name)) {
        array_push($errors, 'Invalid name');
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, 'Invalid email');
    }
    if (strlen($password) < 3) {
        array_push($errors, 'Password must be at least 3 characters long');
    }
    if (strcmp($password, $cPassword) !== 0) {
        array_push($errors, 'Both passwords need to match');
    }
    if(getUser($email)){
        array_push($errors, 'A user with this email already exists');
    }
    if (!count($errors)) {
        registerNewUser($name, $email, $password);
        header("Location: ./login.php?ref=register&email=$email");
        exit();
    }

}
