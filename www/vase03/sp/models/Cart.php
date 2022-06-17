<?php

class Cart
{

    public static function addProduct($id)
    {
        $quantity = $_POST['quantity'];

        $id = intval($id);
        $quantity = intval($quantity);
        if ($quantity == 0) {
            $quantity = 1;
        }

        $productsInCart = array();

        if (isset($_SESSION['products'])) {
            $productsInCart = $_SESSION['products'];
        }

        if (array_key_exists($id, $productsInCart)) {
            $productsInCart[$id] += $quantity;
        } else {
            $productsInCart[$id] = $quantity;
        }

        $_SESSION['products'] = $productsInCart;

        return self::countItems();
    }

    public static function countItems()
    {
        if (isset($_SESSION['products'])) {
            $count = 0;
            foreach ($_SESSION['products'] as $id => $quantity) {
                $count += $quantity;
            }
            return $count;
        } else {
            return 0;
        }
    }

    public static function getProducts()
    {
        if (isset($_SESSION['products'])) {
            return $_SESSION['products'];
        }
        return false;
    }

    public static function getTotalPrice($products)
    {
        $productsInCart = self::getProducts();

        if ($productsInCart) {
            $total = 0;
            foreach ($products as $item) {
                $total += $item['price'] * $productsInCart[$item['id']];
            }
        }

        return $total;
    }

    public static function clear() {
        if (isset($_SESSION['products'])) {
            unset($_SESSION['products']);
        }
    }

    public static function deleteProduct($id) {
        $productsInCart = self::getProducts();
        unset($productsInCart[$id]);

        $_SESSION['products'] = $productsInCart;
    }
}
