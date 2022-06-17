<?php

return array(
    // 'vase03/sp/news/([a-z]+)/([0-9]+)' => 'news/view/$1/$2',
    // 'vase03/sp/news' => 'news/index',
    // 'vase03/sp/products' => 'product/list',

    'vase03/sp/product/([0-9]+)' => 'product/view/$1',
    
    'vase03/sp/catalog' => 'catalog/index',

    'vase03/sp/category/([0-9]+)/page-([0-9]+)' => 'catalog/category/$1/$2',
    'vase03/sp/category/([0-9]+)' => 'catalog/category/$1',

    'vase03/sp/cart/add/([0-9]+)' => 'cart/add/$1',
    'vase03/sp/cart/checkout' => 'cart/checkout',
    'vase03/sp/cart/delete/([0-9]+)' => 'cart/delete/$1',
    'vase03/sp/cart' => 'cart/index',

    'vase03/sp/user/register' => 'user/register',
    'vase03/sp/user/login' => 'user/login',
    'vase03/sp/user/logout' => 'user/logout',
    'vase03/sp/facebook/login(.*?)' => 'facebook/login',
    'vase03/sp/user/forgot' => 'user/forgotPassword',

    //'vase03/sp/cabinet/edit' => 'cabinet/edit',
    'vase03/sp/cabinet/edit/name' => 'cabinet/editUserName',
    'vase03/sp/cabinet/edit/password' => 'cabinet/editUserPassword',
    'vase03/sp/cabinet/history/view/([0-9]+)' => 'cabinet/view/$1',
    'vase03/sp/cabinet/history' => 'cabinet/history',
    'vase03/sp/cabinet' => 'cabinet/index',

    'vase03/sp/admin/product/create' => 'adminProduct/create',
    'vase03/sp/admin/product/update/([0-9]+)' => 'adminProduct/update/$1',
    'vase03/sp/admin/product/delete/([0-9]+)' => 'adminProduct/delete/$1',
    'vase03/sp/admin/product' => 'adminProduct/index',

    'vase03/sp/admin/category/create' => 'adminCategory/create',
    'vase03/sp/admin/category/update/([0-9]+)' => 'adminCategory/update/$1',
    'vase03/sp/admin/category/delete/([0-9]+)' => 'adminCategory/delete/$1',
    'vase03/sp/admin/category' => 'adminCategory/index',

    'vase03/sp/admin/order/update/([0-9]+)' => 'adminOrder/update/$1',
    'vase03/sp/admin/order/delete/([0-9]+)' => 'adminOrder/delete/$1',
    'vase03/sp/admin/order/view/([0-9]+)' => 'adminOrder/view/$1',
    'vase03/sp/admin/order' => 'adminOrder/index',

    'vase03/sp/admin/users/create' => 'adminUser/create',
    'vase03/sp/admin/users/update/([0-9]+)' => 'adminUser/update/$1',
    'vase03/sp/admin/users/delete/([0-9]+)' => 'adminUser/delete/$1',
    'vase03/sp/admin/users' => 'adminUser/index',
    
    'vase03/sp/admin' => 'admin/index',

    'vase03/sp/contacts' => 'site/contact',

    'vase03/sp' => 'site/index',
);
