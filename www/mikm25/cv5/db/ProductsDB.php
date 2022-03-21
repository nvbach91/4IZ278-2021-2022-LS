<?php

require_once __DIR__ . '/DB.php';
require_once __DIR__ . '/DBOptions.php';

class ProductsDB extends DB
{

    protected function getOptions(): DBOptions
    {
        return (new DBOptions())
            ->setFilePath(__DIR__ . '/data/products.db.csv')
            ->setSeparator(';')
            ->setKey('product_id')
            ->setDomain('Product')
            ->setHeader([
                0 => 'product_id',
                1 => 'name',
                2 => 'price',
            ]);
    }
}