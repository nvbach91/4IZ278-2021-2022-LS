<?php

include ROOT . '/config/config_fb.php';

class FacebookController
{
    public function actionLogin()
    {
        if (isset($_GET['error']) && !$_GET['error']) {
            die('Facebook login error. Please, go back to the main site.');
        }
        $token = file_get_contents('https://graph.facebook.com/v14.0/oauth/access_token?client_id=' . ID . '&redirect_uri=' . RE_URL . '&client_secret=' . SECRET . '&code=' . $_GET['code']);
        $token = json_decode($token, true);

        if (!isset($token) && !$token) {
            die('Error token');
        }

        $data = file_get_contents('https://graph.facebook.com/v14.0/me?client_id=' . ID . '&redirect_uri=' . RE_URL . '&client_secret=' . SECRET . '&code=' . $_GET['code'] . '&access_token=' . $token['access_token'] . '&fields=id,name,email');
        $data = json_decode($data, true);

        if (!isset($token) && !$data) {
            die('Error data');
        }


        if (!isset($data['email'])) {
            die('We need to verificate your email for login. Please, visit facebook settings and let us share your email :(');
        }

        $fbUser = Facebook::facebookEmailCheckExisting($data['email']);

        if (!$fbUser) {
            //Если не существует, то создаем в юзера бд
            $name = $data['name'];
            $email = $data['email'];
            $password = User::passwordGenerator();

            $newUserId = User::register($name, $email, $password);

            User::auth($newUserId);

            $userEmail = $email;
            $message = 'We created account for you! Your password is: ' . $password;
            $subject = 'You are logged via facebook';
            mail($userEmail, $subject, $message);

            header("Location: /~vase03/sp/cabinet/");

        } else {
            //Если существует, то логинимся
            User::auth($fbUser['id']);

            header("Location: /~vase03/sp/cabinet/");
        }
        return true;
    }
}
