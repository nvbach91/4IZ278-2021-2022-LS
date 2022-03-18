<?php
require "User.php";

function authenticate($email, $password): bool
{
    $user = fetchUser($email);
    if (!$user || strcmp(pwdHash($password), $user['password']) !== 0)
        return false;
    return true;
}

function fetchUsers(): array
{
    $lines = explode("\n", file_get_contents('users.db'));

    $ret = [];
    foreach ($lines as $line) {
        $data = explode(';', $line);
        if (count($data) > 4) {
            $i = 0;

            $userArr["name"] = $data[$i++];
            $userArr["email"] = $data[$i++];
            $userArr["phone"] = $data[$i++];
            $userArr["avatar"] = $data[$i++];
            $userArr["password"] = $data[$i++];
            $userArr["cpack"] = $data[$i++];
            $userArr["n_cards"] = $data[$i];
            //$user = new User($data[0], $data[1], $data[2], $data[3], $data[4], $data[5]); Wanted to use this

            $ret[] = $userArr;
        }
    }
    return $ret;
}

function fetchUser($email)
{
    if (!file_exists("users.db"))
        return null;

    $allUsers = fetchUsers();

    foreach ($allUsers as $user)
        if ($user['email'] === $email)
            return $user;

    return null;
}

function pwdHash($pwdClearText)
{
    return hash("sha1", $pwdClearText);
}

function registerNewUser(User $user)
{
    $vars = [$user->name, $user->email, $user->phone, $user->avatar, $user->password, $user->cpack, $user->n_cards];
    $line = implode(";", $vars);
    file_put_contents("users.db", $line . "\n", FILE_APPEND);
    mail($user->email, "Registered for card tournament", "$user->name you had been successfully registered to tournament");
}