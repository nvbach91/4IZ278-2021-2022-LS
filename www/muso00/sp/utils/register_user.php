<?php
$usersDB = new UsersDB();
$res = $usersDB->fetchByEmail($email);

// if the user is not found in the DB
if ($res->rowCount() == 0) {
    // set existing user null
    $existingUser = null;
    // else...
} else {
    // fetch all user information.
    $existingUser = $res->fetchAll()[0]; //FIXME: nepotřebuji přinést to info ne?
}

// if the validation is successfull, and...
if (!count($errors)) {
    // if no user was found, then...
    if (is_null($existingUser)) {
        // register new user
        $usersDB->create(['email' => $email, 'firstName' => $firstName, 'lastName' => $lastName, 'password' => $hashedPasswd]);
        // redirect to sign in page
        sendEmail($email, 'Registration confirmation');
        header("Location: signin.php?ref=$ref&email=$email");
        exit();
        // else...
    } else {
        // display error.
        array_push($errors, 'User with this email already registered!');
    }
}
