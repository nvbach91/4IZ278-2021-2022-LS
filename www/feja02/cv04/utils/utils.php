<?php

function authenticate($email, $password) {
    $userData = fetchUser($email);
    if ($userData === NULL) {
        return "A user with this email does not exist";
    }
    elseif (!password_verify($password, $userData["passwordHash"])) {
        return "Incorrect password";
    }
    else {
        return true;
    }
}

function databaseExists() {
    return file_exists(dirname(__DIR__) . "/database/users.db");
}

function fetchUsers() {
    if (!databaseExists()) {
        return null;
    }
    $users = [];
    if (($handle = fopen(dirname(__DIR__) . "/database/users.db", "r")) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $userInfo["name"] = $data[0];
            $userInfo["email"] = $data[1];
            $userInfo["passwordHash"] = $data[2];
            $userInfo["dateRegistered"] = $data[3];
            array_push($users, $userInfo);
        }
        fclose($handle);
    }
    else {
        return null;
    }
    return $users;
}

function fetchUser($email) {
    if (!databaseExists()) {
        return null;
    }
    if (($users = fetchUsers()) !== null) {
        foreach ($users as $user) {
            if ($user["email"] === $email){
                return $user;
            }
        }
    }
    return null;
}

function registerNewUser($name, $email, $password) {
    if (!databaseExists()) {
        die("The database folder does not exist");
    }
    if (($handle = fopen(dirname(__DIR__) . "/database/users.db", "a")) !== FALSE) {
        fputcsv($handle, array($name, $email, password_hash($password, PASSWORD_DEFAULT), date("Y-m-d h:i:s")));
        fclose($handle);
        mail($email, "Successful registration", "Your registration was successful!\n\nName: $name\nEmail: $email\nPassword: $password");
    }
    else {
        die("Failed to open the database file");
    }
}

?>