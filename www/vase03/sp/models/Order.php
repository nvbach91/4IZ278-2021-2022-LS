<?php

class Order
{

    public static function save($userName, $userPhone, $userComment, $userId, $userCountry, $userCity, $userProvince, $userEmail, $totalPrice, $products)
    {
        $db = Db::getConnection();

        $sql = 'INSERT INTO product_order (user_name, user_phone, user_comment, user_id, user_email, country, city, province, total_price) VALUES (:user_name, :user_phone, :user_comment, :user_id, :user_email, :country, :city, :province, :total_price)';

        $result = $db->prepare($sql);
        $result->bindParam(':user_name', $userName, PDO::PARAM_STR);
        $result->bindParam(':user_phone', $userPhone, PDO::PARAM_STR);
        $result->bindParam(':user_comment', $userComment, PDO::PARAM_STR);
        $result->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $result->bindParam(':total_price', $totalPrice, PDO::PARAM_STR);
        $result->bindParam(':user_email', $userEmail, PDO::PARAM_STR);
        $result->bindParam(':country', $userCountry, PDO::PARAM_STR);
        $result->bindParam(':city', $userCity, PDO::PARAM_STR);
        $result->bindParam(':province', $userProvince, PDO::PARAM_STR);

        $result->execute();
        //
        $orderId = $db->lastInsertId();

        $values = array();
        foreach ($products as $record) {
            $values[] = sprintf("( '%s' , '%s',  '%s',  '%s',  '%s')", addslashes($record['id']), addslashes($record['name']), addslashes($orderId), addslashes($record['price']), addslashes($record['quantity']));
        }

        $sql2 = "INSERT INTO ordered_items (product_id, product_name, order_id, price, quantity) VALUES " . implode(",", $values);
        $result2 = $db->prepare($sql2);
        return $result2->execute();
    }

    public static function getOrdersList()
    {   
        $default_timezone = date_default_timezone_get();
        $localTimeZone = new DateTimeZone($default_timezone);
        $db = Db::getConnection();

        $result = $db->query('SELECT id, user_name, user_phone, date, status FROM product_order ORDER BY date DESC');
        $ordersList = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $ordersList[$i]['id'] = $row['id'];
            $ordersList[$i]['user_name'] = $row['user_name'];
            $ordersList[$i]['user_phone'] = $row['user_phone'];

            $dateFromDB = $row['date'];
            $date = new DateTime($dateFromDB, new DateTimeZone('Europe/Moscow'));
            $date->setTimezone($localTimeZone);
            $newDate = $date->format("Y-m-d H:i:s");
            $ordersList[$i]['date'] = $newDate;
            $ordersList[$i]['status'] = $row['status'];
            $i++;
        }
        return $ordersList;
    }

    public static function getUserOrdersListById($id)
    {
        $default_timezone = date_default_timezone_get();
        $db = Db::getConnection();

        $result = $db->query('SELECT id, user_name, user_phone, date, status FROM product_order WHERE user_id = ' . $id . ' ORDER BY id DESC');
        $ordersList = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $ordersList[$i]['id'] = $row['id'];
            $ordersList[$i]['user_name'] = $row['user_name'];
            $ordersList[$i]['user_phone'] = $row['user_phone'];
            $date = new DateTime($row['date'], new DateTimeZone('Europe/Moscow'));
            $date = $date->setTimezone(new DateTimeZone($default_timezone));
            $ordersList[$i]['date'] = $date->format($row['date']);
            $ordersList[$i]['status'] = $row['status'];
            $i++;
        }
        return $ordersList;
    }

    public static function getOrderById($id)
    {
        $db = Db::getConnection();

        $sql = 'SELECT * FROM product_order WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        $result->setFetchMode(PDO::FETCH_ASSOC);
        

        $result->execute();

        return $result->fetch();
    }

    public static function getOrderedItemsById($id) {
        $products = array();

        $db = Db::getConnection();

        $sql = 'SELECT * FROM ordered_items WHERE order_id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_STR);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();

        $i = 0;
        while ($row = $result->fetch()) {
            $products[$i]['product_id'] = $row['product_id'];
            $products[$i]['product_name'] = $row['product_name'];
            $products[$i]['price'] = $row['price'];
            $products[$i]['quantity'] = $row['quantity'];
            $i++;
        }

        return $products;
    }

    public static function updateOrderById($id, $userName, $userPhone, $userComment, $userCountry, $userCity, $userProvince, $date, $status)
    {
        $db = Db::getConnection();

        $sql = "UPDATE product_order
            SET 
                user_name = :user_name, 
                user_phone = :user_phone, 
                user_comment = :user_comment,
                country = :country,
                city = :city,
                province = :province, 
                date = :date, 
                status = :status 
            WHERE id = :id";

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':user_name', $userName, PDO::PARAM_STR);
        $result->bindParam(':user_phone', $userPhone, PDO::PARAM_STR);
        $result->bindParam(':user_comment', $userComment, PDO::PARAM_STR);
        $result->bindParam(':country', $userCountry, PDO::PARAM_STR);
        $result->bindParam(':city', $userCity, PDO::PARAM_STR);
        $result->bindParam(':province', $userProvince, PDO::PARAM_STR);
        $result->bindParam(':date', $date, PDO::PARAM_STR);
        $result->bindParam(':status', $status, PDO::PARAM_INT);
        return $result->execute();
    }

    public static function deleteOrderById($id)
    {
        $db = Db::getConnection();

        $sql = 'DELETE FROM product_order WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }

    public static function getStatusText($status)
    {
        switch ($status) {
            case '1':
                return 'New order';
                break;
            case '2':
                return 'In progress';
                break;
            case '3':
                return 'Delivery';
                break;
            case '4':
                return 'Closed';
                break;
        }
    }
}
