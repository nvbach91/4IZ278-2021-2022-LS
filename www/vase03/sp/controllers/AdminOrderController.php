<?php

class AdminOrderController extends AdminBase
{


    public function actionIndex()
    {
        self::checkAdmin();

        $ordersList = Order::getOrdersList();

        require_once(ROOT . '/views/admin_order/index.php');
        return true;
    }


    public function actionUpdate($id)
    {

        self::checkAdmin();


        $order = Order::getOrderById($id);


        if (isset($_POST['submit'])) {

            $userName = $_POST['userName'];
            $userPhone = $_POST['userPhone'];
            $userComment = $_POST['userComment'];
            $userCountry = $_POST['userCountry'];
            $userCity = $_POST['userCity'];
            $userProvince = $_POST['userProvince'];
            $date = $_POST['date'];
            $status = $_POST['status'];

            Order::updateOrderById($id, $userName, $userPhone, $userComment, $userCountry, $userCity, $userProvince, $date, $status);

            header("Location: /~vase03/sp/admin/order/view/$id");
        }

        require_once(ROOT . '/views/admin_order/update.php');
        return true;
    }

    public function actionView($id)
    {

        self::checkAdmin();

        $order = Order::getOrderById($id);

        $products = Order::getOrderedItemsById($id);

        require_once(ROOT . '/views/admin_order/view.php');
        return true;
    }


    public function actionDelete($id)
    {

        self::checkAdmin();


        if (isset($_POST['submit'])) {

            Order::deleteOrderById($id);

            header("Location: /~vase03/sp/admin/order");
        }

        require_once(ROOT . '/views/admin_order/delete.php');
        return true;
    }

}