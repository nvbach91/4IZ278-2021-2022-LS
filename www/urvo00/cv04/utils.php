<?php
function getUsers()
{
    $users = [];
    $userRecords =  explode(PHP_EOL, file_get_contents(dirname(__DIR__) . '/cv04/users.db'));
    foreach ($userRecords as $userRecord) {
        $user = explode(';', $userRecord);
        if (count($user) > 2) {
            $userArray['name'] = $user[0];
            $userArray['email'] = $user[1];
            $userArray['password'] = $user[2];
            array_push($users, $userArray);
        }
    }
    return $users;
}

function getUser($email)
{
    $users = getUsers();
    foreach ($users as $user) {
        if ($user['email'] === $email) {
            return $user;
        }
    }
    return null;
}

function registerNewUser($name, $email, $password)
{
    $userRecord = implode(';', [$name, $email, $password]);
    file_put_contents(dirname(__DIR__) . '/cv04/users.db', $userRecord . PHP_EOL, FILE_APPEND);
    mail($email, 'Registration', "$name registered successfully.");
}

function authenticate($email, $password)
{
    $user = getUser($email);

    if (!$user) {
        return 'email not found';
    } else if (strcmp($user['password'], $password) !== 0) {
        return 'wrong password';
    }
    return true;
}
