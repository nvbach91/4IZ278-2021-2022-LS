<?php

require_once __DIR__ . '/DB.php';
require_once __DIR__ . '/DBOptions.php';

class OrdersDB extends DB
{

    protected function getOptions(): DBOptions
    {
        return (new DBOptions())
            ->setFilePath(__DIR__ . '/data/orders.db.csv')
            ->setSeparator(';')
            ->setKey('order_id')
            ->setDomain('Order')
            ->setHeader([
                0 => 'order_id',
                1 => 'date',
            ]);
    }
}