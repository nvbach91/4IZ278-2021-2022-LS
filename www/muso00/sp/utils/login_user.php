<?php

$usersDB = new UsersDB();
$res = $usersDB->fetchByEmail($email);

if ($res->rowCount() == 0) {
    $existingUser = null;
} else {
    $existingUser = $res->fetchAll()[0];
}

if (!count($errors)) {
    if (!is_null($existingUser)) {
        if (password_verify($password, $existingUser['password'])) {
            $_SESSION['user_id'] = $existingUser['user_id'];
            $_SESSION['user_email'] = $existingUser['email'];
            $_SESSION['user_first_name'] = $existingUser['first_name'];
            $_SESSION['user_privilege'] = $existingUser['privilege'];
            header('Location: ./profile.php');
            exit();
        } else {
            array_push($errors, "Invalid password");
        }
    } else {
        array_push($errors, 'Invalid username');
    }
}
