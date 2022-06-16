<?php
$seller_id = $product['user_id'];
$temp = $usersDB->fetchById($seller_id);
$seller = $temp->fetchAll()[0];
$seller_email = $seller['email'];