<?php
function fetchUsers()
{
    $users = [];
    $userRecords =  explode(PHP_EOL, file_get_contents(dirname(__DIR__) . '/database/users.db'));

    foreach ($userRecords as $userRecord) {
        $user = explode(';', $userRecord);
        if (count($user) > 2) {
            $userInfo['name'] = $user[0];
            $userInfo['email'] = $user[1];
            $userInfo['password'] = $user[2];
            array_push($users, $userInfo);
        }
    }
    return $users;
}

function fetchUser($email)
{
    $users = fetchUsers();
    foreach ($users as $user) {
        if ($user['email'] === $email) {
            return $user;
        }
    }
    return null;
}

function registerNewUser($name, $email, $password)
{
    //$users = fetchUsers();

    /*if (fetchUser($email)) {
        array_push($errors, "A user with this email ($email) is already registered! Choose different email.");
    }*/

    $userRecord = implode(';', [$name, $email, $password]);
    file_put_contents(dirname(__DIR__) . '/database/users.db', $userRecord . PHP_EOL, FILE_APPEND);
    mail($email, 'Successful registration', "Name: $name \n Username: $email \n Password: $password");
}

function authenticate($email, $password)
{
    $user = fetchUser($email);

    if (!$user) {
        return "*User with the email $email was not found. Please register first.";
    } else if (strcmp($user['password'], $password) !== 0) {
        return "*Invalid password.";
    } 
    return true;
}
