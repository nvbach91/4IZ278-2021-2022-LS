<?php

class CabinetController
{

    public function actionIndex() {

        $userId = User::checkLogged();

        $user = User::getUserById($userId);

        require_once(ROOT . '/views/cabinet/index.php');
        return true;
    }

    public function actionEditUserName() {
        $userId = User::checkLogged();

        $user = User::getUserById($userId);

        $name = $user['name'];

        $result = false;

        if (isset($_POST['submit'])) {
            $name = $_POST['name'];

            $errors = false;

            if (!User::checkName($name)) {
                $errors[] = 'Name must be longer than 2 chars';
            }

            if ($errors == false) {
                $result = User::editName($userId, $name);
            }
        }
        require_once(ROOT . '/views/cabinet/edit_name.php');
        return true;
    }

    public function actionEditUserPassword() {
        $userId = User::checkLogged();

        $result = false;

        if (isset($_POST['submit'])) {

            $password = $_POST['password'];
            $password2 = $_POST['password2'];

            $errors = false;

            if (!User::checkPassword($password)) {
                $errors[] = 'Password must be at least 6 characters';
            }

            if ($password !== $password2) {
                $errors[] = "Passwords don't match";
            }

            if ($errors == false) {
                $result = User::changePasswordByUserId($userId, $password);
            }
        }
        require_once(ROOT . '/views/cabinet/edit_password.php');
        return true;
    }

    public function actionHistory()
    {
        $userId = User::checkLogged();

        $ordersList = Order::getUserOrdersListById($userId);

        require_once(ROOT . '/views/cabinet/history.php');
        return true;
    }

    public function actionView($id) {
        $userId = User::checkLogged();

        $order = Order::getOrderById($id);

        $products = Order::getOrderedItemsById($id);

        if ($userId == $order['user_id']) {
            require_once(ROOT . '/views/cabinet/view.php');
            return true;
        } else {
            return false;
        }

        
    }

}
