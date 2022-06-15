<?php require_once __DIR__ . '/../db/UserDB.php'; ?>

<?php

session_start();
$errors = [];

if (!empty($_POST)) {

    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    $userDB = new UserDB();
    $existingUser = $userDB->fetchByEmail($email);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        array_push($errors,'Zadejte platnou emailovou adresu');
    }

    if(!empty($existingUser)){
        array_push($errors,'Uživatel s takovým loginem již existuje.');
    }

    if($password!=$confirmPassword){
        array_push($errors,'Hesla se neshodují.');
    }

    //Minimum eight characters, at least one uppercase letter, one lowercase letter and one number:
    if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/', $password)){
        array_push($errors,'Heslo musí obsahovat minimálně 8 znaků, aspoň 1 velké písmeno a jedno číslo.');
    }

    if(!count($errors)) {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $privilege = "user";

            $newUserDB = new UserDB();
            $args=[
                'email'=>$email,
                'hashedPassword'=>$hashedPassword,
                'privilege'=>$privilege
                ];
            $newUserDB->create($args);
            
            $_SESSION['session_errors'] = [];
            header('Location: ../index.php');
            exit();
        }

    else{
        $_SESSION['signup_errors'] = $errors;
        header('Location: ../signup.php');
        exit();
    }

}
?>