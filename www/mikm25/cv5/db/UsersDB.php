<?php

require_once __DIR__ . '/DB.php';
require_once __DIR__ . '/DBOptions.php';

class UsersDB extends DB
{

    protected function getOptions(): DBOptions
    {
        return (new DBOptions())
            ->setFilePath(__DIR__ . '/data/users.db.csv')
            ->setSeparator(';')
            ->setKey('email')
            ->setDomain('User')
            ->setHeader([
                0 => 'name',
                1 => 'email',
                2 => 'age',
                3 => 'is_admin',
            ])
            ->setDefaultValues([
                'is_admin' => 0,
            ]);
    }
}