<?php

require_once __DIR__ . '/db/UsersDB.php';
require_once __DIR__ . '/db/OrdersDB.php';
require_once __DIR__ . '/db/ProductsDB.php';

$usersDB = new UsersDB();
$usersDB->dump();
$usersDB->createMany([
    [
        'name' => 'Marek',
        'email' => 'marek@seznma.cz',
        'age' => '23',
    ],
    [
        'name' => 'Pavel',
        'email' => 'pavel@seznma.cz',
        'age' => '45',
    ],
]);
$usersDB->update([
    'age' => '50',
], [
    'email' => 'pavel@seznma.cz',
]);

$productsDB = new ProductsDB();
$productsDB->dump();
$productsDB->create([
    'product_id' => '2020-01-09-LKK',
    'name' => 'Sugar',
    'price' => '4500',
]);

$ordersDB = new OrdersDB();
$ordersDB->dump();
$ordersDB->createMany([
    [
        'order_id' => 'ORDER-NUM-1',
        'date' => '2020-09-10',
    ],
    [
        'order_id' => 'ORDER-NUM-2',
        'date' => '2020-09-13',
    ],
    [
        'order_id' => 'ORDER-NUM-3',
        'date' => '2020-09-16',
    ]
]);
$ordersDB->delete([
    'order_id' => 'ORDER-NUM-2'
]);

$data = [
    'users' => [
        'logs' => $usersDB->dumpLogs(),
        'data' => $usersDB->fetchAll(),
    ],
    'products' => [
        'logs' => $productsDB->dumpLogs(),
        'data' => $productsDB->fetchAll(),
    ],
    'orders' => [
        'logs' => $ordersDB->dumpLogs(),
        'data' => $ordersDB->fetchAll(),
    ],
];

echo json_encode($data);
