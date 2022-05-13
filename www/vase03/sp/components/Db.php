<?php

class Db
{
    public static function getStatusConnection() {

        try {
            $paramsPath = ROOT . '/config/db_params.php';
            $params = include($paramsPath);

            $dsn = "mysql:host={$params['host']};dbname={$params['dbname']}";
            $db = new PDO($dsn, $params['user'], $params['password']);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return true;
        } catch (PDOException $e) {
            return false;
        } 
    }
}
