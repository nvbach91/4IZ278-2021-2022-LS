<?php
session_start();
require "../database/database.php";
require "../database/usersdb.php";

$errorList = [];

if (!empty($_POST)) {
    $email = filter_var($_POST["email"], FILTER_SANITIZE_STRING);
    $password = $_POST["password"];
    $passwordConfirm = $_POST["passwordConfirm"];
    $terms = $_POST["terms"];

    $usersDb = new UsersDB();
    $user = $usersDb->fetchByEmail($email)[0];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) array_push($errorList, "Invalid e-mail");
    if (is_array($user)) array_push($errorList, "E-mail already in use");
    if (strlen($password) < 8) array_push($errorList, "Password too short (min. 8 characters)!");
    if ($password!=$passwordConfirm) array_push($errorList, "Password confirmation doesn't match");

    if (empty($errorList)) {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $usersDb->create(["email" => $email, "password" => $passwordHash]);
        mail($email, "Successful registration", "Your registration was successful!\n\nEmail: $email\nPassword: $password");
        $_SESSION["reg_email"] = null;
        $_SESSION["errorList"] = null;
        header("Location: ../login?reg=1&email=" . $email);
        exit();
    }
    else {
        $_SESSION["errorList"] = $errorList;
        $_SESSION["reg_email"] = $email;
    }
}

header("Location: ../register");
?>
