<?php

class User
{
    public static function register($name, $email, $password, $role = 'user')
    {
        $password = password_hash($password, PASSWORD_DEFAULT);

        $db = Db::getConnection();

        $sql = 'INSERT INTO user (name, email, password, role) VALUES (:name, :email, :password, :role)';

        $result = $db->prepare($sql);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        $result->bindParam(':role', $role, PDO::PARAM_STR);
        $result->execute();

        return $db->lastInsertId();
    }

    public static function update($id, $name, $email, $password, $role = 'user')
    {
        $db = Db::getConnection();

        if ($password) {

            $password = password_hash($password, PASSWORD_DEFAULT);

            $sql = 'UPDATE user SET name = :name, email = :email, password = :password, role = :role WHERE id = :id';

            $result = $db->prepare($sql);
            $result->bindParam(':name', $name, PDO::PARAM_STR);
            $result->bindParam(':email', $email, PDO::PARAM_STR);
            $result->bindParam(':password', $password, PDO::PARAM_STR);
            $result->bindParam(':role', $role, PDO::PARAM_STR);
            $result->bindParam(':id', $id, PDO::PARAM_INT);

            return $result->execute();
        } else {
            $sql = 'UPDATE user SET name = :name, email = :email, role = :role WHERE id = :id';

            $result = $db->prepare($sql);
            $result->bindParam(':name', $name, PDO::PARAM_STR);
            $result->bindParam(':email', $email, PDO::PARAM_STR);
            $result->bindParam(':role', $role, PDO::PARAM_STR);
            $result->bindParam(':id', $id, PDO::PARAM_INT);

            return $result->execute();
        }
    }

    public static function checkName($name)
    {
        if (strlen($name) >= 2) {
            return true;
        }
        return false;
    }

    public static function checkPassword($password)
    {
        if (strlen($password) >= 6) {
            return true;
        }
        return false;
    }

    public static function checkPhone($phone)
    {
        if (strlen($phone) >= 10) {
            return true;
        }
        return false;
    }

    public static function checkEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }

    public static function checkEmailExists($email)
    {
        $db = Db::getConnection();

        $sql = 'SELECT COUNT(*) FROM user WHERE email = :email';

        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->execute();

        if ($result->fetchColumn()) {
            return true;
        } else {
            return false;
        }
    }

    public static function checkUserData($email, $password)
    {
        $db = Db::getConnection();

        $sql = 'SELECT * FROM user WHERE email = :email';

        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->execute();

        $user = $result->fetch();
        if ($user && password_verify($password, $user['password'])) {
            return $user['id'];
        }

        return false;
    }

    public static function auth($userId)
    {
        $_SESSION['user'] = $userId;
    }

    public static function checkLogged()
    {

        if (isset($_SESSION['user'])) {
            return $_SESSION['user'];
        }
        header("Location: /~vase03/sp/user/login");
    }

    public static function isGuest()
    {

        if (isset($_SESSION['user'])) {
            return false;
        }

        return true;
    }

    public static function getUserList()
    {
        $db = Db::getConnection();
        $usersList = array();

        $result = $db->query('SELECT id, name, email, role FROM user');

        $i = 0;
        while ($row = $result->fetch()) {
            $usersList[$i]['id'] = $row['id'];
            $usersList[$i]['name'] = $row['name'];
            $usersList[$i]['email'] = $row['email'];
            $usersList[$i]['role'] = $row['role'];
            $i++;
        }

        return $usersList;
    }

    public static function getUserById($id)
    {
        if ($id) {
            $db = Db::getConnection();
            $sql = 'SELECT * FROM user WHERE id = :id';

            $result = $db->prepare($sql);
            $result->bindParam(':id', $id, PDO::PARAM_INT);

            $result->setFetchMode(PDO::FETCH_ASSOC);
            $result->execute();

            return $result->fetch();
        }
    }

    public static function getUserByEmail($email)
    {
        if ($email) {
            $db = Db::getConnection();
            $sql = 'SELECT * FROM user WHERE email = :email';

            $result = $db->prepare($sql);
            $result->bindParam(':email', $email, PDO::PARAM_STR);

            $result->setFetchMode(PDO::FETCH_ASSOC);
            $result->execute();

            return $result->fetch();
        }
    }

    public static function editName($id, $name)
    {
        $db = Db::getConnection();

        $sql = 'UPDATE user SET name = :name WHERE id = :id';
        $result = $db->prepare($sql);

        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':name', $name, PDO::PARAM_STR);

        return $result->execute();
    }

    public static function changePasswordByUserId($id, $password)
    {
        $password = password_hash($password, PASSWORD_DEFAULT);

        $db = Db::getConnection();

        $sql = 'UPDATE user SET password = :password WHERE id = :id';
        $result = $db->prepare($sql);

        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':password', $password, PDO::PARAM_STR);

        return $result->execute();
    }

    public static function changePasswordByUserEmail($email, $password)
    {
        $password = password_hash($password, PASSWORD_DEFAULT);

        $db = Db::getConnection();

        $sql = 'UPDATE user SET password = :password WHERE email = :email';
        $result = $db->prepare($sql);

        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);

        return $result->execute();
    }

    public static function deleteUserById($id)
    {
        $db = Db::getConnection();

        $sql = 'DELETE FROM user WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }

    public static function passwordGenerator($passLength = 10)
    {

        $chars = "qazxswedcvfrtgbnhyujmkiolp1234567890QAZXSWEDCVFRTGBNHYUJMKIOLP";
        $size = StrLen($chars) - 1;
        $password = null;

        while ($passLength--) {
            $password .= $chars[rand(0, $size)];
        }
        return $password;
    }
}
