<?php

class CartController
{

    public function actionAdd($id)
    {
        echo Cart::addProduct($id);
        return true;
    }

    public function actionIndex()
    {
        $categories = array();
        $categories = Category::getCategoryList();

        $productsInCart = false;

        $productsInCart = Cart::getProducts();


        if ($productsInCart) {
            $productsIds = array_keys($productsInCart);
            $products = Product::getProductsByIds($productsIds);
            $totalPrice = Cart::getTotalPrice($products);
        }

        require_once(ROOT . '/views/cart/index.php');

        return true;
    }

    public function actionCheckout()
    {
        $productsInCart = Cart::getProducts();


        if ($productsInCart == false) {
            header("Location: /~vase03/sp/");
        }

        $categories = Category::getCategoryList();

        $productsIds = array_keys($productsInCart);
        $products = Product::getProductsByIds($productsIds);
        $totalPrice = Cart::getTotalPrice($products);
        $totalQuantity = Cart::countItems();

        $userName = false;
        $userPhone = false;
        $userComment = false;
        $userCountry = false;
        $userCity = false;
        $userProvince = false;
        $userEmail = false;

        $result = false;

        if (!User::isGuest()) {
            $userId = User::checkLogged();
            $user = User::getUserById($userId);
            $userName = $user['name'];
            $userEmail = $user['email'];
        } else {
            $userId = 999;
        }

        if (isset($_POST['submit'])) {

            $userName = $_POST['userName'];
            $userPhone = $_POST['userPhone'];
            $userComment = $_POST['userComment'];
            $userCountry = $_POST['userCountry'];
            $userCity = $_POST['userCity'];
            $userProvince = $_POST['userProvince'];
            $userEmail = $_POST['userEmail'];

            $errors = false;

            if (!User::checkName($userName)) {
                $errors[] = 'Wrong name';
            }

            if (!User::checkPhone($userPhone)) {
                $errors[] = 'Wrong phone';
            }

            if (!User::checkEmail($userEmail)) {
                $errors[] = 'Wrong email';

            }

            if ($errors == false) {
                
                $productsArray = array();
                foreach ($products as $key => $item) {
                    foreach ($productsInCart as $id => $quantity) {
                        if ($item['id'] == $id) {
                            $productsArray[$key] = $item;
                            $productsArray[$key]['quantity'] = $quantity;
                        }
                    }
                }
                
                $result = Order::save($userName, $userPhone, $userComment, $userId, $userCountry, $userCity, $userProvince, $userEmail, $totalPrice, $productsArray);

                if ($result) {
                    $adminEmail = 'smoldiel@gmail.com';
                    $message = 'https://eso.vse.cz/~vase03/sp/admin/orders';
                    $subject = 'New order!';
                    mail($adminEmail, $subject, $message);

                    Cart::clear();
                }
            }
        }

        require_once(ROOT . '/views/cart/checkout.php');

        return true;
    }

    public function actionDelete($id)
    {
        Cart::deleteProduct($id);
        header("Location: /~vase03/sp/cart");
    }
}
