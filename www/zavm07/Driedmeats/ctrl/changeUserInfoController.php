<?php session_start() ?>
<?php require '../db/Database.php' ?>
<?php require '../functions/userRequired.php' ?>
<?php

if(empty($_POST)){
    header('Location: ../changeUserInfo.php');
    exit();
}

$errorMsq = [];
$errorValues = [];
$changeCount = 0;

//values from form
$email = $_POST['email'];
$f_name = $_POST['f_name'];
$s_name = $_POST['s_name'];
$phone = $_POST['phone'];

//get current user
$UsersDB = new UsersDB();
$currentUser = $UsersDB->fetchById($_SESSION['lg_email'])[0];


//value filters
if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
    array_push($errorMsq,'Zadejte platný formát emailu');
    array_push($errorValues,'email');
}

if($email!=$_SESSION['lg_email']){
    //check, if new email isn't already used by another user
    if(!empty($UsersDB->fetchById($email)[0])){
        array_push($errorMsq,'Uživatel s tímto emailem již existuje');
        array_push($errorValues,'email');
    }
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

//header back and exit if invalid value
if (sizeof($errorValues)!=0){
    $_SESSION['cui_errorMsg'] = $errorMsq;
    $_SESSION['cui_errorValues'] = $errorValues;
    header('Location: ../changeUserInfo.php');
    exit();
}

//update values if changed
 if($currentUser['email']!=$email){
     //if update fails
     if (!$UsersDB->updateById($currentUser['user_id'],'email',$email)){
         array_push($errorMsq,'Něco se pokazilo, zkontrolujte své údaje a zkuste to prosím znovu');
         $_SESSION['cui_errorMsg'] = $errorMsq;
         header('Location: ../changeUserInfo.php');
         exit();
     }
     $changeCount += 1;
 }

if($currentUser['f_name']!=$f_name){
    if (!$UsersDB->updateById($currentUser['user_id'],'f_name',$f_name)){
        //if update fails
        array_push($errorMsq,'Něco se pokazilo, zkontrolujte své údaje a zkuste to prosím znovu');
        $_SESSION['cui_errorMsg'] = $errorMsq;
        header('Location: ../changeUserInfo.php');
        exit();
    }
    $changeCount += 1;
}

if($currentUser['s_name']!=$s_name){
    if (!$UsersDB->updateById($currentUser['user_id'],'s_name',$s_name)){
        //if update fails
        array_push($errorMsq,'Něco se pokazilo, zkontrolujte své údaje a zkuste to prosím znovu');
        $_SESSION['cui_errorMsg'] = $errorMsq;
        header('Location: ../changeUserInfo.php');
        exit();
    }
    $changeCount += 1;
}

if($currentUser['phone']!=$phone){
    if (!$UsersDB->updateById($currentUser['user_id'],'phone',$phone)){
        //if update fails
        array_push($errorMsq,'Něco se pokazilo, zkontrolujte své údaje a zkuste to prosím znovu');
        $_SESSION['cui_errorMsg'] = $errorMsq;
        header('Location: ../changeUserInfo.php');
        exit();
    }
    $changeCount += 1;
}

$_SESSION['cui_errorMsg'] = [];
$_SESSION['cui_errorValues'] = [];
header('Location: ../changeUserInfo.php?success='.$changeCount);






