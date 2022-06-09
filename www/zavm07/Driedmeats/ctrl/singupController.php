<?php require '../db/Database.php' ?>
<?php require '../db/UsersDB.php' ?>
<?php

session_start();
$errorMsq = [];
$errorValues = [];

if (!empty($_POST)) {
    $err = [];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];
    $phone = $_POST['phone'];
    $f_name = $_POST['f_name'];
    $s_name = $_POST['s_name'];

    $UsersDB = new UsersDB();
    $existingUser = $UsersDB->fetchById($email)[0];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        array_push($errorMsq,'Zadejte platný formát emailu');
        array_push($errorValues,'email');
    }

    if(sizeof($existingUser)!== 0){
        array_push($errorMsq,'Tento uživatel již existuje');
        array_push($errorValues,'email');
    }


    if($password!=$password2){
        array_push($errorMsq,'Hesla se neshodují');
        array_push($errorValues,'password');
    }

    if(strlen($password)< 8){
        array_push($errorMsq,'Heslo musí obsahovat minimálně 8 znaků');
        array_push($errorValues,'password');
    }

    if (!preg_match('/^(\+\d{3} ?)?(\d{3} ?){3}$/', $phone)){
        array_push($errorMsq,'Zadejte platný formát telefoního čísla');
        array_push($errorValues,'phone');
    }

    if(strlen($f_name)< 1){
        array_push($errorMsq,'Zadejte prosím své jméno');
        array_push($errorValues,'f_name');
    }

    if(strlen($s_name)< 1){
        array_push($errorMsq,'Zadejte prosím své příjmení');
        array_push($errorValues,'s_name');
    }

        if (sizeof($errorValues)===0){
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $usersDB = new UsersDB();
            $usersDB->create([$email, $hashedPassword, $phone, $f_name, $s_name]);
            $_SESSION['su_values'] = [];
            $_SESSION['su_errorMsg'] = [];
            $_SESSION['su_errorValues'] = [];
            header('Location: ../login.php?reg=1');
            exit();
        }

    else{
        $_SESSION['su_values'] = $_POST;
        $_SESSION['su_errorMsg'] = $errorMsq;
        $_SESSION['su_errorValues'] = $errorValues;
        header('Location: ../signup.php');
        exit();
    }

}
?>
