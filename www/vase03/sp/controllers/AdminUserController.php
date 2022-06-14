<?php

class AdminUserController extends AdminBase
{

    public function actionIndex()
    {
        self::checkAdmin();

        $userList = User::getUserList();

        require_once(ROOT . '/views/admin_users/index.php');

        return true;
    }

    public function actionCreate()
    {
        self::checkAdmin();

        $name = '';
        $email = '';
        $password = '';
        $result = false;

        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $role = $_POST['role'];

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
                $result = User::register($name, $email, $password, $role);
                header("Location: /~vase03/sp/admin/users");
            }
        }
        require_once(ROOT . '/views/admin_users/create.php');
        return true;
    }

    public function actionUpdate($id)
    {   

        $user = User::getUserById($id);

        if ($user['role'] == 'admin') {
            header("Location: /~vase03/sp/admin/users");
        }

        self::checkAdmin();

        $user = User::getUserById($id);

        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $role = $_POST['role'];

            $errors = false;

            if (!User::checkName($name)) {
                $errors[] = 'Name must be longer than 2 chars';
            }

            if (!User::checkEmail($email)) {
                $errors[] = 'Wrong email';
            }

            if (!empty($password)) {
                if (!User::checkPassword($password)) {
                    $errors[] = 'Password must be at least 6 chars';
                }
            } else {
                $password = false;
            }

            if (User::checkEmailExists($email)) {
                if (User::getUserByEmail($email)['id'] !== $id) {
                    $errors[] = 'Email is already used';
                }
            }

            if ($errors == false) {
                $result = User::update($id, $name, $email, $password, $role);
                header("Location: /~vase03/sp/admin/users");
            }
        }


        require_once(ROOT . '/views/admin_users/update.php');
        return true;
    }

    public function actionDelete($id)
    {

        $user = User::getUserById($id);

        if ($user['role'] == 'admin') {
            header("Location: /~vase03/sp/admin/users");
        }

        self::checkAdmin();

        if (isset($_POST['submit'])) {

            User::deleteUserById($id);

            header("Location: /~vase03/sp/admin/users");
        }
        require_once(ROOT . '/views/admin_users/delete.php');
        return true;
    }
}
