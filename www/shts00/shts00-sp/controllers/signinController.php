<?php require_once __DIR__ . '/../db/UserDB.php'; ?>

<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
//setcookie("test", "test", time()+3600);
if(!empty($_POST)){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $usersDB = new UserDB();
    $user = $usersDB->fetchByEmail($email)[0];

    if (password_verify($password,$user['password'])){
        // $_SESSION['user_id'] = $user['user_id'];
        // $_SESSION['user_email'] = $user['email'];
        // $_SESSION['user_privilege'] = $user['privilege'];

        setcookie("user_id", $user['user_id'], time()+3600);
        setcookie("email", $user['email'], time()+3600);
        setcookie("privilege", $user['privilege'], time()+3600);


        if($_COOKIE['privilege'] == 'admin') {
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