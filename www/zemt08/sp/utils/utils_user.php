<?php
function getUser($userlogin, $con)
{
    $stmt = $con->prepare('SELECT * FROM users WHERE username = :username LIMIT 1');
    $stmt->execute([
        'username' => $userlogin
    ]);
    return @$stmt->fetchAll()[0];
}


function checkUser($username, $con)
{
    $stmt = $con->prepare('SELECT * FROM users WHERE username = :username LIMIT 1');
    $stmt->execute([
        'username' => $username
    ]);
    $user = @$stmt->fetchAll()[0];
    if ($user != "") {
        return true;
    }
    return false;
}

function checkEmail($email, $con)
{
    $stmt = $con->prepare('SELECT * FROM users WHERE email = :email LIMIT 1');
    $stmt->execute([
        'email' => $email
    ]);
    $user = @$stmt->fetchAll()[0];
    if ($user != "") {
        return true;
    }
    return false;
}

function checkPasswordStrength($password)
{
    if (preg_match('/[A-Z]/', $password) && strlen($password) >= 8) {
        return true;
    }
    return false;
}

function createUserFromGithub($id, $username, $email, $con)
{
    if ($email == "") {
        $email = "githubuser@gmail.com";
    }
    $statement = $con->prepare("INSERT INTO users(id,username,email) VALUES(:id, :username, :email)");
    $statement->execute([
        'id' => $id,
        'username' => $username,
        'email' => $email
    ]);
}
