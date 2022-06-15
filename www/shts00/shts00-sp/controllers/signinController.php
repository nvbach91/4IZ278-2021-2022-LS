<?php require_once __DIR__ . '/../db/UserDB.php'; ?>

<?php

session_start();

if(!empty($_POST)){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $usersDB = new UserDB();
    $user = $usersDB->fetchByEmail($email)[0];

    if (password_verify($password,$user['password'])){
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['user_privilege'] = $user['privilege'];

        if($_SESSION['user_privilege'] == 'admin') {
            header('Location: ../adminPanel.php');
        } else {
            header('Location: ../index.php?success=1');
        }
        exit();
    }
    else{
        header('Location: ../signin.php?error=1');
    }
}

?> 