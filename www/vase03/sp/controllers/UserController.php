<?php

class UserController
{
    public function actionRegister()
    {
        $name = '';
        $email = '';
        $password = '';
        $result = false;

        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            $errors = false;

            if (!User::checkName($name)) {
                $errors[] = 'Name must be longer than 2 chars';
            }

            if (!User::checkEmail($email)) {
                $errors[] = 'Wrong email';
            }

            if (!User::checkPassword($password)) {
                $errors[] = 'Password must be at least 6 chars';
            }

            if (User::checkEmailExists($email)) {
                $errors[] = 'Email is already used';
            }

            if ($errors == false) {
                $result = User::register($name, $email, $password);
            }
        }
        require_once(ROOT . '/views/user/register.php');

        return true;
    }

    public function actionLogin()
    {
        $email = '';
        $password = '';

        if (isset($_POST['submit'])) {

            $email = $_POST['email'];
            $password = $_POST['password'];

            $errors = false;

            if (!User::checkEmail($email)) {
                $errors[] = 'Wrong email';
            }

            if (!User::checkPassword($password)) {
                $errors[] = 'Password must be at least 6 chars';
            }

            $userId = User::checkUserData($email, $password);

            if ($userId == false) {
                $errors[] = 'Wrong datass';
            } else {
                User::auth($userId);

                header("Location: /~vase03/sp/cabinet/");
            }
        }

        require_once(ROOT . '/views/user/login.php');
        return true;
    }

    public function actionLogout() {
        //session_start();
        unset($_SESSION['user']);
        header("Location: /~vase03/sp/");
    }
    
    
    public function actionForgotPassword() {
    	$email = '';
        $result = false;
    	
    	if (isset($_POST['submit'])) {
    		
            $email = $_POST['email'];
            $errors = false;

            if (!User::checkEmail($email)) {
                $errors[] = 'Wrong email';
            }

            if ($errors == false && !User::checkEmailExists($email)) {
                $errors[] = "We don't know this email, sorry :(";
            }

            if ($errors == false) {
                //Меняем пароль
                $password = User::passwordGenerator();
                $subject = 'Password recovery';
                $message = 'We have done your request and set new password: ' . $password;
                mail($email, $subject, $message);

                $result = User::changePasswordByUserEmail($email, $password);
            }
    		
    	}
    	require_once(ROOT . '/views/user/forgot.php');
    	return true;
    	
    }
    }
